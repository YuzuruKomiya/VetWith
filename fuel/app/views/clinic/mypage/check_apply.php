<div class="boxpaddingsmall">
	<h2>応募一覧</h2>
	<?php echo '全'.  count($apply_array).'件';?>
	<table class="table table-striped">
		<thead>
			<tr class="info">
				<th></th>
				<th>応募日時</th>
				<th>氏名</th>
				<th>性別</th>
				<th>大学</th>
				<th>学年</th>
				<th>目的</th>
				<th>管理</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($apply_array as $apply)
			{
				echo '<tr>';
				echo '<td class="text-center">';
				if ($apply['already_read'] == 0)
				{
					echo '<span class="label label-danger">未読</span>';
				}
				elseif ($apply['already_read'] == 1)
				{
					echo '<span class="label label-warning">既読</span>';
				}
				elseif ($apply['already_read'] == 2)
				{
					echo '<span class="label label-default">終了</span>';
				}
				echo '</td>';
				echo '<td>' . date('Y年n月j日 G時i分',$apply['created_at']) . '</td>';
				echo '<td>'. $apply['l_name']. ' ' . $apply['f_name'] . '</td>';
				echo '<td>'. $apply['gender'] .'</td>';
				echo '<td>'. $apply['university'] .'</td>';
				echo '<td>'. $apply['grade'] .'</td>';
				echo '<td>'. $apply['objective'] .'</td>';
				echo '<td>';
				echo Html::anchor(Uri::base().'clinic/mypage/apply_detail/'.$apply['id'], '詳細', array('class' => 'btn btn-primary btn-sm'));
				echo '</td>';
				echo '</tr>';
			}
			?>
		</tbody>
	</table>
</div>