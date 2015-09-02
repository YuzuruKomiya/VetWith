<?php

echo $test;

?>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-md-8">
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
		<table class="table ankentable">
			<tbody>
				<tr>
					<td rowspan="3">
						<?php echo Asset::img('clinic.jpg', array('id' => 'searchimage')); ?>
					</td>
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
		</div>
	</div>
</div>
