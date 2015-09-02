<?php

class EmailAlreadyRegisteredException extends Exception
{
	public function response()
	{
		$response = Request::forge('error/invalid')->execute(array($this->getMessage()))->response();
		return $response;
	}
}



