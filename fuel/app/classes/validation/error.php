<?php

class Validation_Error extends Fuel\Core\Validation_Error
{
	/**
	 * Override
	 * 
	 * @param type $msg
	 * @return type
	 */
	protected function _replace_tags($msg)
	{
		$msg = parent::_replace_tags($msg);
		
		$find = __('validation.valid_string_params');
		
		if ($find)
		{
			foreach ($find as $param => $str)
			{
				$msg = str_replace($param, $str, $msg);
			}
		}
		
		return $msg;
	}
}

