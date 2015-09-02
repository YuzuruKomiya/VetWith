<?php

class Controller_Student_Mypage extends Controller_Template_StudentExclusiveTemplate
{
	public function action_index()
	{
		$data['profile'] = Model_Student_Mypage::get_s_profile_array();
		
		$this->template->title		= '獣医学生マイページ';
		$this->template->submenu	= View::forge('student/mypage/submenu', $data);
		$this->template->content	= View::forge('student/mypage/top', $data);
		
	}
	
	public function action_bookmark()
	{
		$data['profile'] = Model_Student_Mypage::get_s_profile_array();
		
		$auth = Auth::instance('Studentauth');
		$s_username = $auth->get('username');
		list($bookmarks_count, $data['bookmark_array']) = Model_Bookmark::get_bookmarks_clinics_array($s_username);
		
		// 登録ブックマークが０件のとき
		if ($bookmarks_count == 0)
		{
			$this->template->title		= 'ブックマーク登録した動物病院';
			$this->template->submenu	= View::forge('student/mypage/submenu', $data);
			$this->template->content	= View::forge('student/mypage/bookmark_error');
			return;
		}
		
		
		foreach ($data['bookmark_array'] as &$value)
		{
			$value['apply'] = Model_Offers::count_how_many_applys($s_username, $value['c_id']) == 1? '応募済み': '未応募';
		}
		unset($value);
		
		$this->template->title		= 'ブックマーク登録した動物病院';
		$this->template->submenu	= View::forge('student/mypage/submenu', $data);
		$this->template->content	= View::forge('student/mypage/bookmark', $data);
	}
}

