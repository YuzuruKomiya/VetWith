<?php
class Controller_Check extends Controller
{
	public function action_index()
	{
		echo '<pre>';
		echo Fuel::VERSION . PHP_EOL;
		echo setlocale(LC_ALL, 0) . PHP_EOL;
		echo Date::forge()->format('mysql') . PHP_EOL;
		echo ini_get('default_charset');
		echo Fuel::$env . PHP_EOL;
		echo isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '$_SERVER[\'SERVER_NAME\'] is not set';
		echo '</pre>';
	}
}