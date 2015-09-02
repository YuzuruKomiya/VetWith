<?php

class Controller_Terms extends Controller_Template_EveryUserTemplate
{
	public function action_index()
	{
		$this->template->title = 'ご利用規約';
		$this->template->content = View::forge('terms/index');
		return;
	}
}

