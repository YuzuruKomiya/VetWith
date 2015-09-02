<?php

class Controller_Clinic_Mypage extends Controller_Template_ClinicExclusiveTemplate
{	
	public function action_index()
	{
		$data['profile'] = Model_Clinic_Mypage::get_c_profile_array();
		
		$this->template->title		= '動物病院マイページ';
		$this->template->submenu	= View::forge('clinic/mypage/submenu', $data);
		$this->template->content	= View::forge('clinic/mypage/top', $data);
		
		$profile_check = new Model_Clinic_Mypage();
		$update_check = $profile_check->c_profile_comletion_check();
		if ( ! $update_check )
		{
			$this->template->content->hint_suggestion = View::forge('clinic/mypage/hint_suggestion');
		}
	}
	
	protected function forge_set_detail_form()
	{	
		$data['profile'] = Model_Clinic_Mypage::get_c_profile_array();
		
		$form = Fieldset::forge();
		
		$form->add('c_name', '病院名', array(
			'placeholder'	=> '30文字以下',
			'class'			=> 'form-control detailinput',
			'value'			=> $data['profile']['c_name'],
			))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab_and_newline')
			->add_rule('max_length', 30);
		
		$form->add('l_name', '代表者の姓', array(
			'placeholder'	=> '姓',
			'class'			=> 'form-control detailinput',
			'value'			=> $data['profile']['l_name'],
			))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab_and_newline')
			->add_rule('min_length', 1)
			->add_rule('max_length', 10);
		
		$form->add('f_name', '代表者の名', array(
			'placeholder'	=> '名',
			'class'			=> 'form-control detailinput',
			'value'			=> $data['profile']['f_name'],
			))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab_and_newline')
			->add_rule('min_length', 1)
			->add_rule('max_length', 10);
	
		$form->add('l_name_kana', '代表者の姓のカナ', array(
			'placeholder'	=> '姓のカナ',
			'class'			=> 'form-control detailinput',
			'value'			=> $data['profile']['l_name_kana'],
			))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab_and_newline')
			->add_rule('only_katakana')
			->add_rule('min_length', 1)
			->add_rule('max_length', 10);
		
		$form->add('f_name_kana', '代表者の名のカナ', array(
			'placeholder'	=> '名のカナ',
			'class'			=> 'form-control detailinput',
			'value'			=> $data['profile']['f_name_kana'],
			))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab_and_newline')
			->add_rule('only_katakana')
			->add_rule('min_length', 1)
			->add_rule('max_length', 10);
		
		$form->add('zip1', '郵便番号上３桁', array(
			'placeholder'	=> '123',
			'class'			=> 'form-control detailinput',
			'value'			=> Str::zip_shaping($data['profile']['zip'])['zip3'],
			))
			->add_rule(function($form) { return mb_convert_kana($form, 'n');})
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab_and_newline')
			->add_rule('valid_string', array('numeric'))
			->add_rule('exact_length', 3);
		
		$form->add('zip2', '郵便番号下４桁', array(
			'placeholder'	=> '4567',
			'class'			=> 'form-control detailinput',
			'value'			=> Str::zip_shaping($data['profile']['zip'])['zip4'],
			'onKeyUp'		=> 'AjaxZip3.zip2addr(\'zip1\',\'zip2\',\'prefecture\',\'address\')',
			))
			->add_rule(function($form) { return mb_convert_kana($form, 'n');})
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab_and_newline')
			->add_rule('valid_string', array('numeric'))
			->add_rule('exact_length', 4);
		
		$data['profile']['prefecture_number'] =
			array_search($data['profile']['prefecture'], Controller_Clinic_Auth::$prefecture);
		
		$form->add('prefecture', '都道府県', array(
			'options'	=> Controller_Clinic_Auth::$prefecture,
			'type'		=> 'select',
			'class'		=> 'form-control detailinput',
			'value'		=> $data['profile']['prefecture_number'],
			))
			->add_rule('required')
			->add_rule('array_key_exists', Controller_Clinic_Auth::$prefecture);
		
		$form->add('address', '市区町村以下の住所', array(
			'placeholder'	=> '練馬区東大泉1-1-1',
			'class'			=> 'form-control detailinput',
			'value'			=> $data['profile']['address'],
			))
			->add_rule(function($form) { return mb_convert_kana($form, 'n');})
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab_and_newline')
			->add_rule('max_length', 90);
		
		$form->add('phone_number', '電話番号', array(
			'placeholder'	=> '',
			'class'			=> 'form-control detailinput',
			'value'			=> $data['profile']['phone_number'],
			))
			->add_rule(function($form) { return mb_convert_kana($form, 'rn');})
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab_and_newline')
			->add_rule('phone_number')
			->add_rule('max_length', 15);
			
		$form->add('start_time', '診療開始時間', array(
			'placeholder'	=> '9:00',
			'class'			=> 'form-control detailinput',
			'value'			=> (isset($data['profile']['start_time'])) ? $data['profile']['start_time'] : '',
			))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab_and_newline')
			->add_rule('max_length', 10);
		
		$form->add('end_time', '診療終了時間', array(
			'placeholder'	=> '17:00',
			'class'			=> 'form-control detailinput',
			'value'			=> (isset($data['profile']['end_time'])) ? $data['profile']['end_time'] : '',
			))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab_and_newline')
			->add_rule('max_length', 10);
		
		$form->add('closed_day', '休診日', array(
			'placeholder'	=> '水曜日',
			'class'			=> 'form-control detailinput',
			'value'			=> (isset($data['profile']['closed_day'])) ? $data['profile']['closed_day'] : '',
			))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab_and_newline')
			->add_rule('max_length', 10);
		
		$realm_ops = array(
			''			=> '',
			'1次診療'	=> '1次診療',
			'1.5次診療'	=> '1.5次診療',
			'2次診療'	=> '2次診療',			
		);
		
		$form->add('therapy_realm', '診療領域', array(
			'options'	=> $realm_ops,
			'type'		=> 'select',
			'class'		=> 'form-control detailinput',
			'value'		=> (isset($data['profile']['therapy_realm'])) ? $data['profile']['therapy_realm'] : '',
			))
			->add_rule('required')
			->add_rule('array_key_exists', $realm_ops);
		
		$form->add('apparatus', '主な医療機器', array(
			'placeholder'	=> 'レントゲン、CTなど',
			'class'			=> 'form-control detailinput',
			'value'			=> (isset($data['profile']['apparatus'])) ? $data['profile']['apparatus'] : '',
			))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab_and_newline')
			->add_rule('max_length', 100);
		
		$form->add('doctor_number', '獣医師の人数', array(
			'placeholder'	=> '半角もしくは全角の数字',
			'class'			=> 'form-control detailinput',
			'value'			=> (isset($data['profile']['doctor_number'])) ? $data['profile']['doctor_number'] : '',
			))
			->add_rule(function($form) { return mb_convert_kana($form, 'n');})
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab_and_newline')
			->add_rule('valid_string', array('numeric'))
			->add_rule('max_length', 2);
			
		$form->add('nurse_number', '看護師の人数', array(
			'placeholder'	=> '半角もしくは全角の数字',
			'class'			=> 'form-control detailinput',
			'value'			=> (isset($data['profile']['nurse_number'])) ? $data['profile']['nurse_number'] : '',
			))
			->add_rule(function($form) { return mb_convert_kana($form, 'n');})
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab_and_newline')
			->add_rule('valid_string', array('numeric'))
			->add_rule('max_length', 2);
			
		$form->add('staff_number', 'その他スタッフの人数', array(
			'placeholder'	=> '半角もしくは全角の数字',
			'class'			=> 'form-control detailinput',
			'value'			=> (isset($data['profile']['staff_number'])) ? $data['profile']['staff_number'] : '',
			))
			->add_rule(function($form) { return mb_convert_kana($form, 'n');})
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab_and_newline')
			->add_rule('valid_string', array('numeric'))
			->add_rule('max_length', 2);
			
		$form->add('submit', '', array(
			'type'	=> 'submit',
			'value'	=> '登録内容の確認',
			'class'	=> 'btn btn-primary btn-lg'));
		
		return $form;
	}

	public function action_set_detail()
	{
		$data['profile'] = Model_Clinic_Mypage::get_c_profile_array();
		
		$form = $this->forge_set_detail_form();
		
		if (Input::method() === 'POST')
		{
			$form->repopulate();
		}
		
		
		$this->template->title		= '病院情報の登録・修正';
		$this->template->submenu	= View::forge('clinic/mypage/submenu', $data);
		$this->template->content	= View::forge('clinic/mypage/set_detail', $data);
		$this->template->content->set_safe('c_detail_form', $form->build('clinic/mypage/confirm_detail'));
	}
	
	public function action_confirm_detail()
	{
		$data['profile'] = Model_Clinic_Mypage::get_c_profile_array();
		
		$form = $this->forge_set_detail_form();
		$val = $form->validation()->add_callable('MyValidationRules');
		
		if ( ! $val->run()) 
		{
			$form->repopulate();
			$this->template->title		= '病院情報の修正';
			$this->template->submenu	= View::forge('clinic/mypage/submenu', $data);
			$this->template->content	= View::forge('clinic/mypage/set_detail', $data);
			$this->template->content->set_safe('set_error', $val->show_errors());
			$this->template->content->set_safe('c_detail_form', $form->build('clinic/mypage/confirm_detail'));
			return;
		}
		
		$data['input'] = $val->validated();
		// 都道府県コード→都道府県名
		$data['input']['prefecture_jp'] = Controller_Clinic_Auth::$prefecture[$data['input']['prefecture']];
		
		$this->template->title		= '病院情報の確認';
		$this->template->submenu	= View::forge('clinic/mypage/submenu', $data);
		$this->template->content	= View::forge('clinic/mypage/set_detail_confirm', $data);
	}
	
	public function action_set_detail_completion()
	{
		if ( ! Security::check_token())
		{
			throw new HttpInvalidInputException('ただしいページ遷移ではありません。');
		}
		
		$data['profile'] = Model_Clinic_Mypage::get_c_profile_array();
		$form = $this->forge_set_detail_form();
		$val = $form->validation()->add_callable('MyValidationRules');
		
		if ( ! $val->run())
		{
			$form->repopulate();
			$this->template->title		= '登録内容のエラー';
			$this->template->content	= View::forge('clinic/mypage/set_detail');
			$this->template->submenu	= View::forge('clinic/mypage/submenu', $data);
			$this->template->content->set_safe('set_error', $val->show_errors());
			$this->template->content->set_safe('c_detail_form', $form->build('clinic/mypage/set_detail_confirm'));
			return;
		}
		
		// 都道府県コード→都道府県名
		$prefecture_jp = Controller_Clinic_Auth::$prefecture[input::post('prefecture')];
		
		$c_name			= Input::post('c_name');
		$l_name			= Input::post('l_name');
		$f_name			= Input::post('f_name');
		$l_name_kana	= Input::post('l_name_kana');
		$f_name_kana	= Input::post('f_name_kana');
		$zip			= Input::post('zip1').Input::post('zip2');
		$prefecture		= $prefecture_jp;
		$address		= Input::post('address');
		$phone_number	= Input::post('phone_number');
		$start_time		= Input::post('start_time');
		$end_time		= Input::post('end_time');
		$closed_day		= Input::post('closed_day');
		$therapy_realm	= Input::post('therapy_realm');
		$apparatus		= Input::post('apparatus');
		$doctor_number	= Input::post('doctor_number');
		$nurse_number	= Input::post('nurse_number');
		$staff_number	= Input::post('staff_number');
		
		
		$profile_array = array(
			'c_name'		=> $c_name,
			'l_name'		=> $l_name,
			'f_name'		=> $f_name,
			'l_name_kana'	=> $l_name_kana,
			'f_name_kana'	=> $f_name_kana,
			'zip'			=> $zip,
			'prefecture'	=> $prefecture,
			'address'		=> $address,
			'phone_number'	=> $phone_number,
			'start_time'	=> $start_time,
			'end_time'		=> $end_time,
			'closed_day'	=> $closed_day,
			'therapy_realm'	=> $therapy_realm,
			'apparatus'		=> $apparatus,
			'doctor_number'	=> $doctor_number,
			'nurse_number'	=> $nurse_number,
			'staff_number'	=> $staff_number,
			'update_check'	=> 'yes',
		);
		
		$auth  = Auth::instance('Clinicauth');
		if ( ! $auth->update_user($profile_array))
		{ 
			$form->repopulate();
			$this->template->title		= '登録のエラー';
			$this->template->content	= View::forge('clinic/mypage/set_detail');
			$this->template->submenu	= View::forge('clinic/mypage/submenu', $data);
			$this->template->content->set_safe('set_error', $val->show_errors());
			$this->template->content->set_safe('c_set_form', $form->build('clinic/mypage/set_detail_confirm'));
			return;
		}
		
		$this->template->title = '病院情報の更新完了';
		$this->template->submenu = View::forge('clinic/mypage/submenu', $data);
		$this->template->content = View::forge('clinic/mypage/set_detail_completion');
	}
	
	protected function forge_offer_form()
	{
		if (Model_Clinic_Mypage::count_how_many_offers() == 1)
		{
			// 求人用のテキスト配列をoffersテーブルから取得。
			$data = Model_Clinic_Mypage::get_offer_array();
			
		}
		
		$form = Fieldset::forge();
		
		$form->add('catchcopy', '簡単な病院のキャッチコピーを教えて下さい。（50文字以内）', array(
			'class'	=> 'form-control offertextarea',
			'value'	=> (isset($data['catchcopy'])) ? $data['catchcopy'] : '',
			))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab_and_newline')
			->add_rule('max_length', 50);
		
		$form->add('operation', '病院の症例数、手術数をくわしく教えてください。（200文字以内）', array(
			'type'	=> 'textarea',
			'cols'	=> 70,
			'rows'	=> 6,
			'class'	=> 'form-control offertextarea',
			'value'	=> (isset($data['operation'])) ? $data['operation'] : '',
			))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab')
			->add_rule('max_length', 200);
		
		$form->add('realm', '力を入れている分野、治療法などについて教えて下さい。（200文字以内）', array(		
			'type'	=> 'textarea',
			'cols'	=> 70,
			'rows'	=> 6,
			'class'	=> 'form-control offertextarea',
			'value'	=> (isset($data['realm'])) ? $data['realm'] : '',
			))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab')
			->add_rule('max_length', 200);
		
		$form->add('career', '獲得できる手技や裁量の広がり方、キャリア形成についてくわしく教えて下さい。（200文字以内）', array(
			'type'	=> 'textarea',
			'cols'	=> 70,
			'rows'	=> 6,
			'class'	=> 'form-control offertextarea',
			'value'	=> (isset($data['career'])) ? $data['career'] : '',
			))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab')
			->add_rule('max_length', 200);
		
		$form->add('training', '新卒獣医師の育成方針についてくわしく教えて下さい。（200文字以内）', array(
			'type'	=> 'textarea',
			'cols'	=> 70,
			'rows'	=> 6,
			'class'	=> 'form-control offertextarea',
			'value'	=> (isset($data['training'])) ? $data['training'] : '',
			))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab')
			->add_rule('max_length', 200);
		
		$form->add('salary', '給与体系や保険について、できるだけ具体的に教えてください。（200文字以内）', array(
			'type'	=> 'textarea',
			'cols'	=> 70,
			'rows'	=> 6,
			'class'	=> 'form-control offertextarea',
			'value'	=> (isset($data['salary'])) ? $data['salary'] : '',
			))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab')
			->add_rule('max_length', 200);
		
		$form->add('working_hour', '労働時間や残業時間、残業手当について具体的に教えてください。（200文字以内）', array(
			'type'	=> 'textarea',
			'cols'	=> 70,
			'rows'	=> 6,
			'class'	=> 'form-control offertextarea',
			'value'	=> (isset($data['working_hour'])) ? $data['working_hour'] : '',
			))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab')
			->add_rule('max_length', 200);
		
		$form->add('graduation', '働いている獣医師の主な出身大学について教えて下さい。（200文字以内）', array(
			'type'	=> 'textarea',
			'cols'	=> 70,
			'rows'	=> 6,
			'class'	=> 'form-control offertextarea',
			'value'	=> (isset($data['graduation'])) ? $data['graduation'] : '',
			))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab')
			->add_rule('max_length', 200);
		
		$form->add('environment', '動物病院の周囲の居住環境や交通の便について教えて下さい。（200文字以内）', array(
			'type'	=> 'textarea',
			'cols'	=> 70,
			'rows'	=> 6,
			'class'	=> 'form-control offertextarea',
			'value'	=> (isset($data['environment'])) ? $data['environment'] : '',
			))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab')
			->add_rule('max_length', 200);
		
		$form->add('future', '動物病院の目指す将来像について教えて下さい。（200文字以内）', array(
			'type'	=> 'textarea',
			'cols'	=> 70,
			'rows'	=> 6,
			'class'	=> 'form-control offertextarea',
			'value'	=> (isset($data['future'])) ? $data['future'] : '',
			))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab')
			->add_rule('max_length', 200);
		
		$form->add('message', '学生に対して発信したいメッセージを自由に記入してください。（200文字以内）', array(
			'type'	=> 'textarea',
			'cols'	=> 70,
			'rows'	=> 6,
			'class'	=> 'form-control offertextarea',
			'value'	=> (isset($data['message'])) ? $data['message'] : '',
			))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab')
			->add_rule('max_length', 200);
		
		$form->add('submit', '', array(
			'type'	=> 'submit',
			'value'	=> '登録内容を確認する',
			'class' => 'btn btn-primary btn-lg',
		));
		
		return $form;
	}

	public function action_offer_register()
	{
		$data['profile'] = Model_Clinic_Mypage::get_c_profile_array();
		
		$profile_check = new Model_Clinic_Mypage();
		$update_check = $profile_check->c_profile_comletion_check();
		if ( $update_check )
		{
			$form = $this->forge_offer_form();
			if (Input::method() === 'POST')
			{
				$form->repopulate();
			}
			
			$this->template->title		= '求人の掲載・編集';
			$this->template->submenu	= View::forge('clinic/mypage/submenu', $data);
			$this->template->content = View::forge('clinic/mypage/offer_register', $data);
			$this->template->content->set_safe('offer_form', $form->build('clinic/mypage/offer_confirm'));
			return;
		}
		
		$this->template->title		= '求人を掲載するために';
		$this->template->submenu	= View::forge('clinic/mypage/submenu', $data);
		$this->template->content	= View::forge('error');
		$this->template->content->set_safe('error_title', '求人を掲載される前に');
		$this->template->content->set('error_content', ''
			. '<p>求人を掲載するためには、病院情報を入力する必要があります。</p>'
			. '<p>病院情報の入力は５分で終了します。</p>'
			. '<p>'.Html::anchor(Uri::base().'clinic/mypage/set_detail',
				'病院情報を入力する',
				array('class' => 'btn btn-primary btn-lg')).'<p/>', false);
	}
	
	public function action_offer_confirm()
	{
		$data['profile'] = Model_Clinic_Mypage::get_c_profile_array();
		$form = $this->forge_offer_form();
		$val = $form->validation()->add_callable('MyValidationRules');
		
		if ( ! $val->run())
		{
			$this->template->title		= '掲載内容の確認';
			$this->template->submenu	= View::forge('clinic/mypage/submenu', $data);
			$this->template->content	= View::forge('clinic/mypage/offer_register', $data);
			$this->template->content->set_safe('register_error', $val->show_errors());
			return;
		}
		
			$data['input'] = $val->validated();
			
			$this->template->title		= '求人の掲載・編集';
			$this->template->submenu	= View::forge('clinic/mypage/submenu', $data);
			$this->template->content	= View::forge('clinic/mypage/offer_confirm', $data);
			$this->template->content->set_safe('offer_form', $form->build('clinic/mypage/offer_confirm'));
			
	}

	public function action_offer_completion()
	{
		if ( ! Security::check_token())
		{
			throw new HttpInvalidInputException('ただしいページ遷移ではありません。');
		}
		
		$data['profile'] = Model_Clinic_Mypage::get_c_profile_array();
		$form = $this->forge_offer_form();
		$val = $form->validation()->add_callable('MyValidationRules');
		
		if ( ! $val->run())
		{
			$this->template->title		= '掲載内容の確認';
			$this->template->submenu	= View::forge('clinic/mypage/submenu', $data);
			$this->template->content	= View::forge('clinic/mypage/offer_register', $data);
			$this->template->content->set_safe('register_error', $val->show_errors());
			return;
		}
		
		
		$input_array = array(
			'catchcopy'		=> Input::post('catchcopy'),
			'operation'		=> Input::post('operation'),
			'realm'			=> Input::post('realm'),
			'career'		=> Input::post('career'),
			'training'		=> Input::post('training'),
			'salary'		=> Input::post('salary'),
			'working_hour'	=> Input::post('working_hour'),
			'graduation'	=> Input::post('graduation'),
			'environment'	=> Input::post('environment'),
			'future'		=> Input::post('future'),
			'message'		=> Input::post('message'),
		);
			
		if (Model_Clinic_Mypage::count_how_many_offers() == 0)
		{
		
			$auth = Auth::instance('Clinicauth');
			$c_username = $auth->get('username');
			$offer_information_array = array(
				'c_username'	=> $c_username,
				'catchcopy'		=> $input_array['catchcopy'],
				'operation'		=> $input_array['operation'],
				'realm'			=> $input_array['realm'],
				'career'		=> $input_array['career'],
				'training'		=> $input_array['training'],
				'salary'		=> $input_array['salary'],
				'working_hour'	=> $input_array['working_hour'],
				'graduation'	=> $input_array['graduation'],
				'environment'	=> $input_array['environment'],
				'future'		=> $input_array['future'],
				'message'		=> $input_array['message'],
			);

			try{
				if (Model_Clinic_Mypage::register_offer($offer_information_array) != 1)
				{
					$this->template->title		= 'データベースエラー';
					$this->template->submenu	= View::forge('clinic/mypage/submenu', $data);
					$this->template->content	= View::forge('error');
					$this->template->content->set_safe('error_title', 'データベースエラー');
					$this->template->content->set('error_content', ''
						. '<p>データベースへの登録が失敗しました。お手数おかけしますがもう一度ご登録ください。</p>'
						. '<p>'.Html::anchor(Uri::base().'clinic/mypage/offer_register',
							'求人情報を掲載する',
							array('class' => 'btn btn-primary btn-lg')).'<p/>', false);
					return;
				}

				$this->template->title		= '求人を掲載しました。';
				$this->template->submenu	= View::forge('clinic/mypage/submenu', $data);
				$this->template->content	= View::forge('clinic/mypage/register_completion', $data);

			}
			catch (ClinicUserNotLoginException $e)
			{
				echo $e;
			}
			
		}
		elseif (Model_Clinic_Mypage::count_how_many_offers() == 1)
		{
			try{
				if (Model_Clinic_Mypage::update_offer($input_array) != 1)
				{
					$this->template->title		= '求人更新エラー';
					$this->template->submenu	= View::forge('clinic/mypage/submenu', $data);
					$this->template->content	= View::forge('error');
					$this->template->content->set_safe('error_title', '求人更新エラー');
					$this->template->content->set('error_content', ''
						. '<p>求人内容に変更がなかったため更新されませんでした。</p>'
						. '<p>'.Html::anchor(Uri::base().'clinic/mypage/offer_register',
							'求人情報を編集する',
							array('class' => 'btn btn-primary btn-lg')).'<p/>', false);
					return;
				}

				$this->template->title		= '求人を編集しました。';
				$this->template->submenu	= View::forge('clinic/mypage/submenu', $data);
				$this->template->content	= View::forge('clinic/mypage/register_completion', $data);

			}
			catch (ClinicUserNotLoginException $e)
			{
				echo $e;
			}
		}
		else // DBの求人レコード数が０でも１でもない。
		{
			$this->template->title		= 'データベースエラー';
			$this->template->submenu	= View::forge('clinic/mypage/submenu', $data);
			$this->template->content	= View::forge('error');
			$this->template->content->set_safe('error_title', 'データベースエラー');
			$this->template->content->set('error_content', ''
				. '<p>データベースへの登録が失敗しました。お手数おかけしますがもう一度ご登録ください。</p>'
				. '<p>'.Html::anchor(Uri::base().'clinic/mypage/offer_register',
					'求人情報を掲載する',
					array('class' => 'btn btn-primary btn-lg')).'<p/>', false);
			return;
		}
		
	}
	
	public function action_upload_images()
	{
		$data['profile'] = Model_Clinic_Mypage::get_c_profile_array();
		
		$profile_check = new Model_Clinic_Mypage();
		$update_check = $profile_check->c_profile_comletion_check();
		if ( ! $update_check)
		{
			$this->template->title		= '求人用画像のアップロード';
			$this->template->submenu	= View::forge('clinic/mypage/submenu', $data);
			$this->template->content	= View::forge('error');
			$this->template->content->set_safe('error_title', '画像をアップロードされる前に');
			$this->template->content->set('error_content', ''
				. '<p>求人用の画像をアップロードするためには、病院情報を入力する必要があります。</p>'
				. '<p>病院情報の入力は５分で終了します。</p>'
				. '<p>'.Html::anchor(Uri::base().'clinic/mypage/set_detail',
					'病院情報を入力する',
					array('class' => 'btn btn-primary btn-lg')).'<p/>', false);
			return;
		}
		
		$auth = Auth::instance('Clinicauth');
		$c_username = $auth->get('username');
		list($data['c_image'], $data['r_image']) = Model_Offers::fetch_c_images($c_username);
			
		$this->template->title		= '求人用画像のアップロード';
		$this->template->submenu	= View::forge('clinic/mypage/submenu', $data);
		$this->template->content	= View::forge('clinic/mypage/upload_images', $data);
	}
	
	public function action_upload_images_completion()
	{	
		if (Input::method() == 'POST')
		{
			$data['profile'] = Model_Clinic_Mypage::get_c_profile_array();
			
			$config = Model_Clinic_Mypage::upload_image_config();
			Upload::process($config);
			
			if (Upload::is_valid())
			{
				Upload::save();
                
				foreach (Upload::get_files() as $file)
				{
					Model_Clinic_Mypage::upload_image($file);	
				}
				
			}
			
			if (Upload::get_errors() == NULL)
			{
				$this->template->title		= 'アップロードに成功しました';
				$this->template->submenu	= View::forge('clinic/mypage/submenu', $data);
				$this->template->content	= View::forge('clinic/mypage/upload_images_completion', $data);
				return;
			}
			
			// アップロードエラーがある場合の処理。
			$data['upload_error'] = array();
			
			foreach (Upload::get_errors() as $i)
			{
				// エラーメッセージも多次元配列の構造
				$error_message = '';
				foreach ($i['errors'] as $j)
				{
					$error_message .= $j['message'];
				}
				
				if ($i['field'] == 'c_image')
				{
					array_push($data['upload_error'], '動物病院の写真はアップロードされませんでした。：'.$error_message);
				}
				elseif ($i['field'] == 'r_image')
				{
					array_push($data['upload_error'], '代表者の写真はアップロードされませんでした。：'.$error_message);
				}
			}
			
			$this->template->title		= 'アップロードエラー';
			$this->template->submenu	= View::forge('clinic/mypage/submenu', $data);
			$this->template->content	= View::forge('clinic/mypage/upload_images_error', $data);
			return;
		}
		
		// in the case of Input::method() != 'POST'
		Response::redirect(Uri::base().'clinics/mypage/upload_images');
	}
	
	public function action_delete_images()
	{
		if (Input::method() == 'POST')
		{
			$image_name = Input::post('image_name');
			
			$data['profile'] = Model_Clinic_Mypage::get_c_profile_array();
			
			if (Model_Clinic_Mypage::delete_image($image_name))
			{
				$image_name_array = array('c_image' => '動物病院の写真', 'r_image' => '代表者の写真');
				$message = $image_name_array[$image_name].'の写真を削除しました。';
				
				$this->template->title		= $image_name_array[$image_name].'の写真を削除しました。';
				$this->template->submenu	= View::forge('clinic/mypage/submenu', $data);
				$this->template->content	= View::forge('clinic/mypage/delete_images');
				$this->template->content->set_safe('delete_message', $message);
				return;
			}
			
				$message = '写真の削除に失敗しました。';
				
				$this->template->title		= '写真の削除に失敗しました。';
				$this->template->submenu	= View::forge('clinic/mypage/submenu', $data);
				$this->template->content	= View::forge('clinic/mypage/delete_images');
				$this->template->content->set_safe('delete_message', $message);
				return;
		}
		
		// in the case of Input::method() != 'POST'
		Response::redirect(Uri::base().'clinics/mypage/upload_images');
	}
	
	public function forge_check_offer_validation()
	{
		$val = Validation::forge();
		
		$val->add('reception', '募集状況')
			->add_rule('required')
			->add_rule('trim')
			->add_rule('no_tab_and_newline')
			->add_rule('valid_string', array('numeric'))
			->add_rule('max_length', 2);
		
		return $val;
	}
	
	public function action_check_offer()
	{
		$data['profile'] = Model_Clinic_Mypage::get_c_profile_array();
		
		$profile_check = new Model_Clinic_Mypage();
		$update_check = $profile_check->c_profile_comletion_check();
		if ( ! $update_check)
		{
			$this->template->title		= '求人を掲載するために';
			$this->template->submenu	= View::forge('clinic/mypage/submenu', $data);
			$this->template->content	= View::forge('error');
			$this->template->content->set_safe('error_title', '求人を掲載される前に');
			$this->template->content->set('error_content', ''
				. '<p>求人を掲載するためには、病院情報を入力する必要があります。</p>'
				. '<p>病院情報の入力は５分で終了します。</p>'
				. '<p>'.Html::anchor(Uri::base().'clinic/mypage/set_detail',
					'病院情報を入力する',
					array('class' => 'btn btn-primary btn-lg')).'<p/>', false);
			return;
		}
		
		if (Model_Clinic_Mypage::count_how_many_offers() != 1)
		{
			$this->template->title		= '現在掲載されている求人はありません';
			$this->template->submenu	= View::forge('clinic/mypage/submenu', $data);
			$this->template->content	= View::forge('error');
			$this->template->content->set_safe('error_title', 'ぜひ求人を掲載してください！');
			$this->template->content->set('error_content', ''
				. '<p>求人の掲載中でも学生の面談・実習の受付の可否を設定することができます。</p>'
				. '<p>動物病院を広く知ってもらうためにも、ぜひ求人を掲載してください！</p>'
				. '<p>'.Html::anchor(Uri::base().'clinic/mypage/offer_register',
					'求人情報を入力する',
					array('class' => 'btn btn-primary btn-lg')).'<p/>', false);
			return;
		}
		
		if (Input::method() == 'POST')
		{
			if ( ! Security::check_token())
			{
				throw new HttpInvalidInputException('ただしいページ遷移ではありません。');
			}
		
			$val = $this->forge_check_offer_validation()->add_callable('MyValidationRules');
			
			if( ! $val->run())
			{
				$this->template->title		= '求人の管理';
				$this->template->submenu	= View::forge('clinic/mypage/submenu', $data);
				$this->template->content	= View::forge('clinic/mypage/check_offer', $data);
				$this->template->content->set_safe('reaction', $val->show_errors());
				return;
			}
			
			$input = $val->validated();
			$row_affected = Model_Clinic_Mypage::change_reception($input['reception']);
			$status = Model_Offers::get_c_reception_status($input['reception']);
			$data['reaction'] = $row_affected != 0?
				'求人の募集状況を「'.$status.'」に変更しました。':
				'募集状況は変更されませんでした。';
		}
		
		$data['offer'] = Model_Clinic_Mypage::get_offer_array();
		$data['offer']['reception'] = Model_Offers::get_c_reception_status($data['offer']['reception']);
		
		$auth = Auth::instance('Clinicauth');
		$data['c_id'] = $auth->get('id');
		
		$this->template->title		= '求人の管理';
		$this->template->submenu	= View::forge('clinic/mypage/submenu', $data);
		$this->template->content	= View::forge('clinic/mypage/check_offer', $data);
		return;
	}
	
	public function action_check_apply()
	{
		$data['profile'] = Model_Clinic_Mypage::get_c_profile_array();
		list($data['apply_count'],$data['apply_array']) = Model_Clinic_Mypage::check_apply(false);
		
		if ($data['apply_count'] == 0)
		{
			$this->template->title		= '応募求人一覧';
			$this->template->submenu	= View::forge('clinic/mypage/submenu', $data);
			$this->template->content	= View::forge('error');
			$this->template->content->set_safe('error_title', '現在応募のある求人はありません');
			$this->template->content->set('error_content', ''
				. '<p>求人に応募があった場合、登録されたメールアドレス宛に通知が届きます。</p>', false);
			return;
		}

		$this->template->title		= '応募一覧';
		$this->template->submenu	= View::forge('clinic/mypage/submenu', $data);
		$this->template->content	= View::forge('clinic/mypage/check_apply', $data);
		return;
	}
	
	public function action_apply_detail($apply_id = NULL)
	{
		if ($apply_id == NULL)
		{
			throw new HttpNotFoundException;
		}
		
		$data['profile'] = Model_Clinic_Mypage::get_c_profile_array();
		list($apply_count, $data['apply_array']) = Model_Clinic_Mypage::get_apply_detail($apply_id);
		
		if ($apply_count == 0 || $apply_count == NULL)
		{
			throw new HttpNotFoundException;
		}
		
		// 未読→既読
		if ($data['apply_array']['already_read'] == 0)
		{
			Model_Clinic_Mypage::make_apply_already_read($apply_id);
		}
		
		$data['apply_array']['array_id'] = $apply_id;
		$data['apply_array']['zip3'] = Str::zip_shaping($data['apply_array']['zip'])['zip3'];
		$data['apply_array']['zip4'] = Str::zip_shaping($data['apply_array']['zip'])['zip4'];
		
		
		$this->template->title		= '応募内容詳細';
		$this->template->submenu	= View::forge('clinic/mypage/submenu', $data);
		$this->template->content	= View::forge('clinic/mypage/apply_detail', $data);
		return;
	}
	
	public function forge_report_validation()
	{
		$val = Validation::forge();
		
		$val->add('contents', '実施内容')
			->add_rule('required')
			->add_rule('trim')
			->add_rule('no_tab_and_newline')
			->add_rule('max_length', 30);
		
		$val->add('result', 'マッチング状況')
			->add_rule('required')
			->add_rule('trim')
			->add_rule('no_tab_and_newline')
			->add_rule('max_length', 30);
		
		$val->add('improvement', '不便だった点')
			->add_rule('trim')
			->add_rule('no_tab')
			->add_rule('max_length', 200);
		
		return $val;
	}
	
	public function action_report($apply_id = NULL)
	{
		if ($apply_id == NULL)
		{
			throw new HttpNotFoundException;
		}
		
		$data['profile'] = Model_Clinic_Mypage::get_c_profile_array();
		list($apply_count, $data['apply_array']) = Model_Clinic_Mypage::get_apply_detail($apply_id);
		
		if ($apply_count == 0 || $apply_count == NULL)
		{
			throw new HttpNotFoundException;
		}
		
		if ($data['apply_array']['already_read'] == 2)
		{
			$this->template->title		= '報告済みの求人です。';
			$this->template->submenu	= View::forge('clinic/mypage/submenu', $data);
			$this->template->content	= View::forge('error');
			$this->template->content->set_safe('error_title', '報告済みの求人です。');
			$this->template->content->set('error_content', ''
				. '<p>この求人は既に対応済みの求人です。</p>' , false);
			return;
		}
		
		$this->template->title		= '最終報告';
		$this->template->submenu	= View::forge('clinic/mypage/submenu', $data);
		$this->template->content	= View::forge('clinic/mypage/report', $data);
		return;
	}
	
	public function action_report_completion($apply_id = NULL)
	{
		if ( ! Security::check_token())
		{
			throw new HttpInvalidInputException('ただしいページ遷移ではありません。');
		}
		
		if ($apply_id == NULL)
		{
			throw new HttpNotFoundException;
		}
		
		if (Input::method() != 'POST')
		{
			throw new HttpNotFoundException;
		}
		
		$data['profile'] = Model_Clinic_Mypage::get_c_profile_array();
		list($apply_count, $data['apply_array']) = Model_Clinic_Mypage::get_apply_detail($apply_id);
		
		if ($apply_count == 0 || $apply_count == NULL)
		{
			throw new HttpNotFoundException;
		}
		
		$val = $this->forge_report_validation()->add_callable('MyValidationRules');
		
		if ( ! $val->run())
		{
			$this->template->title		= '最終報告';
			$this->template->submenu	= View::forge('clinic/mypage/submenu', $data);
			$this->template->content	= View::forge('clinic/mypage/report', $data);
			$this->template->content->set_safe('report_error', $val->show_errors());
			return;
		}
		
		$input = $val->validated();
		$report_array = array('contents' => $input['contents'], 'result' => $input['result'], 'improvement' => $input['improvement']);
		if ( ! Model_Clinic_Mypage::report($apply_id, $report_array))
		{
			$this->template->title		= 'データベースエラー';
			$this->template->submenu	= View::forge('clinic/mypage/submenu', $data);
			$this->template->content	= View::forge('error');
			$this->template->content->set_safe('error_title', 'データベースエラー');
			$this->template->content->set('error_content', ''
				. '<p>データベースのエラーが発生しました。お手数おかけしますがもう一度お試しください。</p>', false);
			return;
		}
		
			$this->template->title		= '報告が完了しました';
			$this->template->submenu	= View::forge('clinic/mypage/submenu', $data);
			$this->template->content	= View::forge('clinic/mypage/report_completion');
			return;
	}
}
