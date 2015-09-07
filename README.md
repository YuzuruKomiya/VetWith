# VetWith

VetWith is a web application of job matching platform for veterinary students and animal clinics.
VetWith program is coded by PHP.

VetWith（ベットウィズ）は「動物病院に勤務したい獣医学生」と「獣医学生を採用したい動物病院」を結びつける、完全無料の求人掲載プラットフォームです。
PHPでコーディングされています。

## What you can do with VetWith.
## できること

1.Animal clinics post a job offer.  
2.Veterinary students apply for the offer.  
3.They get contact with each other via email or phone to make plans for clinical teaching.  

1.動物病院は求人を出稿、掲載します。  
2.学生は掲載された求人に応募します。  
3.応募後、メールもしくは電話で動物病院と学生は見学、実習の予定を立てます。

## 主なファイルの内包する機能
## What each main file plays a role of.
### APPPATH/classes/controller/clinic/auth.php
* Authentication via email and member registration for animal clinics.  
* 動物病院の会員登録のためのメール認証および会員登録。

### APPPATH/classes/controller/clinic/logout.php
* Logout for animal clinics.  
* 動物病院のログアウト。

### APPPATH/classes/controller/clinic/mypage.php
* An animal clinics private page to post a job offer, upload their images, check applys and so on.  
* 動物病院のマイページ。求人の出稿、掲載やそれに必要な画像のアップロード、登録内容の変更、応募のあった求人のチェック。

### APPPATH/classes/controller/student/auth.php
* Authentication via email and member registration for veterinary students.  
* 獣医学生の会員登録のためのメール認証および会員登録。

### APPPATH/classes/controller/clinic/logout.php
* Logout for veterinary students.  
* 獣医学生のログアウト。

### APPPATH/classes/controller/clinic/mypage.php
* A veterinary students private page to check bookmarked offer.  
* 獣医学生のマイページ。登録したブックマークのチェック。

### APPPATH/classes/controller/bookmark.php
* A part of ajax function to register a offer for bookmark without page transition.  
* ページ遷移なしでブックマーク登録/解除するためのajaxの一部。

### APPPATH/classes/controller/contact.php
* Contact us.  
* お問い合わせ

### APPPATH/classes/controller/offers.php
* Search for and display job offers.  
* 求人の表示、検索。
