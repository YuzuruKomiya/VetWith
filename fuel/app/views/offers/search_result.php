検索結果：<?php echo $number.'件'; ?>
<hr>
<div class="container">
	<div class="row">
		<div class="col-xs-8 col-xs-offset-2">
			<h4>
				<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
				求人検索
			</h4>
			<?php echo Form::open(array('action' => 'offers/search', 'method' => 'get', 'class' => 'form-inline')); ?>
			<?php echo Form::input('q', Input::get('q'), array('class' => 'form-control')); ?>
			<?php echo Form::submit('submit', '検索', array('class' => 'btn btn-primary')); ?>
			<?php echo Form::close(); ?>
<?php
foreach ($offers as $offer)
{
?>
<div class="anken">
	<h2 class="hospitalname">
		<span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span>
		<?php echo html::anchor(Uri::base().'offers/'.$offer['clinic_id'], $offer['profile_fields']['c_name']); ?>
	</h2>
	<h3 class="catchcopy">
		<?php echo $offer['catchcopy']; ?>
	</h3>
    <div class="prefecture">
		<?php echo html::anchor(Uri::base().'offers/search?q='.$offer['profile_fields']['prefecture'], $offer['profile_fields']['prefecture']); ?>
	</div>
	<div class="boxpaddingsmall">
		<p class="text-center">
			<?php echo Asset::img($offer['c_image'], array('id' => 'searchimage')); ?>
		</p>
			<table class="table ankentable">
				<tbody>
					<tr>
						<th>所在地</th>
						<td>
							<p>
								<?php echo $offer['profile_fields']['prefecture'].$offer['profile_fields']['address']; ?>
							</p>
						</td>
					</tr>
					<tr>
						<th>代表者</th>
						<td>
							<p>
								<?php echo $offer['profile_fields']['l_name']. '　'
								.$offer['profile_fields']['f_name']; ?>
							</p>
						</td>
					</tr>
					<tr>
						<th>獣医師数</th>
						<td>
							<p>
								<?php echo $offer['profile_fields']['doctor_number'].'人'; ?>
							</p>
						</td>
					</tr>
				</tbody>
			</table>
	</div>
    <div class="boxpaddingsmall">   
		<div class="message">
			<p>
				<?php echo Str::make_lb_and_para_into_tags($offer['message']); ?>
			</p>
		</div>
	</div>
	<div class="boxpaddingsmall"> 
		<p class="text-center">
			<?php echo html::anchor(Uri::base().'offers/'.$offer['clinic_id'], '採用情報の詳細を見る', array('class' => 'btn btn-primary btn-lg')); ?>
		</p>
	</div>
</div><!-- anken -->
<?php
}
?>
<?php echo $paging_bar; ?>
		</div>
	</div>
</div>
