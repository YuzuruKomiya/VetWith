<p>ログアウトしました。</p>
<hr>
<h2>ログイン</h2>
<?php echo Form::open('clinic/auth/login'); ?>
<p>
	<?php echo Form::label('ユーザー名', 'c_username'); ?>
	<?php echo Form::input('c_username', Input::post('c_username')); ?>
</p>
<p>
	<?php echo Form::label('パスワード', 'c_password'); ?>
	<?php echo Form::input('c_password', Input::post('c_password')); ?>
</p>
<div class="actions">
	<?php echo Form::submit('submit', 'ログイン'); ?>
</div>
<?php echo Form::close(); ?>