<?php if (isset($set_error)): ?>
<div class="alert alert-danger">
	<?php echo $set_error; ?>
</div>
<?php endif; ?>
<div class="row">
	<div class="col-md-12 offerregister">
		<div class="alert alert-warning" role="alert">
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			VetWithにログインしている全ユーザーが、このフォームに入力した内容を閲覧することができます。入力内容にご注意ください。
		</div>
		<div class="col-md-6 boxpaddingsmall">
			<?php echo $c_detail_form; ?>
		</div>
	</div>
</div>
