<?php

class Controller_Error extends Controller_Template
{
	public function action_invalid($message = null)
	{
		if ($message === null)
		{
			return "入力データが不適切でした。";
		}
		else
		{
			return e($message);
		}
	}
}