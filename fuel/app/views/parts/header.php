<script id="script"
	data-studenturi	= '<?php echo json_encode(Uri::base().'student/auth/login'); ?>'
    data-clinicuri	= '<?php echo json_encode(Uri::base().'clinic/auth/login'); ?>'
></script>
<nav class="navbar navbar-default navbar-fixed-top" id="header">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed"data-toggle="collapse"data-target="#navbarEexample8">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>	
				<span class="icon-bar"></span>
			</button>
			<?php echo HTML::anchor(Uri::base(), 'VetWith', array('class' => 'navbar-brand'))?>
		</div>
		
		<div class="collapse navbar-collapse" id="navbarEexample8">
			<ul class="nav navbar-nav">
				<li>
					<?php echo Html::anchor(Uri::base().'student/mypage', '学生マイページ') ; ?>
				</li>
				<li>
					<?php echo Html::anchor(Uri::base().'clinic/mypage', '病院マイページ') ; ?>
				</li>
				<li>
					<?php echo Html::anchor(Uri::base().'contact', 'お問い合わせ') ; ?>
				</li>
			</ul>
			<?php $s_auth = Auth::instance('Studentauth'); $c_auth = Auth::instance('Clinicauth');?>
			<?php
			if ($s_auth->check() && ! $c_auth->check())
			{
				 echo Form::open(array('action' => 'student/logout', 'class' => 'navbar-form navbar-right form-inline'));
				 echo Form::submit('submit', 'ログアウト', array('class' => 'btn btn-default'));
				 echo Form::close();
			}
			elseif ( ! $s_auth->check() && $c_auth->check())
			{
				echo Form::open(array('action' => 'clinic/logout', 'class' => 'navbar-form navbar-right form-inline'));
				 echo Form::submit('submit', 'ログアウト', array('class' => 'btn btn-default'));
				 echo Form::close();
			}
			elseif ( ! $s_auth->check() && ! $c_auth->check())
			{
				 echo Form::open(array('action' => 'student/auth/login', 'class' => 'navbar-form navbar-right form-inline', 'id' => 'loginform')); ?>
				<div class="form-group">
					<?php echo Form::label('ユーザー名、もしくはメールアドレス', 's_username', array('class' => 'sr-only')); ?>
					<?php echo Form::input('s_username', '', array('class' => 'form-control', 'id' => 'loginusername', 'placeholder' => 'メールアドレス')); ?>
				</div>
				<div class="form-group">
					<?php echo Form::label('パスワード', 's_password', array('class' => 'sr-only')); ?>
					<?php echo Form::input('s_password', '', array('class' => 'form-control', 'id' => 'loginpassword', 'placeholder' => 'パスワード', 'type' => 'password')); ?>
				</div>
				<div class="form-group">
					<?php echo Form::label('アカウント選択', 'account', array('class' => 'sr-only')); ?>
					<?php echo Form::select('account', '', array(
						'student'	=> '学生',
						'clinic'	=> '病院'
					),array('class' => 'form-control')); ?>
				</div>
				<?php echo Form::submit('submit', 'ログイン', array('class' => 'btn btn-default')); ?>
				<?php echo Form::close(); }?>
		</div>
	</div>
</nav>


