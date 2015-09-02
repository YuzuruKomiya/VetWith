<?php if (isset($error_message)): ?>
<div class="alert alert-danger">
	<?php echo $error_message; ?>
</div>
<?php endif; ?>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-md-4 boxpaddingsmall">
			<p>
				求人検索の文字列には
			</p>
			<ul>
				<li>動物病院名</li>
				<li>都道府県名</li>
				<li>住所</li>
				<li>採用条件</li>
			</ul>
			<p>
				などを指定することができます。
			</p>
		</div>
		<div class="col-xs-4 col-md-4 boxpaddingsmall form-group">
			<h4>
				<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
				求人検索
			</h4>
			<?php echo Form::open(array('action' => 'offers/search', 'method' => 'get', 'class' => 'form-inline')); ?>
			<?php echo Form::input('q', Input::get('q'), array('class' => 'form-control')); ?>
			<?php echo Form::submit('submit', '検索', array('class' => 'btn btn-primary')); ?>
			<?php echo Form::close(); ?>
		</div>
	</div>
</div>
