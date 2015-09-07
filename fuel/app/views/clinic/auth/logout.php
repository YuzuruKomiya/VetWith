<p>ログアウトしました。</p>
<hr>
<h2>ログイン</h2>
<div class="form-group row">
	<div class="col-xs-12 col-md-4">
	<?php echo Form::open('clinic/auth/login'); ?>
	<p>
		<?php echo Form::label('ユーザー名、もしくはメールアドレス', 'c_username'); ?>
		<?php echo Form::input('c_username', Input::post('c_username'), array('class' => 'form-control')); ?>
	</p> 
	<p>
		<?php echo Form::label('パスワード', 'c_password'); ?>
		<?php echo Form::input('c_password', Input::post('c_password'), array('class' => 'form-control', 'type' => 'password')); ?>
	</p>
	<div class="actions">
		<?php echo Form::submit('submit', 'ログイン', array('class' => 'btn btn-primary')); ?>
	</div>
	<?php echo Form::close(); ?>
	</div>
</div>