<?php

class Model_Contact extends Model
{
	/**
	 * お問い合わせ
	 * 
	 * @param type $post
	 * @return boolean
	 */
	public function send($post)
	{
		$data = $this->build_mail($post);
		$this->sendmail($data);
	}
	
	/**
	 * お問い合わせ内容
	 * 
	 * @param type $post
	 * @return type
	 */
	protected function build_mail($post)
	{
		$data['from']		= $post['email'];
		$data['from_name']	= $post['name'];
		$data['to']			= 'vetwith@gmail.com';
		$data['to_name']	= 'VetWith運営部';
		$data['subject']	= 'お問い合わせ';
		
		$ip		= Input::ip();
		$agent	= Input::user_agent();
		
		$data['body'] = <<< END
---------------------------------------------------------
    名前：			{$post['name']}
	メールアドレス：	{$post['email']}
	IPアドレス：		$ip
	ブラウザ：		$agent
---------------------------------------------------------
コメント
{$post['comment']}
---------------------------------------------------------
END;
		return $data;
	}
	
	/**
	 * お問い合せ送信
	 * 
	 * @param type $data
	 * @return boolean
	 */
	protected function sendmail($data)
	{
		$email = Email::forge();
		$email->from($data['from'], $data['from_name']);
		$email->to($data['to'], $data['to_name']);
		$email->subject($data['subject']);
		$email->body($data['body']);
		
		$email->send();
	}
}