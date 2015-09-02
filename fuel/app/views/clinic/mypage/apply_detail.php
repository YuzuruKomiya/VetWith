<div class="row">
	<div class="col-md-12 offerregister">
		<div class="alert alert-warning" role="alert">
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			出稿した求人に募集した学生の詳細な情報です。
		</div>
		<div class="boxpaddingsmall">
			<ul>
				<li>
					折り返し学生のメールアドレスもしくは電話番号に連絡し、動物病院での見学や面談を含む受け入れの可否、その方法などを双方でやりとりしてください。
				</li>
				<li>
					見学や面談、実習の実施の有無、またその後の採用（もしくは不採用）が決定しましたら、是非「<?php echo Html::anchor(Uri::base().'clinic/mypage/report/'.$apply_array['array_id'] , '最終報告'); ?>」よりアンケートにお答えください。
				</li>
			</ul>
		</div>
		<div class="boxpaddingsmall">
			<h2>
				応募詳細
				<small></small>
			</h2>
			<?php
				if ($apply_array['already_read'] == 2)
					{
						echo '<span class="label label-danger">最終報告済み</span>';
					}
			?>
			<table class="table table-striped table-hover">
				<tr class="info">
					<td>応募日</td>
					<td>
						<?php echo date('Y年n月j日 G時i分',$apply_array['created_at']);  ?>
					</td>
				</tr>
				<tr>
					<td>氏名</td>
					<td>
						<?php
							echo $apply_array['l_name'] . ' ' . $apply_array['f_name']
								. '（' . $apply_array['l_name_kana'] . ' ' . $apply_array['f_name_kana'] . '）';
						?>
					</td>
				</tr>
				<tr>
					<td>性別</td>
					<td>
						<?php echo $apply_array['gender']; ?>
					</td>
				</tr>
				<tr>
					<td>大学</td>
					<td>
						<?php echo $apply_array['university']; ?>
					</td>
				</tr>
				<tr>
					<td>学年</td>
					<td>
						<?php echo $apply_array['grade']; ?>
					</td>
				</tr>
				<tr>
					<td>誕生日</td>
					<td>
						<?php echo $apply_array['birthday']; ?>
					</td>
				</tr>
				<tr>
					<td>住所</td>
					<td>
						<?php echo $apply_array['zip3'].'-'.$apply_array['zip4']; ?><br />
						<?php echo $apply_array['prefecture'].$apply_array['address']; ?>
					</td>
				</tr>
				<tr>
					<td>メールアドレス</td>
					<td>
						<?php echo $apply_array['email']; ?>
					</td>
				</tr>
				<tr>
					<td>電話番号</td>
					<td>
						<?php echo $apply_array['phone_number']; ?>
					</td>
				</tr>
				<tr>
					<td>応募目的</td>
					<td>
						<?php echo $apply_array['objective']; ?>
					</td>
				</tr>
				<tr>
					<td>応募理由</td>
					<td>
						<?php echo Str::make_lb_and_para_into_tags($apply_array['contents']); ?>
					</td>
				</tr>
			</table>
			<?php if ($apply_array['already_read'] != 2): ?>
			<p class="text-center">
				<?php echo Html::anchor(Uri::base().'clinic/mypage/report/'.$apply_array['array_id'] , '最終報告をする', array('class' => 'btn btn-primary btn-lg')); ?>
			</p>
			<?php endif; ?>
		</div>
	</div>
</div>