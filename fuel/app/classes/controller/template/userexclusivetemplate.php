<?php

/**
 * 病院管理者もしくは学生がログインして利用する機能。
 * ログインしていないとログインせいやページに飛ばされる。
 * 
 */
class Controller_Template_UserExclusiveTemplate extends Controller_Template
{
		public function before()
	{
		parent::before();
		
		if ( ! Session::get('s_sername') && ! Session::get('c_username'))
		{
			Response::redirect('error/invalid/unko');
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