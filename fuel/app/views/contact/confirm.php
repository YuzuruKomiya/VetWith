<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			お問い合わせ内容をご確認ください。
		</div>
		<div class="boxpaddingsmall">
			<ul>
				<li>
					お問い合わせ内容に間違いがないようでしたら、「送信」ボタンを押してください。
				</li>
			</ul>
		</div>
	</div>
	<div class="col-xs-12 col-md-8 col-md-offset-1 boxpaddingsmall">
		<table class="table table-striped table-hover">
			<tbody>
				<tr>
				  <th>名前</th>
				  <td><?php echo $input['name']; ?></td>
				</tr>
				<tr>
				  <th>メールアドレス</th>
				  <td><?php echo $input['email']; ?></td>
				</tr>
				<?php if ( ! empty($input['phone_number'])): ?>
				<tr>
				  <th>電話番号</th>
				  <td><?php echo $input['phone_number']; ?></td>
				</tr>
				<?php endif; ?>
				<tr>
				  <th>コメント</th>
				  <td><?php echo Str::make_lb_and_para_into_tags($input['comment']); ?></td>
				</tr>
			</tbody>
		  </table>
		<?php
		echo Form::open('contact');
		foreach ($input as $key => $value)
		{
			echo Form::hidden($key, $value);
		}
		?>
		<div class="actions">
			<?php echo Form::submit('submit1', '修正', array('class' => 'btn')); ?>
		</div>
		<?php
		echo Form::close();

		echo Form::open('contact/completion');
		echo Form::csrf();
		foreach ($input as $key => $value)
		{
			echo Form::hidden($key, $value , array('id' => $key));
		}
		?>
		<div class="actions">
			<?php echo Form::submit('submit2', '送信', array('class' => 'btn btn-primary')); ?>
		</div>
		<?php
		echo Form::close();
		?>
	</div>
</div>