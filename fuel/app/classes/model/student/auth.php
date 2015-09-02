<?php

class Model_Student_Auth extends Model
{
	public static function _init()
	{
		Config::load('studentauth', true);
	}
	
	/**
	 * 招待状を作成、送信する。
	 * 
	 * @param	array $post
	 * @return void
	 */
	public function send_invitation($post)
	{
		$data = $this->build_invitaton($post);
		if ( ! $this->invitation($data)) // メールアドレスが重複
		{
			throw new EmailAlreadyRegisteredException('そのメールアドレスは既に登録されています。');
		}
		$this->create_preuser($data);

		return true;
	}
	
	/**
	 * 招待メールの内容の作成
	 * 
	 * @param	array $post
	 * @return	arrar
	 */
	protected function build_invitaton($post)
	{
		$data['preuser_id']	= sha1(uniqid(mt_rand(100, 999)));
		
		$top_uri = Uri::base(false);
		$register_uri		= Uri::create('student/auth/register/:some', array('some' => $data['preuser_id']));
		
		$data['from']		= 'no-reply@vetwith.sakura.ne.jp';
		$data['from_name']	= 'VetWith運営部';
		$data['to']			= $post['s_email'];
		$data['subject']	= 'VetWith登録メール';
		$data['body']		= <<< END
VetWith運営部です。

VetWithに登録いただきありがとうございます。
以下のURLより必要事項を入力することで本登録が完了します。
			
{$register_uri}

---------------------------
動物病院で働きたいすべての学生に「VetWith」
{$top_uri}
END;
		return $data;
	}
	
	/**
	 * 招待用メールの送信
	 * 
	 * @param	array $data
	 * @return	void
	 */
	protected function invitation($data)
	{
		// DBに同名メールアドレスが登録済みか調べる
		$same_users = DB::select_array(Config::get('studentauth.table_columns', array('*')))
			->where('email', '=', $data['to'])
			->from(Config::get('studentauth.table_name'))
			->execute(Config::get('studentauth.db_connection'));
		
		if ($same_users->count() > 0)
		{
			return false;
		}
			
		// メール送信
		$email = Email::forge();
		$email->from($data['from'], $data['from_name']);
		$email->to($data['to']);
		$email->subject($data['subject']);
		$email->body($data['body']);
		
		$email->send();
		return true;
	}
	
	/*
	 * 仮登録データをデータベースに登録
	 * 
	 */
	protected function create_preuser($data)
	{
		DB::insert(Config::get('studentauth.table_name'))
			->set(array(
			'email'			=> $data['to'],
			'preuser_id'	=> $data['preuser_id'],
			))
			->execute(Config::get('studentauth.db_connection'));
	}
	
	/**
	 * 本登録完了通知を作成、送信する。
	 * 
	 * @param	array $post
	 * @return void
	 */
	public function send_notification($post)
	{
		$data = $this->build_notification($post);
		$this->notification($data);
			
		return true;
	}
	
	/**
	 * 本登録完了通知メール
	 * 
	 * @param type $post
	 * @return type
	 */
	protected function build_notification($post)
	{
		$top_uri = Uri::base(false);
		
		$data['from']		= 'no-reply@vetwith.sakura.ne.jp';
		$data['from_name']	= 'VetWith運営部';
		$data['to']			= $post['s_email'];
		$data['subject']	= 'VetWithに登録完了致しました。';
		$data['body']		= <<< END
VetWith運営部です。

VetWithの本登録が完了致しました。
ユーザーネームとパスワードは下記の通りになります。
大事に保存してください。
			
ユーザーネーム：{$post['s_username']}
パスワード：{$post['s_password']}

---------------------------
動物病院で働きたいすべての学生に「VetWith」
{$top_uri}
END;
		return $data;
	}

	/**
	 * 本登録完了通知メールの送信
	 * 
	 * @param type $data
	 * @return boolean
	 */
	protected function notification($data)
	{
		$email = Email::forge();
		$email->from($data['from'], $data['from_name']);
		$email->to($data['to']);
		$email->subject($data['subject']);
		$email->body($data['body']);
		
		$email->send();
		return true;
	}
	
	/**
	 * DBでpreuser_idをキーにemailを取得。
	 * 
	 * @param type $preuser_id
	 * @return type
	 * @throws InvalidPreuserIdException
	 */
	public function search_for_email_by_preuser_id($preuser_id)
	{
		$s_emails = DB::select('email')
			->where('preuser_id', '=', $preuser_id)
			->from(Config::get('studentauth.table_name'))
			->execute(Config::get('studentauth.db_connection'));
		
		// 検索したpreuser_idが複数or'deleted'（削除済み）の場合
		if ($s_emails->count() != 1 || $preuser_id == 'deleted')
		{
			throw new InvalidPreuserIdException('無効なURLです。');
		}
		
		$s_email_arr = $s_emails->current();
		$s_email = $s_email_arr['email'];
		
		return $s_email;
	}
	
	/**
	 * 日付の整形。
	 * 「19900822」-> ('b_year' => '1990', 'b_month' => '08', 'b_day' => '22')
	 * 
	 * @param type $input_date
	 * @return type
	 */
	public function date_conversion_for_view($input_date)
	{
		$output_date = array();
		$date = date_parse_from_format('Ymd', $input_date);
		$output_date['year']	= $date['year'];
		$output_date['month']	= $date['month'];
		$output_date['day']		= $date['day'];
		
		return $output_date;
	}
	
	/**
	 * 日付の整形。DB格納のため、DATE型に。
	 * 「19900522」->「1990-05-22」
	 * 
	 * @param type $input_date
	 * @return string
	 */
	public function date_conversion_for_date($input_date)
	{
		$date = date_parse_from_format('Ymd', $input_date);
		$output_date = $date['year'].'-'.$date['month'].'-'.$date['day'];
		
		return $output_date;
	}
}
