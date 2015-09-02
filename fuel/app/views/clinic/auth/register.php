<?php if (isset($register_error)): ?>
<div class="alert-danger"><div class="alert alert-danger" role="alert">
	<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
	<?php echo $register_error; ?>
</div>
<?php endif; ?>
<?php echo Asset::js('ziptoaddress.js')?>
<div class="col-md-6">
	<?php echo $c_register_form; ?>
</div>