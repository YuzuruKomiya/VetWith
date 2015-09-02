<?php
	$tag_attatched_input['contents'] = str::make_lb_and_para_into_tags($input['contents']);
?>
<div class="alert alert-warning" role="alert">
	<p>以下の内容でよろしければ、応募ボタンを押してください。</p>
</div>
<h2><?php echo Html::anchor(Uri::base().'offers/'.$c_profile['c_id'], $c_profile['c_name']); ?>への応募</h2>
<hr>
<div class="row">
	<div class="col-xs-12 col-md-8 offerregister">
		<h4>
			・応募目的
		</h4>
		<div class="offersubcontents employbox">
			<?php echo $input['objective']; ?>	
		</div>
		<h4>
			・応募理由
		</h4>
		<div class="offersubcontents employbox">
			<?php echo $tag_attatched_input['contents']; ?>	
		</div>
		<?php
		echo Form::open('offers/apply/'.$c_profile['c_id']);

		echo Form::hidden('objective',		$input['objective']);
		echo Form::hidden('contents',		$input['contents']);
		?>
		<p class="text-center">
			<?php echo Form::submit('submit1', '修正する', array('class' => 'btn btn-default btn-lg')); ?>
		</p>
		<?php
		echo Form::close();


		echo Form::open('offers/apply_completion/'.$c_profile['c_id']);

		echo Form::csrf();
		echo Form::hidden('objective',		$input['objective'],	array('id' => 'preuser_id'));
		echo Form::hidden('contents',		$input['contents'],	array('id' => 'preuser_id'));
		?>
		<p class="text-center">
			<?php echo Form::submit('submit2', '登録する', array('class' => 'btn btn-primary btn-lg')); ?>
		</p>
		<?php
		echo Form::close();
		?>
		
	</div>
</div>

