<?php

class Model_Student_Mypage extends Model
{
	/**
	 * プロフィール配列を返す
	 * 
	 * @return type
	 */
	public static function get_s_profile_array()
	{
		$auth = Auth::instance('Studentauth');
		$profile_array = $auth->get_profile_fields();
		
		return $profile_array;	
	}
}

