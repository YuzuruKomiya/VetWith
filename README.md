# VetWith

VetWith（ベットウィズ）は「動物病院に勤務したい獣医学生」と「獣医学生を採用したい動物病院」を結びつける、完全無料の求人掲載プラットフォームです。

## できること
1.動物病院は求人を出稿、掲載します。  
2.学生は掲載された求人に応募します。  
3.応募後、メールもしくは電話で動物病院と学生は見学、実習の予定を立てます。

## 主なファイルの内包する機能
### APPPATH/classes/controller/clinic/auth.php
* 動物病院の会員登録のためのメール認証および会員登録。

### APPPATH/classes/controller/clinic/logout.php
* 動物病院のログアウト。

### APPPATH/classes/controller/clinic/mypage.php
* 動物病院のマイページ。求人の出稿、掲載やそれに必要な画像のアップロード、登録内容の変更、応募のあった求人のチェック。

### APPPATH/classes/controller/student/auth.php
* 獣医学生の会員登録のためのメール認証および会員登録。

### APPPATH/classes/controller/clinic/logout.php
* 獣医学生のログアウト。

### APPPATH/classes/controller/clinic/mypage.php
* 獣医学生のマイページ。登録したブックマークのチェック。

### APPPATH/classes/controller/bookmark.php
* ページ遷移なしでブックマーク登録/解除するためのajaxの一部。

### APPPATH/classes/controller/contact.php
* お問い合わせ

### APPPATH/classes/controller/offers.php
* 求人の表示、検索。
