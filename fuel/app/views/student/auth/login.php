<?php if (isset($login_error)): ?>
<?php echo $login_error; ?>
<?php endif; ?>

<div class="form-group row">
	<div class="col-xs-4">
	<?php echo Form::open('student/auth/login'); ?>
	<p>
		<?php echo Form::label('ユーザー名、もしくはメールアドレス', 's_username'); ?>
		<?php echo Form::input('s_username', Input::post('s_username'), array('class' => 'form-control')); ?>
	</p> 
	<p>
		<?php echo Form::label('パスワード', 's_password'); ?>
		<?php echo Form::input('s_password', Input::post('s_password'), array('class' => 'form-control', 'type'=> 'password')); ?>
	</p>
	<div class="actions">
		<?php echo Form::submit('submit', 'ログイン', array('class' => 'btn btn-primary')); ?>
	</div>
	<?php echo Form::close(); ?>
	</div>
</div>
<div class="boxpaddingsmall">
	<p>
		<?php echo Html::anchor(uri::base().'clinic/auth/login', '動物病院ログイン'); ?>
	</p>
</div>
