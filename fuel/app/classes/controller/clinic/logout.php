<?php

class Controller_Clinic_Logout extends Controller_Template_ClinicExclusiveTemplate
{
	public function action_index()
	{
		$auth = Auth::instance('Clinicauth');
		$auth->logout();
		
		$this->template->title = 'ログアウト';
		$this->template->content = View::forge('clinic/logout');
	}
}
