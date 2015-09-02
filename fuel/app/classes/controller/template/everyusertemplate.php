<?php

class Controller_Template_EveryUserTemplate extends Controller_Template
{
		public function before()
	{
		parent::before();
		
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