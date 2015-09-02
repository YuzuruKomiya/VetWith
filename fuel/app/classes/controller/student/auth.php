<?php

class Controller_Student_Auth extends Controller_Template_StudentAuthTemplate
{	
	/**
	 * 本登録用のフォームの定義
	 * 
	 */
	protected function forge_register_form($preuser_id)
	{
		Config::load('studentauth', true);
		$preuser = new Model_Student_Auth();
		$s_email = $preuser->search_for_email_by_preuser_id($preuser_id);
		
		$form = Fieldset::forge('', array('form_attributes' => array(
			'class' => '')));
		
		$form->add('preuser_id', '', array(
			'type'		=> 'hidden',
			'value'		=> $preuser_id,
		));
		
		$form->add('s_username', 'ユーザーネーム', array('placeholder' => '8文字以上16文字以下の英数字', 'class' => 'form-control'))
			->add_rule(function($form) { return mb_convert_kana($form, 'rn');})
			->add_rule('trim')
			->add_rule('required')
			->add_rule('min_length', 8)
			->add_rule('max_length', 16)
			->add_rule('no_tab_and_newline')
			->add_rule('only_numeric_and_alpha')
			->add_rule('unique', Config::get('studentauth.table_name').'.username');

		$form->add('l_name', '名字', array('placeholder' => '姓', 'class' => 'form-control'))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('min_length', 1)
			->add_rule('max_length', 10)
			->add_rule('no_tab_and_newline');
		
		$form->add_after('f_name', '名前', array('placeholder' => '名', 'class' => 'form-control'), array(
				array('trim'),
				array('required'),
				array('min_length', 1),
				array('max_length', 10),
				array('no_tab_and_newline'),
			), 'l_name');
		
		$form->add('l_name_kana', '名字のカナ', array('placeholder' => '姓のカナ', 'class' => 'form-control'))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('min_length', 1)
			->add_rule('max_length', 10)
			->add_rule('only_katakana')
			->add_rule('no_tab_and_newline');
		
		$form->add_after('f_name_kana', '名前のカナ', array('placeholder' => '名のカナ', 'class' => 'form-control'), array(
				array('trim'),
				array('required'),
				array('min_length', 1),
				array('max_length', 10),
				array('only_katakana'),
				array('no_tab_and_newline'),
			), 'l_name_kana');
		
		// ユーザーは編集できない。データの送信はする。
		// 不正対策にメールアドレスは受け手のモデルでも再度チェック。
		$form->add('s_email', 'メールアドレス', array(
			'value'		=> $s_email,
			'class' => 'form-control',
			'readonly',
		))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab_and_newline')
			->add_rule('max_length', 100)
			->add_rule('valid_email');
		
		$form->add('birthday', '生年月日', array('placeholder' => '19900522', 'class' => 'form-control'))
			->add_rule(function($form) { return mb_convert_kana($form, 'n');})
			->add_rule('trim')
			->add_rule('required')
			->add_rule('valid_date', 'Ymd');
		
		$ops_gender = array(
			'男性' => '男性',
			'女性' => '女性'
		);
		
		$form->add('gender', '性別',
			array('options' =>$ops_gender, 'type' => 'radio', 'class' => ''))
			->add_rule('required')
			->add_rule('in_array', $ops_gender);
		
		$ops_university = array(
			''						=> '',
			'酪農学園大学'			=> '酪農学園大学',
			'北海道大学'				=> '北海道大学',
			'帯広畜産大学'			=> '帯広畜産大学',
			'北里大学'				=> '北里大学',
			'岩手大学'				=> '岩手大学',
			'東京大学'				=> '東京大学',
			'東京農工大学'			=> '東京農工大学',
			'日本大学'				=> '日本大学',
			'麻布大学'				=> '麻布大学',
			'日本獣医生命科学大学'	=> '日本獣医生命科学大学',
			'岐阜大学'				=> '岐阜大学',
			'大阪府立大学'			=> '大阪府立大学',
			'鳥取大学'				=> '鳥取大学',
			'山口大学'				=> '山口大学',
			'宮崎大学'				=> '宮崎大学',
			'鹿児島大学'				=> '鹿児島大学',
		);
		
		$form->add('university', '大学',
			array('options' => $ops_university, 'type' => 'select', 'class' => 'form-control'))
			->add_rule('required')
			->add_rule('in_array', $ops_university);
		
		$ops_grade = array(
			''			=> '',
			'学部1年'	=> '学部1年',
			'学部2年'	=> '学部2年',
			'学部3年'	=> '学部3年',
			'学部4年'	=> '学部4年',
			'学部5年'	=> '学部5年',
			'学部6年'	=> '学部6年',
			'博士1年'	=> '博士1年',
			'博士2年'	=> '博士2年',
			'博士3年'	=> '博士3年',
			'博士4年'	=> '博士4年',
			'その他'		=> 'その他',
		);
		
		$form->add('grade', '学年',
			array('options' => $ops_grade, 'type' => 'select', 'class' => 'form-control'))
			->add_rule('required')
			->add_rule('in_array', $ops_grade);
		
		$form->add('zip1', '郵便番号上３桁', array('placeholder' => '123', 'class' => 'form-control'))
			->add_rule(function($form) { return mb_convert_kana($form, 'n');})
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab_and_newline')
			->add_rule('valid_string', array('numeric'))
			->add_rule('exact_length', 3);
		
		$form->add('zip2', '郵便番号下４桁', array('placeholder' => '4567', 'class' => 'form-control', 'onKeyUp' => 'AjaxZip3.zip2addr(\'zip1\',\'zip2\',\'prefecture\',\'address\')'))
			->add_rule(function($form) { return mb_convert_kana($form, 'n');})
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab_and_newline')
			->add_rule('valid_string', array('numeric'))
			->add_rule('exact_length', 4);
		
		$form->add('prefecture', '都道府県',
			array('options' => Controller_Clinic_Auth::$prefecture, 'type' => 'select', 'class' => 'form-control'))
			->add_rule('required')
			->add_rule('array_key_exists', Controller_Clinic_Auth::$prefecture);
		
		$form->add('address', '市区町村以下の住所', array('placeholder' => '練馬区東大泉1-1-1', 'class' => 'form-control'))
			->add_rule(function($form) { return mb_convert_kana($form, 'n');})
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab_and_newline')
			->add_rule('max_length', 90);
		
		$form->add('phone_number', '電話番号', array('placeholder' => '', 'class' => 'form-control'))
			->add_rule(function($form) { return mb_convert_kana($form, 'rn');})
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab_and_newline')
			->add_rule('phone_number')
			->add_rule('max_length', 15);
		
		$form->add('s_password', 'パスワード', array('type' => 'password', 'placeholder' => '8文字以上16文字以下の英数字', 'class' => 'form-control'))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab_and_newline')
			->add_rule('only_numeric_and_alpha')
			->add_rule('min_length', 8)
			->add_rule('max_length', 16);
			
		$form->add('submit', '', array('type' => 'submit', 'value' => '確認', 'class' => 'btn btn-primary btn-lg'));
		
		return $form;
	}
	
	/**
	 * 招待メール送信フォームの定義
	 */
	protected function forge_email_validation()
	{
		$val = Validation::forge();
		
		$val->add('s_email', 'メールアドレス', array('class' => 'form-control'))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab_and_newline')
			->add_rule('max_length', 100)
			->add_rule('valid_email');
		
		return $val;
	}
	
	public function action_invite()
	{
		$this->template->title = '登録用メール送信';
		$this->template->content = View::forge('student/auth/invite');
	}
	
	/**
	 * 本登録用URLを記載したメールを送る
	 * 
	 * @return type
	 * @throws HttpInvalidInputException
	 */
	public function action_send_invitation()
	{
		if ( ! Security::check_token())
		{
			throw new HttpInvalidInputException('ただしいページ遷移ではありません。');
		}
		
		$val = $this->forge_email_validation()->add_callable('MyValidationRules');
		
		if ( ! $val->run())
		{
			$this->template->title = 'メール送信の失敗';
			$this->template->content = View::forge('student/auth/invite');
			$this->template->content->set_safe('send_error', $val->show_errors());
			return;
		}
	
		$post = $val->validated();
		
		try
		{
			$mail = new Model_Student_Auth();
			$mail->send_invitation($post);
			
			$this->template->title = 'メール送信完了';
			$this->template->content = View::forge('student/auth/sendinvite', $post);
			return;
		} 
		catch (EmailValidationFailedException $e)
		{
			Log::error(
				'メール検証エラー: ' . $e->getMessage() . __METHOD__
				);
			$send_error = 'メールアドレスに誤りがあります。';
		}
		catch (EmailSendingFailedException $e)
		{
			Log::error(
				'メール送信エラー: ' . $e->getMessage() . __METHOD__
				);
			$send_error = 'メールを送信できませんでした。';
		}
		catch (EmailAlreadyRegisteredException $e)
		{
			Log::error(
				'メールアドレス重複エラー: ' . $e->getMessage() . __METHOD__
				);
			$send_error = 'そのメールアドレスは既に登録されています。';
		}
		
		$this->template->title = 'メール送信の失敗';
		$this->template->content = View::forge('student/auth/invite');
		$this->template->content->set_safe('send_error', $send_error);
	}
	
	
	/**
	 * 本登録用のビューを渡す
	 * 
	 */
	public function action_register($preuser_id = 'LUCKY POOL')
	{
		try
		{ // パラメータから取得したpreuser_id(hidden)を含むfieldsetを生成する。
			$form = $this->forge_register_form($preuser_id);
		}
		catch (InvalidPreuserIdException $e)
		{
			Log::error(
				'本登録エラー: ' . $e->getMessage() . __METHOD__
				);
			
			// 無効なpreuser_idのとき、メールアドレス登録フォームを表示する。
			$register_error = '無効なURLです。メールアドレスを登録してください';
			$form = $this->forge_email_form();
			
			$this->template->title = '学生ユーザー登録';
			$this->template->content = View::forge('student/auth/invite');
			$this->template->content->set_safe('send_error', $register_error);
			$this->template->content->set_safe('s_email_form', $form->build('student/auth/send_confirm'));
			
			return;
		}
		
		if (Input::method() === 'POST')
		{
			$form->repopulate();
		}
	
		$this->template->title = '学生ユーザー登録';
		$this->template->content = View::forge('student/auth/register');	
		$this->template->content->set_safe('s_register_form', $form->build('student/auth/register_confirm'));
	}
	
	public function action_register_confirm()
	{
		if ( ! Input::post('preuser_id'))
		{
			$register_error = '無効なURLです。メールアドレスを登録してください';
			$form = $this->forge_email_form();
			
			$this->template->title = '学生ユーザー登録';
			$this->template->content = View::forge('student/auth/invite');
			$this->template->content->set_safe('send_error', $register_error);
			$this->template->content->set_safe('s_email_form', $form->build('student/auth/send_confirm'));
			return;
		}
		
		$preuser_id = Input::post('preuser_id');
		$form = $this->forge_register_form($preuser_id);
		$val = $form->validation()->add_callable('MyValidationRules');
		
		if ( ! $val->run()) 
		{
			$form->repopulate();
			$this->template->title = '登録内容の修正';
			$this->template->content = View::forge('student/auth/register');
			$this->template->content->set_safe('register_error', $val->show_errors());
			$this->template->content->set_safe('s_register_form', $form->build('student/auth/register_confirm'));
			return;
		}
		
		$data['input'] = $val->validated();
		// 都道府県コード→都道府県名
		$data['input']['prefecture_jp'] = Controller_Clinic_Auth::$prefecture[$data['input']['prefecture']];
		// 「19900822」-> ('b_year' => '1990', 'b_month' => '08', 'b_day' => '22')
		$conversion = new Model_Student_Auth();
		$date_array = $conversion->date_conversion_for_view($data['input']['birthday']);
		$data['input']['b_year']	= $date_array['year'];
		$data['input']['b_month']	= $date_array['month'];
		$data['input']['b_day']	= $date_array['day'];
		
		$this->template->title = '登録内容の確認';
		$this->template->content = View::forge('student/auth/register_confirm', $data);
	}
	
	public function action_register_completion()
	{
		if ( ! Security::check_token())
		{
			throw new HttpInvalidInputException('ただしいページ遷移ではありません。');
		}
		
		$preuser_id		= Input::post('preuser_id');
		$form = $this->forge_register_form($preuser_id);
		$val = $form->validation()->add_callable('MyValidationRules');
		
		if ( ! $val->run())
		{
			$form->repopulate();
			$this->template->title = '登録内容のエラー';
			$this->template->content = View::forge('student/auth/register');
			$this->template->content->set_safe('register_error', $val->show_errors());
			$this->template->content->set_safe('s_register_form', $form->build('student/auth/register_confirm'));
			return;
		}
		
		// 生年月日をDATE型に整形（「19900522」->「1990-05-22」）
		$conversion = new Model_Student_Auth();
		$birthday = $conversion->date_conversion_for_date(Input::post('birthday'));

		$preuser = new Model_Student_Auth();
		$s_email = $preuser->search_for_email_by_preuser_id($preuser_id);
		// 都道府県コード→都道府県名
		$prefecture_jp = Controller_Clinic_Auth::$prefecture[input::post('prefecture')];
		
		$s_username		= Input::post('s_username');
		$l_name			= Input::post('l_name');
		$f_name			= Input::post('f_name');
		$l_name_kana	= Input::post('l_name_kana');
		$f_name_kana	= Input::post('f_name_kana');
		$gender			= Input::post('gender');
		$university		= Input::post('university');
		$grade			= Input::post('grade');
		$zip			= Input::post('zip1').Input::post('zip2');
		$prefecture		= $prefecture_jp;
		$address		= Input::post('address');
		$phone_number	= Input::post('phone_number');
		$s_password		= Input::post('s_password');
		
		$profile_array = array(
			'l_name'	=> $l_name,
			'f_name'	=> $f_name,
			'l_name_kana'	=> $l_name_kana,
			'f_name_kana'	=> $f_name_kana,
			'birthday'		=> $birthday,
			'gender'		=> $gender,
			'university'	=> $university,
			'grade'			=> $grade,
			'zip'			=> $zip,
			'prefecture'	=> $prefecture,
			'address'		=> $address,
			'phone_number'	=> $phone_number,
		);
		
		$auth  = Auth::instance('Studentauth');
		if ( ! $auth->create_s_user($preuser_id, $s_username, $s_password, $s_email, $group = 1, $profile_array))
		{ 
			// DB登録に失敗した場合
			$form->repopulate();
			$this->template->title = '登録のエラー';
			$this->template->content = View::forge('student/auth/register');
			$this->template->content->set_safe('register_error', $val->show_errors());
			$this->template->content->set_safe('s_register_form', $form->build('student/auth/register_confirm'));
			return;
		}
		
		// 本登録完了メール通知
		$post = array(
			's_email'		=> $s_email,
			's_username'	=> $s_username,
			's_password'	=> $s_password,			
		);
		$completion_mail = new Model_Student_Auth();
		$completion_mail->send_notification($post);
		
		$this->template->title = '本登録完了';
		$this->template->content = View::forge('student/auth/completion');
	}
	
	public function action_login()
	{
		if ( ! Input::post() )
		{
			$this->template->title		= '獣医学性 ログイン';
			$this->template->content	= View::forge('student/auth/login');
		}
		elseif ( Input::post() )
		{
			$auth = Auth::instance('Studentauth');
			
			if ($auth->login(Input::post('s_username'), Input::post('s_password')))
			{
				//　ログイン成功→トップページ
				Response::redirect('student/mypage');
			}
			else
			{
				$login_error = "ユーザー名もしくはパスワードが違います。もう一度お試しください。";
				
				$this->template->title = 'ログインエラー';
				$this->template->content = View::forge('student/auth/login');
				$this->template->content->set_safe('login_error', $login_error);
				return;
			}
		}
	}
	
}
