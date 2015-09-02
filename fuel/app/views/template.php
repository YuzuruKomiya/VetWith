<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?> | VetWith</title>
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
// affix
$(document).ready(function(){
	$("#affix-ul").affix({
        offset: { 
            top: 290
        }
    });
});
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
		<div class="container" id="contentsholder">
			<?php echo $header; ?>
			
			<div class="page-header">
				<h1>
					<?php echo $title; ?>
				</h1>
			</div>
			<?php if (isset($submenu)):?>
			<?php echo $submenu; ?>
			<?php endif; ?>

			<?php echo $content; ?>
		</div>
	</div>
	<div id="footer">
		<?php echo $footer; ?>
	</div>
</body>
</html>

