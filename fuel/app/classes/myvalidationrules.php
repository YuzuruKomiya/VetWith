<?php

class MyValidationRules
{
	/**
	 * 改行コード、タブが含まれていないかの検証。ヘッダインジェクション対策など。
	 * 
	 * @param string $value
	 * @return boolean
	 */
	public static function _validation_no_tab_and_newline($value)
	{
		if (preg_match('/\A[^\r\n\t]*\z/u', $value) === 1)
		{
			// 含まれていない場合
			return true;
		}
		else
		{
			//　含まれている場合
			return false;
		}
	}
	
	/**
	 * タブを含んでいないかの検証
	 * 
	 * @param type $value
	 * @return boolean
	 */
	public static function _validation_no_tab($value)
	{
		if (preg_match('/\A[^\t]*\z/u', $value) === 1)
		{
			// 含まれていない場合
			return true;
		}
		else
		{
			//　含まれている場合
			return false;
		}
	}

		/**
	 * カタカナ以外を含んでいないかの検証。
	 * 
	 * @param	string $value
	 * @return	boolean
	 */
	public static function _validation_only_katakana($value)
	{
		//UTF-8のエンコーディング
		mb_regex_encoding("UTF-8");
		if (preg_match('/\A[ァ-ヶー]*\z/u', $value))
		{
			// カタカナのみ
			return true;
			
		}else{
			
			// カタカナ以外を含む
			return false;
		}
	}
	
	/**
	 * 英数字を含んでいないかの検証
	 * 
	 * @param type $value
	 * @return boolean
	 */
	public static function _validation_only_numeric_and_alpha($value)
	{
		 if (preg_match('/\A[a-zA-Z0-9]*\z/u', $value))
		{
			 // 英数字のみ
	        return true;
		}
		else
		{
			// 英数字以外を含む
			return false;
		}
	}
	
	/**
	 * DBの指定したテーブル、カラム上に入力データと同じ値が
	 *	ない→true,　ある→false
	 * 
	 * @param type $value
	 * @param type $options
	 * @return type
	 */
	public static function _validation_unique($value, $options)
	{
		list($table, $field) = explode('.', $options);
		
		$result = DB::select($field)
			->where($field, '=', Str::lower($value))
			->from($table)
			->execute();
		
		return ! ($result->count() > 0);
		
	}
	
	/**
	 * 半角数字とハイフン以外を含むかの検証。
	 * 電話番号用に。
	 * 
	 * @param type $value
	 * @return boolean
	 */
	public static function _validation_phone_number($value)
	{
		if (preg_match('/\A[0-9-]*\z/u', $value))
		{
			// 半角数字とハイフンのみ
			return true;
		}
		else
		{
			// それ以外も含む
			return false;
		}
	}
}