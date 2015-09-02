<?php defined('COREPATH') or exit('No direct script access allowed'); ?>

INFO - 2015-07-30 00:02:21 --> Fuel\Core\Request::__construct - Creating a new main Request with URI = "offers/index/6"
ERROR - 2015-07-30 00:02:22 --> Parsing Error - syntax error, unexpected 'search' (T_STRING), expecting variable (T_VARIABLE) or '$' in C:\Users\yuduru\work\fuelphp\fuel\app\classes\controller\offers.php on line 45
INFO - 2015-07-30 14:02:28 --> Fuel\Core\Request::__construct - Creating a new main Request with URI = "offers/index/5"
ERROR - 2015-07-30 14:02:29 --> Parsing Error - syntax error, unexpected 'search' (T_STRING), expecting variable (T_VARIABLE) or '$' in C:\Users\yuduru\work\fuelphp\fuel\app\classes\controller\offers.php on line 45
INFO - 2015-07-30 14:02:40 --> Fuel\Core\Request::__construct - Creating a new main Request with URI = "offers/index/5"
INFO - 2015-07-30 14:02:40 --> Fuel\Core\Request::execute - Called
INFO - 2015-07-30 14:02:40 --> Fuel\Core\Request::execute - Setting main Request
ERROR - 2015-07-30 14:02:40 --> Parsing Error - syntax error, unexpected '}' in C:\Users\yuduru\work\fuelphp\fuel\app\classes\model\offers.php on line 91
INFO - 2015-07-30 14:02:57 --> Fuel\Core\Request::__construct - Creating a new main Request with URI = "offers/index/5"
INFO - 2015-07-30 14:02:57 --> Fuel\Core\Request::execute - Called
INFO - 2015-07-30 14:02:57 --> Fuel\Core\Request::execute - Setting main Request
INFO - 2015-07-30 14:02:58 --> Fuel\Core\Request::__construct - Creating a new main Request with URI = "welcome/404"
INFO - 2015-07-30 14:02:58 --> Fuel\Core\Request::execute - Called
INFO - 2015-07-30 14:02:58 --> Fuel\Core\Request::execute - Setting main Request
INFO - 2015-07-30 14:03:03 --> Fuel\Core\Request::__construct - Creating a new main Request with URI = "offers/index/6"
INFO - 2015-07-30 14:03:03 --> Fuel\Core\Request::execute - Called
INFO - 2015-07-30 14:03:03 --> Fuel\Core\Request::execute - Setting main Request
INFO - 2015-07-30 14:03:03 --> Fuel\Core\Request::__construct - Creating a new main Request with URI = "offers/index/6"
INFO - 2015-07-30 14:03:03 --> Fuel\Core\Request::execute - Called
INFO - 2015-07-30 14:03:03 --> Fuel\Core\Request::execute - Setting main Request
INFO - 2015-07-30 14:03:37 --> Fuel\Core\Request::__construct - Creating a new main Request with URI = "clinic/auth/login"
INFO - 2015-07-30 14:03:37 --> Fuel\Core\Request::execute - Called
INFO - 2015-07-30 14:03:37 --> Fuel\Core\Request::execute - Setting main Request
INFO - 2015-07-30 14:03:46 --> Fuel\Core\Request::__construct - Creating a new main Request with URI = "clinic/auth/login"
INFO - 2015-07-30 14:03:46 --> Fuel\Core\Request::execute - Called
INFO - 2015-07-30 14:03:46 --> Fuel\Core\Request::execute - Setting main Request
INFO - 2015-07-30 14:03:46 --> Fuel\Core\Request::__construct - Creating a new main Request with URI = "clinic/mypage"
INFO - 2015-07-30 14:03:46 --> Fuel\Core\Request::execute - Called
INFO - 2015-07-30 14:03:46 --> Fuel\Core\Request::execute - Setting main Request
INFO - 2015-07-30 14:03:47 --> Fuel\Core\Request::__construct - Creating a new main Request with URI = "clinic/mypage/offer_register"
INFO - 2015-07-30 14:03:47 --> Fuel\Core\Request::execute - Called
INFO - 2015-07-30 14:03:47 --> Fuel\Core\Request::execute - Setting main Request
INFO - 2015-07-30 14:04:09 --> Fuel\Core\Request::__construct - Creating a new main Request with URI = "clinic/mypage/offer_confirm"
INFO - 2015-07-30 14:04:09 --> Fuel\Core\Request::execute - Called
INFO - 2015-07-30 14:04:09 --> Fuel\Core\Request::execute - Setting main Request
INFO - 2015-07-30 14:04:12 --> Fuel\Core\Request::__construct - Creating a new main Request with URI = "clinic/mypage/offer_completion"
INFO - 2015-07-30 14:04:12 --> Fuel\Core\Request::execute - Called
INFO - 2015-07-30 14:04:12 --> Fuel\Core\Request::execute - Setting main Request
INFO - 2015-07-30 14:04:18 --> Fuel\Core\Request::__construct - Creating a new main Request with URI = "offers/index/5"
INFO - 2015-07-30 14:04:18 --> Fuel\Core\Request::execute - Called
INFO - 2015-07-30 14:04:18 --> Fuel\Core\Request::execute - Setting main Request
INFO - 2015-07-30 14:26:14 --> Fuel\Core\Request::__construct - Creating a new main Request with URI = "offers/index/5"
INFO - 2015-07-30 14:26:14 --> Fuel\Core\Request::execute - Called
INFO - 2015-07-30 14:26:14 --> Fuel\Core\Request::execute - Setting main Request
INFO - 2015-07-30 17:43:46 --> Fuel\Core\Request::__construct - Creating a new main Request with URI = "offers/search"
INFO - 2015-07-30 17:43:46 --> Fuel\Core\Request::execute - Called
INFO - 2015-07-30 17:43:46 --> Fuel\Core\Request::execute - Setting main Request
ERROR - 2015-07-30 17:43:47 --> 1064 - You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'LEFT JOIN `offers` ON (``.`username` = `offers`.`c_username`) WHERE (``.`profile' at line 1 [ SELECT `offers`.`id` FROM  LEFT JOIN `offers` ON (``.`username` = `offers`.`c_username`) WHERE (``.`profile_fields` LIKE '%東京%' OR `offers`.`message` LIKE '%東京%' OR `offers`.`message` LIKE '%東京%' OR `offers`.`message` LIKE '%東京%' OR `offers`.`message` LIKE '%東京%' OR `offers`.`message` LIKE '%東京%' OR `offers`.`message` LIKE '%東京%' OR `offers`.`message` LIKE '%東京%' OR `offers`.`message` LIKE '%東京%' OR `offers`.`message` LIKE '%東京%' OR `offers`.`message` LIKE '%東京%' OR `offers`.`message` LIKE '%東京%') AND (``.`profile_fields` LIKE '%うんこ%' OR `offers`.`message` LIKE '%うんこ%' OR `offers`.`message` LIKE '%うんこ%' OR `offers`.`message` LIKE '%うんこ%' OR `offers`.`message` LIKE '%うんこ%' OR `offers`.`message` LIKE '%うんこ%' OR `offers`.`message` LIKE '%うんこ%' OR `offers`.`message` LIKE '%うんこ%' OR `offers`.`message` LIKE '%うんこ%' OR `offers`.`message` LIKE '%うんこ%' OR `offers`.`message` LIKE '%うんこ%' OR `offers`.`message` LIKE '%うんこ%') ] in C:\Users\yuduru\work\fuelphp\fuel\core\classes\database\mysqli\connection.php on line 290
INFO - 2015-07-30 17:44:21 --> Fuel\Core\Request::__construct - Creating a new main Request with URI = "offers/search"
INFO - 2015-07-30 17:44:21 --> Fuel\Core\Request::execute - Called
INFO - 2015-07-30 17:44:21 --> Fuel\Core\Request::execute - Setting main Request
ERROR - 2015-07-30 17:44:22 --> Notice - Undefined variable: title in C:\Users\yuduru\work\fuelphp\fuel\app\views\template.php on line 5
INFO - 2015-07-30 17:50:58 --> Fuel\Core\Request::__construct - Creating a new main Request with URI = "offers/search"
INFO - 2015-07-30 17:50:58 --> Fuel\Core\Request::execute - Called
INFO - 2015-07-30 17:50:58 --> Fuel\Core\Request::execute - Setting main Request
ERROR - 2015-07-30 17:50:58 --> Notice - Undefined variable: profile in C:\Users\yuduru\work\fuelphp\fuel\app\classes\controller\offers.php on line 46
INFO - 2015-07-30 17:51:17 --> Fuel\Core\Request::__construct - Creating a new main Request with URI = "offers/search"
INFO - 2015-07-30 17:51:17 --> Fuel\Core\Request::execute - Called
INFO - 2015-07-30 17:51:17 --> Fuel\Core\Request::execute - Setting main Request
INFO - 2015-07-30 17:54:18 --> Fuel\Core\Request::__construct - Creating a new main Request with URI = "offers/search"
INFO - 2015-07-30 17:54:18 --> Fuel\Core\Request::execute - Called
INFO - 2015-07-30 17:54:18 --> Fuel\Core\Request::execute - Setting main Request
INFO - 2015-07-30 17:54:53 --> Fuel\Core\Request::__construct - Creating a new main Request with URI = "offers/search"
INFO - 2015-07-30 17:54:53 --> Fuel\Core\Request::execute - Called
INFO - 2015-07-30 17:54:53 --> Fuel\Core\Request::execute - Setting main Request
INFO - 2015-07-30 17:58:19 --> Fuel\Core\Request::__construct - Creating a new main Request with URI = "offers/search"
INFO - 2015-07-30 17:58:19 --> Fuel\Core\Request::execute - Called
INFO - 2015-07-30 17:58:19 --> Fuel\Core\Request::execute - Setting main Request
INFO - 2015-07-30 17:58:31 --> Fuel\Core\Request::__construct - Creating a new main Request with URI = "offers/search"
INFO - 2015-07-30 17:58:31 --> Fuel\Core\Request::execute - Called
INFO - 2015-07-30 17:58:31 --> Fuel\Core\Request::execute - Setting main Request
INFO - 2015-07-30 17:59:59 --> Fuel\Core\Request::__construct - Creating a new main Request with URI = "offers/search"
INFO - 2015-07-30 17:59:59 --> Fuel\Core\Request::execute - Called
INFO - 2015-07-30 17:59:59 --> Fuel\Core\Request::execute - Setting main Request
