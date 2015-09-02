<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
				<?php if (isset($error_title)): ?>
				<?php echo $error_title; ?>
				<?php endif; ?>
			</div>
			<div class="panel-body">
				<?php if (isset($error_content)): ?>
				<?php echo $error_content; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>