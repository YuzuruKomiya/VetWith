<?php if (isset($register_error)): ?>
<div class="alert alert-danger" role="alert">
	<?php echo $register_error; ?>
</div>
<?php endif; ?>
<?php echo Asset::js('ziptoaddress.js')?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6">
			<?php echo $s_register_form; ?>
		</div>
	</div>
</div>