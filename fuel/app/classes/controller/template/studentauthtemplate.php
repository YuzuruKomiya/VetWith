<?php

class Controller_Template_StudentAuthTemplate extends Controller_Template
{
		public function before()
	{
		parent::before();
		
		$c_auth = Auth::instance('Clinicauth');
		$s_auth = Auth::instance('Studentauth');
		
		// 病院アカウントでログイン中の場合ログアウトする。
		if ($c_auth->check())
		{
			$c_auth->logout();
		}
		
		// 学生アカウントでログイン済みの場合、マイページへ飛ばす。
		if ( $s_auth->check())
		{
			Response::redirect(Uri::base().'student/mypage');
		}
		
		$this->response = Response::forge();
		$this->response->set_header('X-FRAME-OPTIONS', 'SAMEORIGIN');
		$this->template->header	= View::forge('parts/header');
		$this->template->footer	= View::forge('parts/footer');
	}
	
	public function after($response)
	{
		$response = $this->response;
		$response->body = $this->template;
		return parent::after($response);
	}
	
}