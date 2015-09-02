<?php

class Controller_Student_Logout extends Controller_Template_StudentExclusiveTemplate
{
	public function action_index()
	{
		$auth = Auth::instance('Studentauth');
		$auth->logout();
		
		$this->template->title = 'ログアウト';
		$this->template->content = View::forge('student/logout');
	}
}
