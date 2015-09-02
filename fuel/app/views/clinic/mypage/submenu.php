<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarEexample7">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<?php echo Html::anchor(Uri::base().'clinic/mypage/', $profile['c_name'], array('class' => 'navbar-brand')); ?>
		</div>
		
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li>
					<?php echo Html::anchor(Uri::base().'clinic/mypage/set_detail', '病院情報の入力・編集'); ?>
				</li>
				<li>
					<?php echo Html::anchor(Uri::base().'clinic/mypage/offer_register', '求人の掲載・編集'); ?>
				</li>
				<li>
					<?php echo Html::anchor(Uri::base().'clinic/mypage/upload_images', '画像掲載'); ?>
				</li>
				<li>
					<?php echo Html::anchor(Uri::base().'clinic/mypage/check_offer', '求人管理'); ?>
				</li>
				<li>
					<?php echo Html::anchor(Uri::base().'clinic/mypage/check_apply', '応募一覧'.' <span class="badge">'.$new_apply_count.'</span>'); ?>
				</li>
			</ul>
		</div>
	</div>
</nav>