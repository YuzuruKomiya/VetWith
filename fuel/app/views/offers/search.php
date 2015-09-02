<div class="container">
	<div class="row">
		<div class="col-xs-8 col-xs-offset-2 boxpaddingsmall">
			<h4>
				<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
				動物病院求人検索
			</h4>
			<p>
				・検索文字列には、「動物病院名」「都道府県名」「住所」「採用条件」などを指定することができます。
			</p>
			<?php echo Form::open(array('action' => 'offers/search', 'method' => 'get')); ?>
			<?php echo Form::input('q', Input::get('q'), array('class' => 'form-control')); ?>
			<p class="boxpaddingsmall text-center">
				<?php echo Form::submit('submit', '検索', array('class' => 'btn btn-primary')); ?>
			</p>
			<?php echo Form::close(); ?>
		</div>
	</div>
</div>