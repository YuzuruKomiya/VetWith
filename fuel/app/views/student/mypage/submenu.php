<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarEexample7">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<?php echo Html::anchor(Uri::base().'student/mypage/', $profile['l_name'].' '.$profile['f_name'].'さん', array('class' => 'navbar-brand')); ?>
		</div>
		
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li>
					<?php echo Html::anchor(Uri::base().'student/mypage/bookmark', 'ブックマークした求人'); ?>
				</li>
			</ul>
		</div>
	</div>
</nav>