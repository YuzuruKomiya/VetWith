<?php

class str extends Fuel\Core\Str
{
	/**
	 * 郵便番号の整形。ハイフン挿入
	 * 「1770045」→「177-0045」
	 * 
	 * @param type $zip7letters
	 * @return array
	 */
	public static function zip_shaping($zip7letters)
	{
		$zip3 = self::sub($zip7letters, 0, 3);
		$zip4 = self::sub($zip7letters, 3, 4);
		
		$shaped_zip = array('zip3' => $zip3, 'zip4' => $zip4);
		
		return $shaped_zip;
	}
	
	/**
	 * テキスト中の。
	 * 段落→＜ｐ＞＜/ｐ＞、改行→＜ｂｒ　/＞
	 * 
	 * @param type $text
	 * @return string
	 */
	public static function make_lb_and_para_into_tags($text)
	{
		if (is_array($text))
		{
			foreach ($text as $key => $value)
			{
				$converted_text[$key] = self::make_lb_and_para_into_tags($value);
			}
		}
		else
		{
			$pattern = '/\A['.PHP_EOL.PHP_EOL.'+]*\z/u'; // 段落＝改行コードが２つ以上連続するもの
			$paragraph_array = preg_split($pattern, $text, PREG_SPLIT_NO_EMPTY);
			$converted_text = '';

			foreach ($paragraph_array as $value)
			{
				$converted_text .= '<p>'. nl2br($value) . '</p>';
			}
		}
		
		return $converted_text;
	}
}
