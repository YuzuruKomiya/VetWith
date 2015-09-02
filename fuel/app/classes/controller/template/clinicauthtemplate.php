<?php

class Controller_Template_ClinicAuthTemplate extends Controller_Template
{
		public function before()
	{
		parent::before();
		
		$c_auth = Auth::instance('Clinicauth');
		$s_auth = Auth::instance('Studentauth');
		
		// 学生アカウントでログイン中の場合ログアウトする。
		if ($s_auth->check())
		{
			$s_auth->logout();
		}
		
		// 病院アカウントでログイン済みの場合、マイページへ飛ばす。
		if ( $c_auth->check())
		{
			Response::redirect(Uri::base().'clinic/mypage');
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