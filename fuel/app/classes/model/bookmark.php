<?php

class Model_Bookmark extends Model
{
	/**
	 * DBのbookmarkテーブルから、学生のブックマークしている数を返す。
	 * 第二引数で$offer_idを指定すると、その$offer_idの求人のブックマーク数（０もしくは１）を返す。
	 * 
	 * @param type $s_username
	 * @param type $c_id
	 * @return type
	 */
	public static function count_how_many_bookmarks($s_username, $c_id = NULL)
	{
		if ( ! is_null($c_id))
		{
			$query = DB::select()
			->where('s_username', '=', $s_username)
			->and_where('c_id', '=', $c_id)
			->from('bookmarks')
			->execute();
			
			$bookmark_count = count($query);
			return $bookmark_count;
		}
		
		$query = DB::select()
			->where('s_username', '=', $s_username)
			->from('bookmarks')
			->execute();
			
			$bookmark_count = count($query);
			return $bookmark_count;
	}
	
	/**
	 * ブックマークに登録する。rows_affectedを返す。
	 * 
	 * @param type $s_username
	 * @param type $c_id
	 * @return type
	 */
	public static function add_bookmark($s_username, $c_id)
	{
		list(, $rows_affected) = DB::insert('bookmarks')
			->set(array(
				's_username'	=> $s_username,
				'c_id'		=> $c_id,
			))
			->execute();
		
		return $rows_affected;
	}
	
	/**
	 * ブックマークの登録を削除する。rows_affectedを返す。
	 * 
	 * @param type $s_username
	 * @param type $c_id
	 * @return type
	 */
	public static function delete_bookmark($s_username, $c_id)
	{
		$query = DB::delete('bookmarks')
			->where('s_username', '=', $s_username)
			->and_where('c_id', '=', $c_id);
		
		$rows_affected = $query->execute();
		return $rows_affected;
	}
	
	/**
	 * 学生のブックマークしている各求人のc_idとprofile_fieldsをアンシリアライズしたものを配列にして返す。
	 * 
	 * @param type $s_username
	 * @return type
	 */
	public static function get_bookmarks_clinics_array($s_username)
	{
		Config::load('clinicauth', true);
		
		$query = DB::select(Config::get('clinicauth.table_name').'.id',
			Config::get('clinicauth.table_name').'.profile_fields')
			->from('bookmarks')
			->join(Config::get('clinicauth.table_name'), 'INNER')
			->on('bookmarks.c_id', '=', Config::get('clinicauth.table_name').'.id')
			->where('bookmarks.s_username', '=', $s_username);
		
		$clinics_array = $query->execute()->as_array();
		$bookmarks_count = count($clinics_array);
		
		$bookmarks_array = array();
		foreach ($clinics_array as $clnics)
		{
			$profile_array			= unserialize($clnics['profile_fields']);
			$profile_array['c_id']	= $clnics['id'];
			$bookmarks_array[]	= $profile_array;
		}
		
		return array($bookmarks_count, $bookmarks_array);
	}
}
