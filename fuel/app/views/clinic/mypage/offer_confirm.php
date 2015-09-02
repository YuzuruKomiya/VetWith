<?php
	$tags_attatched_input = str::make_lb_and_para_into_tags($input);
?>
<div class="alert alert-warning" role="alert">
	<p>VetWithにログインしている全ユーザーが、このフォームに入力した内容を閲覧することができます。入力内容にご注意ください。</p>
	<p>以下の内容でよろしければ、登録ボタンを押してください。</p>
</div>
<div class="row">
	<div class="col-md-12 offerregister">
		<h4>
		<span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>
			簡単な病院のキャッチコピーを教えて下さい。
		</h4>
		<div class="offersubcontents employbox">
			<?php echo $tags_attatched_input['catchcopy']; ?>	
		</div>
		<h4>
		<span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>
			病院の症例数、手術数をくわしく教えてください。
		</h4>
		<div class="offersubcontents employbox">
			<?php echo $tags_attatched_input['operation']; ?>	
		</div>
		<h4>
			<span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>
			力を入れている分野、治療法などについて教えて下さい。
		</h4>
		<div class="offersubcontents employbox">
			<?php echo $tags_attatched_input['realm']; ?>	
		</div>
		<h4>
			<span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>
			獲得できる手技や裁量の広がり方、キャリア形成についてくわしく教えて下さい。
		</h4>
		<div class="offersubcontents employbox">
			<?php echo $tags_attatched_input['career']; ?>		
		</div>
		<h4>
			<span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>
			新卒獣医師の育成方針についてくわしく教えて下さい。
		</h4>
		<div class="offersubcontents employbox">
			<?php echo $tags_attatched_input['training']; ?>	
		</div>
		<h4>
			<span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>
			給与体系や保険について、できるだけ具体的に教えてください。
		</h4>
		<div class="offersubcontents employbox">
			<?php echo $tags_attatched_input['salary']; ?>		
		</div>
		<h4>
			<span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>
			労働時間や残業時間、残業手当について具体的に教えてください。
		</h4>
		<div class="offersubcontents employbox">
			<?php echo $tags_attatched_input['working_hour']; ?>	
		</div>
		<h4>
			<span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>
			働いている獣医師の主な出身大学について教えて下さい。
		</h4>
		<div class="offersubcontents employbox">
			<?php echo $tags_attatched_input['graduation']; ?>		
		</div>
		<h4>
			<span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>
			動物病院の周囲の居住環境や交通の便について教えて下さい。
		</h4>
		<div class="offersubcontents employbox">
			<?php echo $tags_attatched_input['environment']; ?>	
		</div>
		<h4>
			<span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>
			動物病院の目指す将来像について教えて下さい。
		</h4>
		<div class="offersubcontents employbox">
			<?php echo $tags_attatched_input['future']; ?>	
		</div>
		<h4>
			<span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>
			学生に対して発信したいメッセージを自由に記入してください。
		</h4>
		<div class="offersubcontents employbox">
			<?php echo $tags_attatched_input['message']; ?>	
		</div>
		<?php
		echo Form::open('clinic/mypage/offer_register');

		echo Form::hidden('catchcopy',		$input['catchcopy']);
		echo Form::hidden('operation',		$input['operation']);
		echo Form::hidden('realm',			$input['realm']);
		echo Form::hidden('career',			$input['career']);
		echo Form::hidden('training',		$input['training']);
		echo Form::hidden('salary',			$input['salary']);
		echo Form::hidden('working_hour',	$input['working_hour']);
		echo Form::hidden('graduation',		$input['graduation']);
		echo Form::hidden('environment',	$input['environment']);
		echo Form::hidden('future',			$input['future']);
		echo Form::hidden('message',		$input['message']);
		?>
		<p class="text-center">
			<?php echo Form::submit('submit1', '修正する', array('class' => 'btn btn-default btn-lg')); ?>
		</p>
		<?php
		echo Form::close();


		echo Form::open('clinic/mypage/offer_completion');

		echo Form::csrf();
		echo Form::hidden('catchcopy',		$input['catchcopy'],	array('id' => 'preuser_id'));
		echo Form::hidden('operation',		$input['operation'],	array('id' => 'preuser_id'));
		echo Form::hidden('realm',			$input['realm'],		array('id' => 'preuser_id'));
		echo Form::hidden('career',			$input['career'],		array('id' => 'preuser_id'));
		echo Form::hidden('training',		$input['training'],		array('id' => 'preuser_id'));
		echo Form::hidden('salary',			$input['salary'],		array('id' => 'preuser_id'));
		echo Form::hidden('working_hour',	$input['working_hour'],	array('id' => 'preuser_id'));
		echo Form::hidden('graduation',		$input['graduation'],	array('id' => 'preuser_id'));
		echo Form::hidden('environment',	$input['environment'],	array('id' => 'preuser_id'));
		echo Form::hidden('future',			$input['future'],		array('id' => 'preuser_id'));
		echo Form::hidden('message',		$input['message'],		array('id' => 'preuser_id'));
		?>
		<p class="text-center">
			<?php echo Form::submit('submit2', '登録する', array('class' => 'btn btn-primary btn-lg')); ?>
		</p>
		<?php
		echo Form::close();
		?>
	</div>
</div>