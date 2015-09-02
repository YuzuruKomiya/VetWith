<?php

class Controller_Operation extends Controller_Template_EveryUserTemplate
{
	public function action_index()
	{
		$this->template->title = '運営情報';
		$this->template->content = View::forge('operation/index');
		return;
	}
}
