<div class="alert alert-warning" role="alert">
	<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
	面談・実習の募集を含め、求人の管理を行うことができます。
</div>
<div class="boxpaddingsmall">
	<h2>現在掲載している求人</h2>
	<table class="table table-striped">
		<thead>
			<tr class="info">
				<th></th>
				<th>求人の募集状況</th>
				<th>新着連絡</th>
			</tr>
		</thead>
		<tbody>
			<?php
				echo '<tr>';
				echo '<td>'.Html::anchor(Uri::base().'offers/'.$c_id, '掲載中の求人を確認する').'</td>';
				echo '<td>'.$offer['reception'].'</td>';
				echo '<td>0件</td>';
				echo '</tr>';
			?>
		</tbody>
	</table>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 col-md-12 boxpaddingsmall">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h4>
						<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
						募集状況の変更
					</h4>
				</div>
				<div class="panel-body form-group">
					<?php if (isset($reaction)): ?>
						<p class="text-center">
							<span class="text-success">
								<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
								<?php echo $reaction; ?>
							</span>
						</p>
					<?php endif; ?>
					<?php echo Form::open(array('action' => 'clinic/mypage/check_offer', 'method' => 'post',));?>
						<?php echo Form::csrf(); ?>
						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-12 col-md-6 boxpaddingsmall">
									<p>
										<?php echo Form::radio('reception', 2, '', array('id' => 'form_reception_2')) ?>
										<?php echo Form::label('見学を受付中', 'reception_2', array('class' => 'control-label')) ?>
									</p>
									<p>
										<?php echo Form::radio('reception', 3, '', array('id' => 'form_reception_3')) ?>
										<?php echo Form::label('面談を受付中', 'reception_3', array('class' => 'control-label')) ?>
									</p>
									<p>
										<?php echo Form::radio('reception', 5, '', array('id' => 'form_reception_5')) ?>
										<?php echo Form::label('実習を受付中', 'reception_5', array('class' => 'control-label')) ?>
									</p>
								</div>
								<div class="col-xs-12 col-md-6 boxpaddingsmall">
									<p>
										<?php echo Form::radio('reception', 6, '', array('id' => 'form_reception_6')) ?>
										<?php echo Form::label('見学と面談を受付中', 'reception_6', array('class' => 'control-label')) ?>
									</p>
									<p>
										<?php echo Form::radio('reception', 15, '', array('id' => 'form_reception_15')) ?>
										<?php echo Form::label('面談と実習を受付中', 'reception_15', array('class' => 'control-label')) ?>
									</p>
									<p>
										<?php echo Form::radio('reception', 0, '', array('id' => 'form_reception_0')) ?>
										<?php echo Form::label('締め切り中', 'reception_0', array('class' => 'control-label')) ?>
									</p>
								</div>
							</div>
						</div>
						<p class="text-center">
							<?php echo Form::submit('submit', '変更', array('class' => 'btn btn-primary')); ?>
						</p>
					<?php echo Form::close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="boxpaddingsmall">
	<ul>
		<li>
			学生は締め切り中の求人には応募することはできませんが、求人情報を閲覧することはできます。
		</li>
		<li>
			求人を掲載した後で非公開にすることはできません。掲載しない場合は求人を削除してください。
		</li>
	</ul>
</div>