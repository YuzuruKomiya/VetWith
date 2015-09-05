<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>VetWith</title>
	<meta name="viewport" content="width=device-width,minimum-scale=1">
	<meta name="description" content="VetWith（ベットウィズ）は「動物病院に勤務したい獣医学生」と「獣医学生を採用したい動物病院」を結びつける、完全無料の	求人掲載プラットフォームです。">
	<meta property="og:url"           content="http://vetwith.com/" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="VetWith（ベットウィズ）" />
    <meta property="og:description"   content="VetWith（ベットウィズ）は「動物病院に勤務したい獣医学生」と「獣医学生を採用したい動物病院」を結びつける、完全無料の	求人掲載プラットフォームです。" />
    <meta property="og:image"         content="<?php echo Uri::base().'assets/img/top/student.png' ?>" />
	<?php echo Asset::css('normalize.css');?>
	<?php echo Asset::css('bootstrap.min.css');?>
	<?php echo Asset::css('mystyle.css');?>
	<?php echo Asset::js(array(
			'https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js',
			'bootstrap.min.js'
		)); ?>
	<?php echo Asset::js('chooseauth.js'); ?>
	<?php echo Asset::js('scrollthentransparent.js'); ?>
</head>
<script type="text/javascript">	
// ページアンカーをヘッダ分ずらす
$(function () {
    var headerHight = 100; //ヘッダの高さ
    $('a[href^=#]').click(function(){
        var href= $(this).attr("href");
        var target = $(href == "#" || href == "" ? 'html' : href);
        var position = target.offset().top-headerHight; //ヘッダの高さ分位置をずらす
        $("html, body").animate({scrollTop:position}, 550, "swing");
        return false;
    });
});
</script>
<body data-spy="scroll" data-target="#affix-nav" data-offset="250">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_KS/sdk.js#xfbml=1&version=v2.4";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
	<div id="wrapper">
		<?php echo $header; ?>
		<div class="container-fluid mainvisual" id="mainvisual">
			<div class="row maininner">
				<div class="maincopy col-xs-12 col-md-8 col-md-offset-2">
					<h1 id="mainlogo">
						<span style="color: #fdcea0;">V</span>et<span style="color: #fdcea0;">W</span>ith <small>(beta)</small>
					</h1>
					<p class="shadowtextwhite">
						VetWith（ベットウィズ）は<br />
						「動物病院に勤務したい獣医学生」と「獣医学生を採用したい動物病院」<br />
						を結びつける、完全無料の	求人掲載プラットフォームです。
					</p>
					<div class="boxpaddingsmall" id="mainsearchbox">
						<p>
							<?php echo Form::open(array('action' => 'offers/search', 'method' => 'get', 'class' => 'form-inline')); ?>
							<?php echo Form::input('q', Input::get('q'), array('class' => 'form-control input-lg', 'placeholder' => '地名や設備など')); ?>
							<?php echo Form::submit('submit', '求人検索', array('class' => 'btn btn-primary btn-lg')); ?>
							<?php echo Form::close(); ?>
						</p>
					</div>
					<div class="boxpaddingsmall">
						<?php echo Html::anchor(Uri::base().'student/auth/invite', '獣医学生の登録', array('class' => 'btn btn-default btn-lg')); ?>
						<?php echo Html::anchor(Uri::base().'clinic/auth/invite', '動物病院の登録', array('class' => 'btn btn-warning btn-lg')); ?>
					</div>
				</div>
			</div>
		</div>
		<p class="text-center boxpaddingsmall">
			<?php echo Asset::img('top/student.png', array('class' => 'topcircleimage')); ?>
		</p>
		<div class="container">
			<div class="row">
				<div class="col-xs-8 col-xs-offset-2 col-md-6 col-md-offset-3">
					<h2 class="text-center topsubcontents">
						<span class="toplettersvetwith">VetWith</span>
						×
						<span class="toplettersstudents">Veterinary Students</span>
					</h2>
				</div>
			</div>
		</div>
		<div class="container content" id="content1">
			<div class="row inner1">
				<div class="col-xs-12 col-md-4 scopy">
					<h3 class="text-center">1.なりたい獣医師になる</h3>
					<p>
						「症例数」「設備」「新人教育」「キャリア形成」といった情報から、自分の目指す獣医師像にマッチする動物病院を探すことができます。
					</p>
				</div>
				<div class="col-xs-12 col-md-4 scopy">
					<h3 class="text-center">2.獣医師の生活を知る</h3>
					<p>
						「給与」「保険」「労働時間」「生活環境」といった普段得ることの難しい情報から、より具体的な臨床獣医師の生活を想像することができます。
					</p>
				</div>
				<div class="col-xs-12 col-md-4 scopy">
					<h3 class="text-center">3.動物病院を理解する</h3>
					<p>
						設備や環境、給与だけが動物病院に勤務する理由にはなりません。
					</p>
					<p>
						ベットウィズでは実際に動物病院に「見学」「面談」「実習」しに行くことで、動物病院の実際を理解できます。
					</p>
				</div>
				<div class="col-xs-12 col-md-8 col-md-offset-2 topmailform">
					<?php echo Form::open(array('action' => 'student/auth/send_invitation', 'class' => 'form-horizontal', 'method' => 'post')); ?>
					<div class="row">
						<div class="col-md-12 topmailformguide">
							学生はこちらからご登録ください。折り返し連絡差し上げます。
						</div>
						<div class="col-md-10">
							<?php echo Form::input('s_email', '', array('class' => 'form-control input-lg', 'placeholder' => 'メールアドレスを入力してください')); ?>
							<?php echo Form::csrf(); ?>
						</div>
						<div class="col-md-2">
							<?php echo Form::submit('submit', '登録', array('class' => 'btn btn-success btn-lg')); ?>
						</div>
					</div>
					<?php echo Form::close(); ?>
				</div>
			</div>
		</div>
		<div class="container-fluid subvisual" id="subvisual">
			<div class="row subinner">
				<div class="subcopy">
					<p class="subcatchcopy">
						<span class="free">Free!</span>
					</p>
					<p>
						すべてのサービスは無料です。
					</p>
					<p>
						学生も動物病院も一切のお金をお支払いいただく必要はございません。
					</p>
				</div>
			</div>
		</div>
		<p class="text-center boxpaddingsmall">
			<?php echo Asset::img('top/doctor.jpg', array('class' => 'topcircleimage')); ?>
		</p>
		<div class="container">
			<div class="row">
				<div class="col-xs-8 col-xs-offset-2 col-md-6 col-md-offset-3">
					<h2 class="text-center topsubcontents">
						<span class="toplettersvetwith">VetWith</span>
						×
						<span class="toplettersclinics">Animal Clinics</span>
					</h2>
				</div>
			</div>
		</div>
		<div class="container content" id="content2">
			<div class="row inner2">
				<div class="col-xs-12 col-md-4 ccopy">
					<h3 class="text-center">1.求人を周知する</h3>
					<p>
						アナログな求人にはない即時性、訴求力で広く求人を周知できます。
					</p>
					<p>
						求人の内容はパソコンやスマートフォンからすぐに修正が可能で、ボタン一つで求人の出稿、取り消しもできます。
					</p>
					<p>
						求人はフリーフォーマットなので、病院の強みをもれなく伝達できます。
					</p>
				</div>
				<div class="col-xs-12 col-md-4 ccopy">
					<h3 class="text-center">2.学生と直接交流する</h3>
					<p>
						求人に応募する学生とはメールや電話で直接やりとりができます。
					</p>
					<p>
						ウェブサイトを仲介しないため、学生の見学や実習の受け入れなどをよりスムーズに行うことができます。
					</p>
				</div>
				<div class="col-xs-12 col-md-4 ccopy">
					<h3 class="text-center">3.適合する学生を採用する</h3>
					<p>
						より詳細で質の高い求人の掲載に加え、学生と直接コミュニケーションをとれるため、動物病院によりマッチした学生を採用することができます。
					</p>
				</div>
				<div class="col-xs-12 col-md-8 col-md-offset-2 topmailform">
					<?php echo Form::open(array('action' => 'clinic/auth/send_invitation', 'class' => 'form-horizontal', 'method' => 'post')); ?>
					<div class="row">
						<div class="col-md-12 topmailformguide">
							動物病院の採用担当者の方はこちらからご登録ください。折り返し連絡差し上げます。
						</div>
						<div class="col-md-10">
							<?php echo Form::input('c_email', '', array('class' => 'form-control input-lg', 'placeholder' => 'メールアドレスを入力してください')); ?>
							<?php echo Form::csrf(); ?>
						</div>
						<div class="col-md-2">
							<?php echo Form::submit('submit', '登録', array('class' => 'btn btn-primary btn-lg')); ?>
						</div>
					</div>
					<?php echo Form::close(); ?>
				</div>
			</div>
		</div>
	</div>
	<div id="footer">
		<?php echo $footer; ?>
	</div>
</body>
</html>

