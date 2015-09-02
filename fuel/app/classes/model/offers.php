<?php

class Model_Offers extends Model
{
	/**
	 * clinicsテーブルでc_idからc_usernameを取得
	 * 
	 * @param type $c_id
	 * @return type
	 * @throws HttpNotFoundException
	 */
	public static function get_c_username_by_c_id($c_id)
	{
		Config::load('clinicauth', true);
		
		$c_username = DB::select()
			->where('id', '=', $c_id)
			->from(Config::get('clinicauth.table_name'))
			->execute(Config::get('clinicauth.db_connection'));
		
		if ($c_username->count() != 1)
		{
			throw new HttpNotFoundException;
		}
		
		$c_username_array = $c_username->current();
		return $c_username_array['username'];
	}
	
	/**
	 * clinicsテーブルでc_usernameからc_idを取得
	 * 
	 * @param type $c_username
	 * @return type
	 * @throws HttpNotFoundException
	 */
	public static function get_c_id_by_c_username($c_username)
	{
		Config::load('clinicauth', true);
		
		$c_id = DB::select()
			->where('username', '=', $c_username)
			->from(Config::get('clinicauth.table_name'))
			->execute(Config::get('clinicauth.db_connection'));
		
		if ($c_id->count() != 1)
		{
			throw new HttpNotFoundException;
		}
		
		$c_id_array = $c_id->current();
		return $c_id_array['id'];
	}
	
	/**
	 * DBからclinicsのプロフィールを配列で取得。
	 * 
	 * @param type $c_id
	 * @return type
	 * @throws HttpNotFoundException
	 */
	public static function get_profile_array_by_user_id($c_id)
	{
		Config::load('clinicauth', true);
		
		$clinics = DB::select()
			->where('id', '=', $c_id)
			->from(Config::get('clinicauth.table_name'))
			->execute(Config::get('clinicauth.db_connection'));
		
		if ($clinics->count() != 1)
		{
			throw new HttpNotFoundException;
		}
		
		$clinics_array = $clinics->current();
		$profile_array = unserialize($clinics_array['profile_fields']);
		
		return $profile_array;
	}
	
	/**
	 * DBからoffersのレコードを配列で取得。
	 * 
	 * @param type $c_id
	 * @return type
	 * @throws HttpNotFoundException
	 */
	public static function get_offer_array_by_user_id($c_id)
	{
		$c_username = self::get_c_username_by_c_id($c_id);
		
		$offer = DB::select()
			->where('c_username', '=', $c_username)
			->from('offers')
			->execute();
		
		if ($offer->count() != 1)
		{
			throw new HttpNotFoundException;
		}
		
		$offer_array = $offer->current();
		return $offer_array;
	}
	
	/**
	 * offersのid（配列）をキーに、offersのレコードを配列で取得。
	 * $offers[$offer_id][$column_name]の形で取得。
	 * 
	 * @param type $offer_id_array
	 * @return type
	 */
	public static function get_offer_array_by_offer_id_array($offer_id_array)
	{
		$offer_array = array();
		
		foreach ($offer_id_array as $offer_id)
		{
			$offer_array[$offer_id] = DB::select()
				->where('c_username', '='. $offer_id)
				->from('offers')
				->as_assoc()
				->execute();
		}
		
		return $offer_array;
	}

	/**
	 * キーワードをキーにDBのoffersテーブルの各カラムと、clinicsテーブルのprofile_fieldsを検索。
	 * ヒットした求人のレコード数と、id配列を連想配列にして返す。
	 * 
	 * @param type $keywords
	 * @return type
	 */
	public static function search($keywords)
	{
		Config::load('clinicauth', true);
		
		$trimed_keywords = trim($keywords);
		// 全角ないし半角のスペースで分割、配列に。
		$keywords_array = preg_split('/　|\\s/u', $trimed_keywords);
		
		$query = DB::select('offers.id')
			->from(Config::get('clinicauth.table_name'))
			->join('offers', 'INNER')
			->on(Config::get('clinicauth.table_name').'.username', '=', 'offers.c_username');
		
		foreach ($keywords_array as $keyword)
		{
			$query->where_open()
				->where(Config::get('clinicauth.table_name').'.profile_fields', 'like', '%'.$keyword.'%')
				->or_where('offers.message',		'like', '%'.$keyword.'%')
				->or_where('offers.catchcopy',		'like', '%'.$keyword.'%')
				->or_where('offers.operation',		'like', '%'.$keyword.'%')
				->or_where('offers.realm',			'like', '%'.$keyword.'%')
				->or_where('offers.career',			'like', '%'.$keyword.'%')
				->or_where('offers.training',		'like', '%'.$keyword.'%')	
				->or_where('offers.salary',			'like', '%'.$keyword.'%')
				->or_where('offers.working_hour',	'like', '%'.$keyword.'%')
				->or_where('offers.graduation',		'like', '%'.$keyword.'%')
				->or_where('offers.environment',	'like', '%'.$keyword.'%')
				->or_where('offers.future',			'like', '%'.$keyword.'%')
				->where_close();
		}
		
		$query->distinct(true)
			->order_by('offers.id', 'asc');
		
		$offer_id_array	= $query->execute()->as_array();
		$searched_rows	= count($offer_id_array);
		
		$searched = array($searched_rows, $offer_id_array);
		
		return $searched;
	}
	
	/**
	 * 求人検索のページネーションオブジェクトに付与する設定
	 * 
	 * @param type $keyword
	 * @param type $rows
	 * @return type
	 */
	public static function pagination_config($keyword, $rows)
	{
		return array(
			'pagination_url' => 'search?q='.$keyword,
			'uri_segment' => 'p',
			'num_links' => 4,
			'per_page' => 10,
			'total_items' => $rows,
		);
	}
	
	/**
	 * 動物病院やその代表者の画像のパスを返す。
	 * 
	 * @param type $c_username
	 * @return type
	 */
	public static function fetch_c_images($c_username)
	{
		$query = DB::select()
			->where('c_username', '=', $c_username)
			->from('c_images')
			->execute();
		
		if ($query->count() == 0)
		{
			$c_image_name = 'no-image.gif';
			$r_image_name = 'no-image.gif';
		}
		elseif ($query->count() == 1)
		{
			$c_image_name = $query->current()['c_image'] != NULL ?
				'clinics/'.$query->current()['c_image']: 'no-image.gif';
			$r_image_name = $query->current()['r_image'] != NULL ?
				'clinics/'.$query->current()['r_image']: 'no-image.gif';
		}
		
		return array($c_image_name, $r_image_name);
	}
	
	/**
	 * 指定したs_usernameとc_idにマッチするapplyの数を返す。
	 * 
	 * @param type $s_username
	 * @param type $c_id
	 * @return type
	 */
	public static function count_how_many_applys($s_username, $c_id)
	{
		$c_username = self::get_c_username_by_c_id($c_id);
		
		$query = DB::select()
			->where('s_username', '=', $s_username)
			->and_where('c_username', '=', $c_username)
			->from('applys')
			->execute();
		
		$apply_count = count($query);
		return $apply_count;
	}
	
	/**
	 * applysテーブルにapplyを登録。
	 * 
	 * @param type $apply_information_array
	 * @return type
	 */
	public static function register_apply($apply_information_array)
	{
		list(, $rows_affected) = DB::insert('applys')
			->set($apply_information_array)
			->execute();

		return $rows_affected;
	}
	
	/**
	 * DB、offersテーブルのreceptionのステータスを変換
	 * 
	 * @param type $reception
	 * @return string
	 */
	public static function get_c_reception_status($reception)
	{
		switch ($reception)
		{
			case 0:
				$status = '締め切り中';
				break;
			case 2:
				$status = '見学を受付中';
				break;
			case 3:
				$status = '面談を受付中';
				break;
			case 5:
				$status = '実習を受付中';
				break;
			case 6:
				$status = '見学と面談を受付中';
				break;
			case 15:
				$status = '面談と実習を受付中';
				break;
		}
		
		return $status;
	}
	
	
	public function send_notification_to_clinic($data)
	{
		$data['c_mail'] = $this->get_c_mail_for_notification($data['c_id']);
		$this->build_notification($data);
	}
	
	protected function get_c_mail_for_notification($c_id)
	{
		Config::load('clinicauth', true);
		
		$query = DB::select()
			->where('id', '=', $c_id)
			->from(Config::get('clinicauth.table_name'))
			->execute();
		
		$c_mail = $query->current()['email'];
		
		return $c_mail;
	}
	
	protected function build_notification($data)
	{
		$mail['from']		= 'vetwith@gmail.com';
		$mail['from_name']	= 'VwtWith運営部';
		$mail['to']			= $data['c_mail'];
		$mail['to_name']	= $data['profile']['c_name'];
		$mail['subject']	= '出稿した求人に'.$data['objective'].'の応募がありました。';
		$top_uri			= Uri::base();
		$mypage_uri			= Uri::base().'clinic/mypage';
		
		$mail['body'] = <<< END
	{$data['profile']['c_name']}様
	
	こんにちは。VetWith運営部です。平素はVetWithをご利用ありがとうございます。
	現在出稿されている求人に{$data['objective']}の応募がありました。
	詳しくはマイページからご確認ください。
	
	▼マイページ
	$mypage_uri
		
---------------------------------------------------------
獣医学生の採用を検討するすべての動物病院に「VetWith」
$top_uri
END;
	
		$email = Email::forge();
		$email->from($mail['from'], $mail['from_name']);
		$email->to($mail['to'], $mail['to_name']);
		$email->subject($mail['subject']);
		$email->body($mail['body']);

		$email->send();
	}
}

