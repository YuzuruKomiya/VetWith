<?php if (isset($send_error)): ?>
<div class="alert alert-danger" role="alert">
	<?php echo $send_error; ?>
</div>
<?php endif; ?>
<div class="row">
	<div class="col-xs-12 col-md-8 col-md-offset-2 topmailform">
		<?php echo Form::open(array('action' => 'student/auth/send_invitation', 'class' => 'form-horizontal', 'method' => 'post')); ?>
		<div class="row">
			<div class="col-md-12 topmailformguide">
				獣医学生はこちらからご登録ください。折り返し連絡差し上げます。
			</div>
			<div class="col-md-10">
				<?php echo Form::input('s_email', Input::post('s_email'), array('class' => 'form-control input-lg', 'placeholder' => 'メールアドレスを入力してください')); ?>
				<?php echo Form::csrf(); ?>
			</div>
			<div class="col-md-2">
				<?php echo Form::submit('submit', '登録', array('class' => 'btn btn-primary btn-lg')); ?>
			</div>
		</div>
		<?php echo Form::close(); ?>
		<div class="boxpaddingsmall text-center">
			<?php echo Html::anchor(Uri::base().'clinic/auth/invite', '動物病院の採用担当者の方はこちらからご登録ください'); ?>
		</div>
	</div>
</div>