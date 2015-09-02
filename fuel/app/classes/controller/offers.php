<?php

class Controller_Offers extends Controller_Template_EveryUserTemplate
{	
	public function action_index($user_id = NULL)
	{
		if ($user_id == NULL)
		{
			throw new HttpNotFoundException;
		}
		
		// DBから基本情報の取得。
		$profile = Model_Offers::get_profile_array_by_user_id($user_id);
		$profile['zip3'] = Str::zip_shaping($profile['zip'])['zip3'];
		$profile['zip4'] = Str::zip_shaping($profile['zip'])['zip4'];
		// DBからイメージ情報を取得。
		$c_username = Model_Offers::get_offer_array_by_user_id($user_id)['c_username'];
		list($profile['c_image'], $profile['r_image']) = Model_Offers::fetch_c_images($c_username);
		// DBから採用情報を取得。
		$profile = array_merge($profile, Str::make_lb_and_para_into_tags(Model_Offers::get_offer_array_by_user_id($user_id)));
		$profile['reception'] = Model_Offers::get_c_reception_status(strip_tags($profile['reception']));
		$profile['c_id'] = $user_id;
		
		
		$this->template->title		= $profile['c_name'].'の求人情報';
		$this->template->content	= View::forge('offers/offer', $profile, false);
		
		$s_auth = Auth::instance('Studentauth');
		$c_auth = Auth::instance('Clinicauth');
		
		if ($s_auth->check() || $c_auth->check()) // 学生、動物病院どちらかのアカウントでログイン済み
		{	
			$this->template->content->employ_part	= View::forge('offers/already_login', $profile, false);
		}
		else // どのアカウントでもログインをしていない。
		{
			$this->template->content->employ_part	= View::forge('offers/not_login');
		}
		
	}
	
	public function forge_search_validation()
	{
		$val = Validation::forge();
		
		$val->add('q', '検索文字列')
			->add_rule('trim')
			->add_rule('max_length', 50)
			->add_rule('no_tab_and_newline');
		
		return $val;
	}
	
	public function action_search()
	{
		if (Input::method() != 'GET' ||  ! Input::get('q'))
		{
			$this->template->title		= '求人を検索する';
			$this->template->content	= View::forge('offers/search');
			return;
		}
		
		$val = $this->forge_search_validation()->add_callable('MyValidationRules');
		
		if ( ! $val->run(array('q' => Input::get('q'))))
		{
			$this->template->title		= '検索エラー';
			$this->template->content	= View::forge('offers/search_error');
			$this->template->content->set_safe('error_message', $val->show_errors());
			return;
		}
		
		list($searched_rows, $offer_id_array) = Model_Offers::search(Input::get('q'));
		
		if ($searched_rows == 0) // 検索ヒットしなかった場合
		{
			$message = '「'. Input::get('q') .'」に一致する求人は見つかりませんでした。';
			$this->template->title		= '検索エラー';
			$this->template->content	= View::forge('offers/search_error');
			$this->template->content->set_safe('error_message', $message);
			return;
		}
		elseif ($searched_rows > 0) // １件以上ヒットした場合	
		{
			Config::load('clinicauth');
			
			$pagination = Pagination::forge('offerspagination', Model_Offers::pagination_config(Input::get('q'), $searched_rows));
			$data['offers_data'] = DB::select();
			foreach ($offer_id_array as $offer_id)
			{
				$data['offers_data']->or_where('offers.id', '=', $offer_id);
			}
			$data['offers_data']->from('offers')
				->join(Config::get('clinicauth.table_name'), 'LEFT')
				->on('offers.c_username', '=', Config::get('clinicauth.table_name').'.username');
			
			$data['pagination'] = $data['offers_data']
				->limit($pagination->per_page)
				->offset($pagination->offset)
				->order_by('offers.id', 'asc')
				->execute();
			
			$data['offers'] = $data['offers_data']->order_by('offers.id', 'asc')
				->execute()
				->as_array();
			
			foreach ($data['offers'] as &$value)
			{
				$value['profile_fields']	= unserialize($value['profile_fields']);
				$value['clinic_id']			= Model_Offers::get_c_id_by_c_username($value['c_username']);
				list($value['c_image'],)	= Model_Offers::fetch_c_images($value['c_username']);
			}
			unset($value);
			
			$this->template->title		= '「'. Input::get('q') .'」の求人検索結果';
			$this->template->content	= View::forge('offers/search_result', $data);
			$this->template->content->set_safe('paging_bar', $pagination->render());
			$this->template->content->set_safe('number', $searched_rows);
			return;
		}
		
	}
	
	public function forge_apply_form()
	{
		$form = Fieldset::forge();
		
		$objective_ops = array(
			''		=> '',
			'見学'	=> '見学',
			'面談'	=> '面談',
			'実習'	=> '実習',			
		);
		
		
		$form->add('objective', '応募目的', array(
			'options'	=> $objective_ops,
			'type'		=> 'select',
			'class'		=> 'form-control detailinput',
			'value'		=> (isset($data['profile']['therapy_realm'])) ? $data['profile']['therapy_realm'] : '',
			))
			->add_rule('required')
			->add_rule('array_key_exists', $objective_ops);
		
		$form->add('contents', '応募理由（800文字以内）', array(
			'type'	=> 'textarea',
			'cols'	=> 70,
			'rows'	=> 6,
			'class'	=> 'form-control offertextarea',
			'value'	=> (isset($data['environment'])) ? $data['environment'] : '',
			))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab')
			->add_rule('max_length', 800);
		
		$form->add('submit', '', array(
			'type'	=> 'submit',
			'value'	=> '応募内容の確認',
			'class'	=> 'btn btn-primary btn-lg'));
		
		return $form;
	}
	
	public function action_apply($user_id = NULL)
	{
		if ($user_id == NULL)
		{
			throw new HttpNotFoundException;
		}
		
		$s_auth = Auth::instance('Studentauth');
		if ( ! $s_auth->check())
		{
			$this->template->title		= '動物病院の見学、面談、実習への応募';
			$this->template->content	= View::forge('error');
			$this->template->content->set_safe('error_title', 'ログインしてください！');
			$this->template->content->set('error_content', ''
				. '<p>動物病院の面談・実習への応募するためには、メンバー登録した後ログインする必要があります。</p>'
				. '<p>メンバー登録は５分で終了します。</p>'
				. '<p>'.Html::anchor(Uri::base().'student/auth/invite',
					'メンバー登録する',
					array('class' => 'btn btn-primary btn-lg')).'<p/>', false);
			return;
		}
		
		$data['profile']	= Model_Student_Mypage::get_s_profile_array();
		$data['c_profile']	= Model_Offers::get_profile_array_by_user_id($user_id);
		
		if (Model_Offers::get_offer_array_by_user_id($user_id)['reception'] == 0)
		{
			$this->template->title		= '募集締め切り中の求人です';
			$this->template->submenu	= View::forge('student/mypage/submenu', $data);
			$this->template->content	= View::forge('error');
			$this->template->content->set_safe('error_title', '募集締め切り中の求人です');
			$this->template->content->set('error_content', ''
				. '<p>'.$data['c_profile']['c_name'].'は現在募集締め切り中の求人です。</p>'
				. '<p>'.Html::anchor(Uri::base().'offers/search',
					'別の求人を検索する',
					array('class' => 'btn btn-primary btn-lg')).'<p/>', false);
			return;
		}
		
		
		$s_username = $s_auth->get('username');
		if (Model_Offers::count_how_many_applys($s_username, $user_id) != 0)
		{
			$this->template->title		= '応募済みの求人です';
			$this->template->submenu	= View::forge('student/mypage/submenu', $data);
			$this->template->content	= View::forge('error');
			$this->template->content->set_safe('error_title', '応募済みの求人です');
			$this->template->content->set('error_content', ''
				. '<p>'.$data['c_profile']['c_name'].'には既に応募しています。</p>'
				. '<p>動物病院からの連絡が登録済みのメールアドレスもしくは電話番号にあります。しばらくお待ち下さい。</p>', false);
			return;
		}
		
		$data['c_profile']['c_id']	= $user_id;
		
		$form = $this->forge_apply_form();
		
		if (Input::method() === 'POST')
			{
				$form->repopulate();
			}
			
		$this->template->title		= '動物病院の見学、面談、実習への応募';
		$this->template->submenu	= View::forge('student/mypage/submenu', $data);
		$this->template->content = View::forge('offers/apply', $data);
		$this->template->content->set_safe('apply_form', $form->build('offers/apply_confirm/'.$user_id));
		return;
	}
	
	public function action_apply_confirm($user_id = NULL)
	{
		if ($user_id == NULL || Input::method() !== 'POST')
		{
			throw new HttpNotFoundException;
		}
		
		$s_auth = Auth::instance('Studentauth');
		if ( ! $s_auth->check())
		{
			$this->template->title		= '動物病院の見学、面談、実習への応募';
			$this->template->content	= View::forge('error');
			$this->template->content->set_safe('error_title', 'ログインしてください！');
			$this->template->content->set('error_content', ''
				. '<p>動物病院の面談・実習への応募するためには、メンバー登録した後ログインする必要があります。</p>'
				. '<p>メンバー登録は５分で終了します。</p>'
				. '<p>'.Html::anchor(Uri::base().'student/auth/invite',
					'メンバー登録する',
					array('class' => 'btn btn-primary btn-lg')).'<p/>', false);
			return;
		}
		
		$data['profile']			= Model_Student_Mypage::get_s_profile_array();
		$data['c_profile']			= Model_Offers::get_profile_array_by_user_id($user_id);
		$data['c_profile']['c_id']	= $user_id;
		
		$form = $this->forge_apply_form();
		$val = $form->validation()->add_callable('MyValidationRules');
		
		if ( ! $val->run()) 
		{
			$form->repopulate();
			$this->template->title		= '応募情報の修正';
			$this->template->submenu	= View::forge('student/mypage/submenu', $data);
			$this->template->content	= View::forge('offers/apply', $data);
			$this->template->content->set_safe('apply_error', $val->show_errors());
			$this->template->content->set_safe('apply_form', $form->build('offers/apply_confirm/'.$user_id));
			return;
		}
		
		$data['input'] = $val->validated();
		
		$this->template->title		= '応募情報の確認';
		$this->template->content	= View::forge('offers/apply_confirm', $data);
	}
	
	public function action_apply_completion($user_id = NULL)
	{
		if ( ! Security::check_token())
		{
			throw new HttpInvalidInputException('ただしいページ遷移ではありません。');
		}
		
		if ($user_id == NULL || Input::method() !== 'POST')
		{
			throw new HttpNotFoundException;
		}
		
		$s_auth = Auth::instance('Studentauth');
		if ( ! $s_auth->check())
		{
			$this->template->title		= '動物病院の見学、面談、実習への応募';
			$this->template->content	= View::forge('error');
			$this->template->content->set_safe('error_title', 'ログインしてください！');
			$this->template->content->set('error_content', ''
				. '<p>動物病院の面談・実習へ応募するためには、メンバー登録した後ログインする必要があります。</p>'
				. '<p>メンバー登録は５分で終了します。</p>'
				. '<p>'.Html::anchor(Uri::base().'student/auth/invite',
					'メンバー登録する',
					array('class' => 'btn btn-primary btn-lg')).'<p/>', false);
			return;
		}
		
		$data['profile']			= Model_Student_Mypage::get_s_profile_array();
		
		$form = $this->forge_apply_form();
		$val = $form->validation()->add_callable('MyValidationRules');
		
		if ( ! $val->run()) 
		{
			$form->repopulate();
			$this->template->title		= '応募情報の修正';
			$this->template->submenu	= View::forge('student/mypage/submenu', $data);
			$this->template->content	= View::forge('offers/apply', $data);
			$this->template->content->set_safe('apply_error', $val->show_errors());
			$this->template->content->set_safe('apply_form', $form->build('offers/apply_confirm/'.$user_id));
			return;
		}
		
		$apply_information_array = array(
			's_username'	=> $s_auth->get('username'),
			'c_username'	=> Model_Offers::get_c_username_by_c_id($user_id),
			'objective'		=> Input::post('objective'),
			'contents'		=> Input::post('contents'),
			'already_read'	=> 0,
			'created_at'	=> Date::forge()->get_timestamp(),
		);
		
		if (Model_Offers::register_apply($apply_information_array) != 1)
		{
			$this->template->title		= 'データベースエラー';
			$this->template->content	= View::forge('error');
			$this->template->content->set_safe('error_title', 'データベースエラー');
			$$this->template->content->set('error_content', ''
						. '<p>データベースへの登録が失敗しました。お手数おかけしますがもう一度ご登録ください。</p>'
				. '<p>'.Html::anchor(Uri::base().'offers/apply/'.$user_id,
					'>動物病院の面談・実習へ応募する',
					array('class' => 'btn btn-primary btn-lg')).'<p/>', false);
			return;
		}
		
		$data['profile'] = Model_Offers::get_profile_array_by_user_id($user_id);
		$data['objective'] = Input::post('objective');
		$data['c_id'] = $user_id;
		
		$mail = new Model_Offers();
		$mail->send_notification_to_clinic($data);
		
		$this->template->title		= '応募が完了しました。';
		$this->template->submenu	= View::forge('student/mypage/submenu', $data);
		$this->template->content = View::forge('offers/apply_completion', $data);
		return;	
	}
}

