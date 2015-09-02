<?php

return array(
	'error_'.\Upload::UPLOAD_ERR_OK						=> 'The file uploaded with success',
	'error_'.\Upload::UPLOAD_ERR_INI_SIZE				=> 'ファイルサイズが過剰です。',
	'error_'.\Upload::UPLOAD_ERR_FORM_SIZE				=> 'ファイルサイズが過剰です。',
	'error_'.\Upload::UPLOAD_ERR_PARTIAL				=> 'The uploaded file was only partially uploaded',
	'error_'.\Upload::UPLOAD_ERR_NO_FILE				=> '画像が選択されませんでした。',
	'error_'.\Upload::UPLOAD_ERR_NO_TMP_DIR				=> 'Configured temporary upload folder is missing',
	'error_'.\Upload::UPLOAD_ERR_CANT_WRITE				=> 'Failed to write uploaded file to disk',
	'error_'.\Upload::UPLOAD_ERR_EXTENSION				=> 'Upload blocked by an installed PHP extension',
	'error_'.\Upload::UPLOAD_ERR_MAX_SIZE				=> 'ファイルサイズが過剰です。',
	'error_'.\Upload::UPLOAD_ERR_EXT_BLACKLISTED		=> '利用できない拡張子です。',
	'error_'.\Upload::UPLOAD_ERR_EXT_NOT_WHITELISTED	=> '利用できない拡張子です',
	'error_'.\Upload::UPLOAD_ERR_TYPE_BLACKLISTED		=> '利用できないファイルタイプです。',
	'error_'.\Upload::UPLOAD_ERR_TYPE_NOT_WHITELISTED	=> '利用できないファイルタイプです。',
	'error_'.\Upload::UPLOAD_ERR_MIME_BLACKLISTED		=> '利用できないファイルタイプです。',
	'error_'.\Upload::UPLOAD_ERR_MIME_NOT_WHITELISTED	=> '利用できないファイルタイプです。',
	'error_'.\Upload::UPLOAD_ERR_MAX_FILENAME_LENGTH	=> 'ファイル名が長過ぎます。',
	'error_'.\Upload::UPLOAD_ERR_MOVE_FAILED			=> 'サーバーエラーです。',
	'error_'.\Upload::UPLOAD_ERR_DUPLICATE_FILE 		=> 'A file with the name of the uploaded file already exists',
	'error_'.\Upload::UPLOAD_ERR_MKDIR_FAILED			=> 'Unable to create the file\'s destination directory',
);
