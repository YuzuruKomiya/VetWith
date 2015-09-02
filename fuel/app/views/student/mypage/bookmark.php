<script type="text/javascript">
$(function()
{
	$('.delete').click(function()
	{
		var button = this;
		var c_id   = $(this).attr('c_id');
		$(button).prop('disabled', true);
		
		$.ajax(
		{
			url:		'<?php echo Uri::base();?>'+'bookmark/delete.json',
			type:		'POST',
			dataType:	'json',
			data: {c_id: c_id},
			success: function(data)
			{
				if (data.login_check == false)
				{
					$(button).attr('class', 'btn btn-danger btn-sm delete');
					$(button).text("ログインする必要があります");
					$(button).prop('disabled', true);
				}
				else if(data.login_check == true && data.register_check == false)
				{
					$('tr#' + c_id).hide('slow', function(){ $('tr#' + c_id).remove(); });
				}		
				return;
			},
			error: function()
			{
				alert('サーバーエラーです。');
				console.log("ブックマークに登録できませんでした。");
			}
		});
	});
});
</script>
<div class="boxpaddingsmall">
	<h2>ブックマーク一覧</h2>
	<?php echo '全'.  count($bookmark_array).'件';?>
	<table class="table table-striped">
		<thead>
			<tr class="info">
				<th></th>
				<th>動物病院名</th>
				<th>見学、面談、実習</th>
				<th>管理</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$i = 1;
			foreach ($bookmark_array as $bookmark)
			{
				echo '<tr id="'.$bookmark['c_id'].'">';
				echo '<td>'.$i.'</td>';
				echo '<td>'.Html::anchor(Uri::base().'offers/'.$bookmark['c_id'], $bookmark['c_name']).'</td>';
				echo '<td>'.$bookmark['apply'].'</td>';
				echo '<td>';
				echo '<button type="button" class="btn btn-success btn-sm delete" c_id="'.$bookmark['c_id'].'">削除</button>';
				if ($bookmark['apply'] == '未応募')
				{
					echo ' '.Html::anchor(Uri::base().'offers/apply/'.$bookmark['c_id'], '応募', array('class' => 'btn btn-primary btn-sm'));
				}
				echo '</td>';
				echo '</tr>';

				$i++;
			}
			?>
		</tbody>
	</table>
</div>
