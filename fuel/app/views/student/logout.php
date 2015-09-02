<p>ログアウトしました。</p>
<hr>
<h2>ログイン</h2>
<?php echo Form::open('student/auth/login'); ?>
<p>
	<?php echo Form::label('ユーザー名', 'username'); ?>
	<?php echo Form::input('s_username', Input::post('s_username')); ?>
</p>
<p>
	<?php echo Form::label('パスワード', 'password'); ?>
	<?php echo Form::input('s_password', Input::post('s_password')); ?>
</p>
<div class="actions">
	<?php echo Form::submit('submit', 'ログイン'); ?>
</div>
<?php echo Form::close(); ?>