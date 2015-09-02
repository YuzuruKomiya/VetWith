<?php

class Controller_Bookmark extends Controller_Rest
{
	public function post_add()
	{
		// ログインチェック
		$auth = Auth::instance('Studentauth');
		if ( ! $auth->check())
		{
			return $this->response(array(
				'login_check' => false,
				'register_check' => false,
			));
		}
		
		$s_username = $auth->get('username');
		$c_id	= Input::post('c_id');
		
		// ブックマーク数が０であるかチェック
		if (Model_Bookmark::count_how_many_bookmarks($s_username, $c_id) != 0)
		{
			return $this->response(array(
				'login_check'		=> true,
				'register_check'	=> true,
			));
		}
		
		$register_bookmark_rows_affected = Model_Bookmark::add_bookmark($s_username, $c_id);

		// 登録できたかチェック
		if ($register_bookmark_rows_affected == 1)
		{
			return $this->response(array(
				'login_check'		=> true,	
				'register_check'	=> true,
			));
		}
		else
		{
			$this->response(array(
				'login_check'		=> true,
				'register_check'	=> false,
			));
		}
		
	}
	
	public function post_delete()
	{
		// ログインチェック
		$auth = Auth::instance('Studentauth');
		if ( ! $auth->check())
		{
			return $this->response(array(
				'login_check' => false,	
			));
		}
		
		$s_username = $auth->get('username');
		$c_id	= Input::post('c_id');
		
		// ブックマーク数が１であるかチェック
		if (Model_Bookmark::count_how_many_bookmarks($s_username, $c_id) != 1)
		{
			return $this->response(array(
				'login_check' => true,
				'register_check' => false,
			));
		}
		
		$delete_bookmark_rows_affected = Model_Bookmark::delete_bookmark($s_username, $c_id);
		
		if ($delete_bookmark_rows_affected == 1) // 登録解除できた
		{
			return $this->response(array(
				'login_check'		=> true,	
				'register_check'	=> false,
			));
		}
		else // 登録解除できなかった！
		{
			return $this->response(array(
				'login_check'		=> true,
				'register_check'	=> true,
			));
		}
	}
	
	public function post_precheck()
	{
		// ログインチェック
		$auth = Auth::instance('Studentauth');
		if ( ! $auth->check())
		{
			return $this->response(array(
				'login_check' => false,	
			));
		}
		
		$s_username = $auth->get('username');
		$c_id	= Input::post('c_id');
		
		$bookmark_count = Model_Bookmark::count_how_many_bookmarks($s_username, $c_id);
		
		
		// ブックマーク数をチェック
		if ($bookmark_count == 0)
		{
			return $this->response(array(
				'login_check'	=> true,
				'bookmark'		=> false,
			));
		}
		elseif ($bookmark_count == 1)
		{
			return $this->response(array(
				'login_check'	=> true,
				'bookmark'		=> true,
			));
		}
	}
}

