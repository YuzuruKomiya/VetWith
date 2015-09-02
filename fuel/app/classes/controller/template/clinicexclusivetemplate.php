<?php

/**
 * 病院管理者がログインして利用する機能。
 * 
 */
class Controller_Template_ClinicExclusiveTemplate extends Controller_Template
{
		public function before()
	{
		parent::before();
		
		$c_auth = Auth::instance('Clinicauth');
		$s_auth = Auth::instance('Studentauth');
		
		// 学生アカウントでログイン中の場合ログアウトする。
		if ( $s_auth->check() )
		{
			$s_auth->logout();
		}
		
		if ( ! $c_auth->check() )
		{
			Response::redirect('clinic/auth/login');
		}
		
		$this->response = Response::forge();
		$this->response->set_header('X-FRAME-OPTIONS', 'SAMEORIGIN');
		$this->template->header	= View::forge('parts/header');
		$this->template->footer	= View::forge('parts/footer');
	}
	
	public function after($response)
	{
		if (isset($this->template->submenu))
		{
			list($data['new_apply_count'],) = Model_Clinic_Mypage::check_apply(true);
			$this->template->submenu->set_safe('new_apply_count', $data['new_apply_count']);
		}
		
		$response = $this->response;
		$response->body = $this->template;
		return parent::after($response);
	}
	
}