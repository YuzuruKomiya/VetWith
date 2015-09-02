<div class="alert alert-warning" role="alert">
	<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
	求人に応募した学生とのマッチングについて、最終報告をお願いします。
</div>
<div class="boxpaddingsmall">
	<ul>
		<li>
			今後のサービス改善のために、今回応募のあった募集について簡単なアンケートにお答えください。
		</li>
		<li>
			「*」印のついた項目は必須項目です。
		</li>
	</ul>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 col-md-12">
			<div class="panel panel-info">
				<div class="panel-heading">
					<h4>
						<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
						報告内容
					</h4>
				</div>
				<div class="panel-body form-group">
					<?php if (isset($report_error)): ?>
						<div class="alert alert-danger" role="alert">
							<?php echo $report_error; ?>
						</div>
					<?php endif; ?>
					<?php echo Form::open(array('action' => 'clinic/mypage/report_completion/'.$apply_array['id'] , 'method' => 'post',));?>
						<?php echo Form::csrf(); ?>
						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-12 col-md-12 page-header">
									<h4>実施内容 <small>*</small></h4>
								</div>
								<div class="col-xs-12 col-md-6 boxpaddingsmall">
									<p>
										<?php echo Form::radio('contents', '見学を実施', '', array('id' => 'form_contents_1')) ?>
										<?php echo Form::label('見学を実施', 'contents_1', array('class' => 'control-label')) ?>
									</p>
									<p>
										<?php echo Form::radio('contents', '面談を実施', '', array('id' => 'form_contents_2')) ?>
										<?php echo Form::label('面談を実施', 'contents_2', array('class' => 'control-label')) ?>
									</p>
									<p>
										<?php echo Form::radio('contents', '実習を実施', '', array('id' => 'form_contents_3')) ?>
										<?php echo Form::label('実習を実施', 'contents_3', array('class' => 'control-label')) ?>
									</p>
								</div>
								<div class="col-xs-12 col-md-6 boxpaddingsmall">
									<p>
										<?php echo Form::radio('contents', '見学と面談を実施', '', array('id' => 'form_contents_4')) ?>
										<?php echo Form::label('見学と面談を実施', 'contents_4', array('class' => 'control-label')) ?>
									</p>
									<p>
										<?php echo Form::radio('contents', '面談と実習を実施', '', array('id' => 'form_contents_5')) ?>
										<?php echo Form::label('面談と実習を実施', 'contents_5', array('class' => 'control-label')) ?>
									</p>
									<p>
										<?php echo Form::radio('contents', '実施せず', '', array('id' => 'form_contents_0')) ?>
										<?php echo Form::label('実施せず', 'contents_0', array('class' => 'control-label')) ?>
									</p>
								</div>
							</div>
						</div>
						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-12 col-md-12 page-header">
									<h4>マッチング状況 <small>*</small></h4>
								</div>
								<div class="col-xs-12 col-md-6 boxpaddingsmall">
									<p>
										<?php echo Form::radio('result', '内定を出し、雇用できた', '', array('id' => 'form_result_1')) ?>
										<?php echo Form::label('内定を出し、雇用できた', 'result_1', array('class' => 'control-label')) ?>
									</p>
									<p>
										<?php echo Form::radio('result', '内定を出したが雇用できず。', '', array('id' => 'form_result_2')) ?>
										<?php echo Form::label('内定を出したが雇用できず。', 'result_2', array('class' => 'control-label')) ?>
									</p>
									<p>
										<?php echo Form::radio('result', '内定を出さず', '', array('id' => 'form_result_3')) ?>
										<?php echo Form::label('内定を出さず', 'result_3', array('class' => 'control-label')) ?>
									</p>
								</div>
								<div class="col-xs-10 col-md-5 boxpaddingsmall">
									<p>
										<?php echo Form::radio('result', 'その他', '', array('id' => 'form_result_0')) ?>
										<?php echo Form::label('その他', 'result_0', array('class' => 'control-label')) ?>
									</p>
								</div>
							</div>
						</div>
						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-12 col-md-12 page-header">
									<h4>サービスについて</h4>
								</div>
								<div class="col-xs-12 col-md-6 boxpaddingsmall">
									<p>
										<?php echo Form::label('不便だった点をお教え下さい。（200文字以内）', 'improvement', array('class' => 'control-label')) ?>
										<?php echo Form::textarea('improvement', '', array('id' => 'form_improvement', 'class' => 'form-control offertextarea', 'rows' => 6, 'cols'=> 70)) ?>		
									</p>
								</div>
							</div>
						</div>
						<p class="text-center">
							<?php echo Form::submit('submit', '報告する', array('class' => 'btn btn-primary btn-lg')); ?>
						</p>
					<?php echo Form::close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>