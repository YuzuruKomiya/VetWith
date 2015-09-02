<?php

class Model_Clinic_Mypage extends Model
{
	/**
	 * プロフィール配列を返す
	 * 
	 * @return type
	 */
	public static function get_c_profile_array()
	{
		$auth = Auth::instance('Clinicauth');
		$profile_array = $auth->get_profile_fields();
		
		return $profile_array;	
	}
	
	/**
	 * 公開に必要な病院情報が登録されているかどうかチェックする。
	 * 
	 * @return boolean
	 */
	public function c_profile_comletion_check()
	{
		$data['profile'] = self::get_c_profile_array();
		
		if ( isset($data['profile']['update_check']) && $data['profile']['update_check'] == 'yes')
		{
			return true;
		}
		return false;
	}
	
	/**
	 * 求人を登録する。
	 * 
	 * @param type $offer_information_array
	 * @return type
	 * @throws ClinicUserNotLoginException
	 */
	public static function register_offer($offer_information_array)
	{
		$auth = Auth::instance('Clinicauth');
		
		if ( ! $auth->check())
		{
			throw new ClinicUserNotLoginException('この機能を利用するためには動物病院アカウントからログインしてください。');
		}
		
		list(, $rows_affected) = DB::insert('offers')
			->set($offer_information_array)
			->execute();
		
		return $rows_affected;
	}
	
	/**
	 * 求人を更新する。
	 * 
	 * @param type $offer_information_array
	 * @return type
	 * @throws ClinicUserNotLoginException
	 */
	public static function update_offer($offer_information_array)
	{
		$auth = Auth::instance('Clinicauth');
		
		if ( ! $auth->check())
		{
			throw new ClinicUserNotLoginException('この機能を利用するためには動物病院アカウントからログインしてください。');
		}
		
		$username = $auth->get('username');
		
		$rows_affected = DB::update('offers')
			->set($offer_information_array)
			->where('c_username', '=', $username)
			->execute();
		
		return $rows_affected;
	}

	/**
	 * 求人情報を配列にして取得する。
	 * 
	 * @return type
	 */
	public static function get_offer_array()
	{
		$auth = Auth::instance('Clinicauth');
		$c_username = $auth->get('username');
		
		$offer = DB::select()
			->where('c_username', '=', $c_username)
			->from('offers')
			->execute();
		
		$offer_array = $offer->current();
		
		return $offer_array;
	}
	
	/**
	 * 求人情報のレコード数を取得する。
	 * ０件or１件の求人が登録されていることを確認するために用いる。
	 * 
	 * @return type
	 */
	public static function count_how_many_offers()
	{
		$auth = Auth::instance('Clinicauth');
		$username = $auth->get('username');
		
		$result = DB::select()
			->where('c_username', '=', $username)
			->from('offers')
			->execute();
		
		$offers_count = $result->count();
		return $offers_count;
	}
	
	/**
	 * アップロードクラスの設定
	 * 
	 * @return type
	 */
	public static function upload_image_config()
	{
		return array(
			'path'			=> DOCROOT.DS.'assets'.DS.'img'.DS.'clinics',
			'randomize'		=> true,
			'ext_whitelist'	=>array('jpg','jpeg','gif','png'),
			
		);
	}
	
	/**
	 * DBへ画像の名前を保存する。
	 * 
	 * @param type $file
	 * @throws Exception
	 */
	public static function upload_image($file)
	{
		$auth = Auth::instance('Clinicauth');
		$username = $auth->get('username');
		
		$query = DB::select()
				->where('c_username', '=', $username)
				->from('c_images')
				->execute();
		
		// 更新前の画像ファイル名が存在する場合、取得
		$pre_image_name = isset($query->current()[$file['field']]) ? $query->current()[$file['field']] : NULL ;
			
		if ($query->count() == 0)
		{	
			// insert
			list(, $row_affected) = DB::insert('c_images')
				->set(array(
					// c_image => ファイル名
					$file['field'] => $file['saved_as'],
					'c_username'	=> $username,
				))
				->execute();
		}
		elseif ($query->count() == 1)
		{
			// update
			$row_affected = DB::update('c_images')
				->set(array(
					// c_image => ファイル名
					$file['field'] => $file['saved_as'],
				))
				->where('c_username', '=', $username)
				->execute();
		}
		
		if ($row_affected != 1)
		{
			throw new Exception('データベースエラーです。');
		}
		
		if ($pre_image_name != NULL)
		{
			// フォルダに保存していた画像を削除
			File::delete(DOCROOT.'/assets/img/clinics/'.$pre_image_name);
		}
		
	}
	
	/**
	 * アップロード済みの画像を削除
	 * 
	 * @param type $image_name
	 * @return boolean
	 */
	public static function delete_image($image_name)
	{
		$auth = Auth::instance('Clinicauth');
		$username = $auth->get('username');
		
		$query = DB::select()
				->where('c_username', '=', $username)
				->from('c_images')
				->execute();
		
		// 更新前の画像ファイル名が存在する場合、取得
		$pre_image_name = isset($query->current()[$image_name]) ? $query->current()[$image_name] : NULL ;
		if ($pre_image_name == NULL)
		{
			return false;
		}
		
		// update
		$row_affected = DB::update('c_images')
			->set(array(
				// c_image => ファイル名
				$image_name => NULL,
			))
			->where('c_username', '=', $username)
			->execute();
		
		if ($row_affected != 1)
		{
			return false;
		}
		
		// フォルダに保存していた画像を削除
		File::delete(DOCROOT.'/assets/img/clinics/'.$pre_image_name);
		return true;
	}
	
	/**
	 * 求人の募集状況を変更する。
	 * 
	 * @param type $status
	 * @return type
	 */
	public static function change_reception($status = 0)
	{
		$auth = Auth::instance('Clinicauth');
		$username = $auth->get('username');
		
		$row_affected = DB::update('offers')
				->set(array('reception' => $status,) )
				->where('c_username', '=', $username)
				->execute();
		
		return $row_affected;
	}
	
	/**
	 * 応募のあった求人を一覧にして取得する。
	 * 引数にbooleanを指定することで、新規応募のみの取得も可能。
	 * 
	 * @param type $new_apply
	 * @return type
	 */
	public static function check_apply($new_apply = false)
	{
		$auth = Auth::instance('Clinicauth');
		$username = $auth->get('username');
		
		$query = DB::select(
			'applys.id',
			'applys.s_username',
			'applys.objective',
			'applys.already_read',
			'applys.created_at',
			'students.profile_fields'
			)
			->from('applys')
			->join('students', 'INNER')
			->on('applys.s_username', '=', 'students.username')
			->where('c_username', '=', $username);
		
		if ($new_apply)
		{
			$query->and_where('already_read', '=', 0);
		}
		
		$query->distinct(true)
			->order_by('applys.id', 'desc');
		
		$result_array	= $query->execute()->as_array();
		$apply_count	= count($result_array);
		
		$apply_array = array();
		foreach ($result_array as $result)
		{
			$profile_array = $result;
			$profile_array = array_merge($profile_array, unserialize($result['profile_fields'])) ;
			unset($profile_array['profile_fields']);
			$apply_array[] = $profile_array;
		}
		
		return array($apply_count, $apply_array);
	}
	
	/**
	 * 応募求人の情報を取得する。
	 * 
	 * @param type $apply_id
	 * @return type
	 */
	public static function get_apply_detail($apply_id)
	{
		$auth = Auth::instance('Clinicauth');
		$username = $auth->get('username');
		
		$query = DB::select(
			'applys.id',
			'applys.s_username',
			'applys.objective',
			'applys.contents',
			'applys.already_read',
			'applys.created_at',
			'students.email',
			'students.profile_fields'
			)
			->from('applys')
			->join('students', 'INNER')
			->on('applys.s_username', '=', 'students.username')
			->where('c_username', '=', $username)
			->and_where('c_username', '=', $username)
			->execute();

		$apply_count = count($query); 
		if ($apply_count != 1)
		{
			throw new HttpNotFoundException;
		}
		
		$result_array = $query->current();
		
		$profile_array = $result_array;
		$profile_array = array_merge($profile_array, unserialize($result_array['profile_fields'])) ;
		unset($profile_array['profile_fields']);
		$apply_array = $profile_array;
		
		return array($apply_count, $apply_array);
	}
	
	/**
	 * 既読→未読。
	 * 
	 * @param type $apply_id
	 */
	public static function make_apply_already_read($apply_id)
	{
		$auth = Auth::instance('Clinicauth');
		$username = $auth->get('username');
		
		$query = DB::update('applys')
			->set(array('already_read' => 1))
			->where('c_username', '=', $username)
			->and_where('id', '=', $apply_id)
			->execute();
	}
	
	/**
	 * 最終報告
	 * 
	 * @param type $apply_id
	 * @param type $report_array
	 * @return boolean
	 */
	public static function report($apply_id, $report_array)
	{
		$auth = Auth::instance('Clinicauth');
		$c_username = $auth->get('username');
		
		// reportが重複しないかをチェック
		$query = DB::select()
			->where('apply_id', '=', $apply_id)
			->and_where('c_username', '=', $c_username)
			->from('reports')
			->execute();
		
		if (count($query) != 0)
		{
			return false;
		}
		
		// applyが１件登録済みかをチェック
		$query = DB::select()
			->where('id', '=', $apply_id)
			->and_where('c_username', '=', $c_username)
			->from('applys')
			->execute();
		
		if (count($query) != 1)
		{
			return false;
		}
		
		$s_username = $query->current()['s_username'];
		
		// reportを１件新規作成できるかチェック
		$insert_array = array_merge($report_array, array('apply_id' => $apply_id, 'c_username' => $c_username, 's_username' => $s_username));
		
		list(, $rows_affected) = DB::insert('reports')
			->set($insert_array)
			->execute();
		
		if ($rows_affected != 1)
		{
			return false;
		}
		
		// 応募ステータスを対応済みに変更
		$query = DB::update('applys')
			->set(array('already_read' => 2))
			->where('id', '=', $apply_id)
			->execute();
		
		return true;
		
	}
}
