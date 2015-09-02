<?php

class Controller_Clinic_Auth extends Controller_Template_ClinicAuthTemplate
{
	/**
	 *都道府県コード→都道府県名
	 * 
	 * @var array
	 */
	public static $prefecture = array(
			''	=> '',
			1	=> '北海道',
			2	=> '青森県',
			3	=> '岩手県',
			4	=> '宮城県',
			5	=> '秋田県',
			6	=> '山形県',
			7	=> '福島県',
			8	=> '茨城県',
			9	=> '栃木県',
			10	=> '群馬県',
			11	=> '埼玉県',
			12	=> '千葉県',
			13	=> '東京都',
			14	=> '神奈川県',
			15	=> '新潟県',
			16	=> '富山県',
			17	=> '石川県',
			18	=> '福井県',
			19	=> '山梨県',
			20	=> '長野県',
			21	=> '岐阜県',
			22	=> '静岡県',
			23	=> '愛知県',
			24	=> '三重県',
			25	=> '滋賀県',
			26	=> '京都府',
			27	=> '大阪府',
			28	=> '兵庫県',
			29	=> '奈良県',
			30	=> '和歌山県',
			31	=> '鳥取県',
			32	=> '島根県',
			33	=> '岡山県',
			34	=> '広島県',
			35	=> '山口県',
			36	=> '徳島県',
			37	=> '香川県',
			38	=> '愛媛県',
			39	=> '高知県',
			40	=> '福岡県',
			41	=> '佐賀県',
			42	=> '長崎県',
			43	=> '熊本県',
			44	=> '大分県',
			45	=> '宮崎県',
			46	=> '鹿児島県',
			47	=> '沖縄県',
		);
	
	/**
	 * 本登録用のフォームの定義
	 * 
	 */
	protected function forge_register_form($preuser_id)
	{
		$preuser = new Model_Clinic_Auth();
		$c_email = $preuser->search_for_email_by_preuser_id($preuser_id);
		
		// 名前と読み仮名のinputを２つ並べるパッケージ。
		Package::load('fieldsetplus');
		
		$form = Fieldset::forge();
		
		$form->add('preuser_id', '', array(
			'type'		=> 'hidden',
			'value'		=> $preuser_id,
		));
		
		$form->add('c_username', 'ユーザーネーム', array('placeholder' => '8文字以上16文字以下の英数字', 'class' => 'form-control'))
			->add_rule(function($form) { return mb_convert_kana($form, 'rn');})
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab_and_newline')
			->add_rule('only_numeric_and_alpha')
			->add_rule('min_length', 8)
			->add_rule('max_length', 16);
		
		$form->add('c_name', '病院名', array('placeholder' => '30文字以下', 'class' => 'form-control'))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab_and_newline')
			->add_rule('max_length', 30);
		
		$form->add('l_name', '代表者の姓', array('placeholder' => '姓', 'class' => 'form-control'))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab_and_newline')
			->add_rule('min_length', 1)
			->add_rule('max_length', 10);
		
		$form->add('f_name', '代表者の名', array('placeholder' => '名', 'class' => 'form-control'))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab_and_newline')
			->add_rule('min_length', 1)
			->add_rule('max_length', 10);
	
		$form->add('l_name_kana', '代表者の姓のカナ', array('placeholder' => '姓のカナ', 'class' => 'form-control'))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab_and_newline')
			->add_rule('only_katakana')
			->add_rule('min_length', 1)
			->add_rule('max_length', 10);
		
		$form->add('f_name_kana', '代表者の名のカナ', array('placeholder' => '名のカナ', 'class' => 'form-control'))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab_and_newline')
			->add_rule('only_katakana')
			->add_rule('min_length', 1)
			->add_rule('max_length', 10);
		
		
		// ユーザーは編集できない。データの送信はする。
		$form->add('c_email', '代表者メールアドレス', array(
			'value'		=> $c_email,
			'class' => 'form-control',
			'readonly',
		))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab_and_newline')
			->add_rule('max_length', 100)
			->add_rule('valid_email');
		
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
			array('options' => self::$prefecture, 'type' => 'select', 'class' => 'form-control'))
			->add_rule('required')
			->add_rule('array_key_exists', self::$prefecture);
		
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
		
		
		$form->add('c_password', 'パスワード', array('type' => 'password', 'placeholder' => '8文字以上16文字以下の英数字', 'class' => 'form-control'))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab_and_newline')
			->add_rule('only_numeric_and_alpha')
			->add_rule('min_length', 8)
			->add_rule('max_length', 16);
			
		$form->add('submit', '', array('type' => 'submit', 'value' => '確認', 'class' => 'btn btn-primary'));
		
		return $form;
	}

	/**
	 * 招待メール送信フォームの定義
	 */
	protected function forge_email_validation()
	{
		$val = Validation::forge();
		
		$val->add('c_email', 'メールアドレス', array('class' => 'form-control'))
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
		$this->template->content = View::forge('clinic/auth/invite');
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
			$this->template->content = View::forge('clinic/auth/invite');
			$this->template->content->set_safe('send_error', $val->show_errors());
			return;
		}
	
		$post = $val->validated();
		
		try
		{
			$mail = new Model_Clinic_Auth();
			$mail->send_invitation($post);
			
			$this->template->title = 'メール送信完了';
			$this->template->content = View::forge('clinic/auth/sendinvite', $post);
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
		$this->template->content = View::forge('clinic/auth/invite');
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
			
			$this->template->title = '動物病院ユーザー登録';
			$this->template->content = View::forge('clinic/auth/invite');
			$this->template->content->set_safe('send_error', $register_error);
			$this->template->content->set_safe('c_email_form', $form->build('clinic/auth/send_invitation'));
			
			return;
		}
		
		if (Input::method() === 'POST')
		{
			$form->repopulate();
		}
	
		$this->template->title = '動物病院ユーザー登録';
		$this->template->content = View::forge('clinic/auth/register');	
		$this->template->content->set_safe('c_register_form', $form->build('clinic/auth/register_confirm'));
	}
	
	public function action_register_confirm()
	{
		if ( ! Input::post('preuser_id'))
		{
			$register_error = '無効なURLです。メールアドレスを登録してください';
			$form = $this->forge_email_form();
			
			$this->template->title = '動物病院ユーザー登録';
			$this->template->content = View::forge('clinic/auth/invite');
			$this->template->content->set_safe('send_error', $register_error);
			$this->template->content->set_safe('c_email_form', $form->build('clinic/auth/send_invitation'));
			return;
		}
		
		$preuser_id = Input::post('preuser_id');
		$form = $this->forge_register_form($preuser_id);
		$val = $form->validation()->add_callable('MyValidationRules');
		
		if ( ! $val->run()) 
		{
			$form->repopulate();
			$this->template->title = '登録内容の修正';
			$this->template->content = View::forge('clinic/auth/register');
			$this->template->content->set_safe('register_error', $val->show_errors());
			$this->template->content->set_safe('c_register_form', $form->build('clinic/auth/register_confirm'));
			return;
		}
		
		$data['input'] = $val->validated();
		// 都道府県コード→都道府県名
		$data['input']['prefecture_jp'] = self::$prefecture[$data['input']['prefecture']];
		
		$this->template->title = '登録内容の確認';
		$this->template->content = View::forge('clinic/auth/register_confirm', $data);
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
			$this->template->content = View::forge('clinic/auth/register');
			$this->template->content->set_safe('register_error', $val->show_errors());
			$this->template->content->set_safe('c_register_form', $form->build('clinic/auth/register_confirm'));
			return;
		}
		
		$preuser = new Model_Clinic_Auth();
		$c_email = $preuser->search_for_email_by_preuser_id($preuser_id);
		// 都道府県コード→都道府県名
		$prefecture_jp = self::$prefecture[input::post('prefecture')];
		
		$c_username		= Input::post('c_username');
		$c_name			= Input::post('c_name');
		$l_name			= Input::post('l_name');
		$f_name			= Input::post('f_name');
		$l_name_kana	= Input::post('l_name_kana');
		$f_name_kana	= Input::post('f_name_kana');
		$zip			= Input::post('zip1').Input::post('zip2');
		$prefecture		= $prefecture_jp;
		$address		= Input::post('address');
		$phone_number	= Input::post('phone_number');
		$c_password		= Input::post('c_password');
		
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
		);
		
		$auth  = Auth::instance('Clinicauth');
		if ( ! $auth->create_c_user($preuser_id, $c_username, $c_password, $c_email, $group = 1, $profile_array))
		{ 
			// DB登録に失敗した場合
			$form->repopulate();
			$this->template->title = '登録のエラー';
			$this->template->content = View::forge('clinic/auth/register');
			$this->template->content->set_safe('register_error', $val->show_errors());
			$this->template->content->set_safe('c_register_form', $form->build('clinic/auth/register_confirm'));
			return;
		}
		
		// 本登録完了メール通知
		$post = array(
			'c_email'		=> $c_email,
			'c_username'	=> $c_username,
			'c_password'	=> $c_password,			
		);
		$completion_mail = new Model_Clinic_Auth();
		$completion_mail->send_notification($post);
		
		$this->template->title = '本登録完了';
		$this->template->content = View::forge('clinic/auth/completion');
	}
	
	/**
	 * ログイン
	 * 
	 * @return type
	 */
	public function action_login()
	{
		if ( ! Input::post() )
		{
			$this->template->title		= '動物病院 ログイン';
			$this->template->content	= View::forge('clinic/auth/login');
		}
		elseif ( Input::post() )
		{
			$auth = Auth::instance('Clinicauth');
			
			if ($auth->login(Input::post('c_username'), Input::post('c_password')))
			{
				//　ログイン成功→トップページ
				Response::redirect('clinic/mypage');
			}
			else
			{
				$login_error = "ユーザー名もしくはパスワードが違います。もう一度お試しください。";
				
				$this->template->title = 'ログインエラー';
				$this->template->content = View::forge('clinic/auth/login');
				$this->template->content->set_safe('login_error', $login_error);
				return;
			}
		}
	}
	
	/**
	 * ログアウト
	 * 
	 */
	public function action_logout()
	{
		Auth::logout();
		
		$this->template->title = 'ログアウト';
		$this->template->content = View::forge('clinic/auth/logout');
	}
}
