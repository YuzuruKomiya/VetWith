<?php

class MyInputFilters
{
	/**
	 * 文字エンコーディングを検証
	 * 
	 * @param	string|array $value
	 * @return string|array 
	 * @throws HttpInvalidInputException
	 */
	public static function check_encoding($value)
	{
		// 配列をチェック
		if (is_array($value))
		{
			array_map(array('MyInputFilters', 'check_encoding'), $value);
			return $value;
		}
		
		// エンコーディング検証
		if (mb_check_encoding($value, Fuel::$encoding))
		{
			return $value;
		}
		else
		{
			static::log_error('Invalid caracter encoding', $value);
			throw new HttpInvalidInputException('Invalid input data');
		}
	}
	
	/**
	 * 改行コード、タブを除く制御文字が含まれないかの検証
	 * 
	 * @param	string|array $value
	 * @return	string|array
	 * @throws	HttpInvalidInputException
	 */
	public static function check_control($value)
	{
		// 配列をチェック
		if (is_array($value))
		{
			array_map(array('MyInputFilters', 'check_control'), $value);
			return $value;
		}
		
		// 改行コード、タブの混入を検証
		if (preg_match('/\A[\r\n\t[:^cntrl:]]*\z/u', $value) === 1)
		{
			return $value;
		}
		else
		{
			static::log_error('Invalid control characters', $value);
			throw new HttpInvalidInputException('Invalid input data');
		}
	}

	/**
	 * エラーをログに記録
	 * 
	 * @param	string $msg
	 * @param	string|array $value
	 */
	public static function log_error($msg, $value)
	{
		Log::error(
				$msg . ': ' . Input::uri() . ' '
				. rawurldecode($value) . ' ' .
				Input::ip() . ' "' . Input::user_agent() . '"'
				);
	}
}

