<div class="alert alert-info" role="alert">
	以下の内容は動物病院情報として公開されます。よろしければ「情報を登録する」ボタンを押してください。
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
<table class="table table-striped table-hover">
    <tbody>
	  <tr>
        <th>病院名</th>
        <td colspan="2"><?php echo $input['c_name']; ?></td>
      </tr>
      <tr>
		<th>代表者氏名</th>
		<td><?php echo $input['l_name']; ?></td>
		<td><?php echo $input['f_name']; ?></td>
      </tr>
	  <tr>
		<th>代表者氏名（カナ）</th>
		<td><?php echo $input['l_name_kana']; ?></td>
		<td><?php echo $input['f_name_kana']; ?></td>
      </tr>
	  <tr>
		<th>病院の郵便番号</th>
		<td colspan="2"><?php
			echo $input['zip1'].'-'.$input['zip2'];
		?></td>
      </tr>
	  <tr>
		<th>病院住所</th>
		<td colspan="2"><?php
			echo $input['prefecture_jp'];
			echo $input['address'];
		?></td>
      </tr>
	  <tr>
		<th>電話番号</th>
		<td colspan="2"><?php echo $input['phone_number']; ?></td>
      </tr>
	  <tr>
		<th>診療時間</th>
		<td colspan="2"><?php echo $input['start_time'].' ～ '.$input['end_time']; ?></td>
      </tr>
	  <tr>
		<th>休診日</th>
		<td colspan="2"><?php echo $input['closed_day']; ?></td>
      </tr>
	  <tr>
		<th>診療領域</th>
		<td colspan="2"><?php echo $input['therapy_realm']; ?></td>
      </tr>
	  <tr>
		<th>主な医療機器</th>
		<td colspan="2"><?php echo $input['apparatus']; ?></td>
      </tr>
	  <tr>
		<th>獣医師の人数</th>
		<td colspan="2"><?php echo $input['doctor_number'].'人'; ?></td>
      </tr>
	  <tr>
		<th>看護師の人数</th>
		<td colspan="2"><?php echo $input['nurse_number'].'人'; ?></td>
      </tr>
	  <tr>
		<th>その他スタッフの人数</th>
		<td colspan="2"><?php echo $input['staff_number'].'人'; ?></td>
      </tr>
    </tbody>
  </table>
<?php
echo Form::open('clinic/mypage/set_detail');

echo Form::hidden('c_name',			$input['c_name']);
echo Form::hidden('l_name',			$input['l_name']);
echo Form::hidden('f_name',			$input['f_name']);
echo Form::hidden('l_name_kana',	$input['l_name_kana']);
echo Form::hidden('f_name_kana',	$input['f_name_kana']);
echo Form::hidden('zip1',			$input['zip1']);
echo Form::hidden('zip2',			$input['zip2']);
echo Form::hidden('prefecture',		$input['prefecture']);
echo Form::hidden('address',		$input['address']);
echo Form::hidden('phone_number',	$input['phone_number']);
echo Form::hidden('start_time',		$input['start_time']);
echo Form::hidden('end_time',		$input['end_time']);
echo Form::hidden('closed_day',		$input['closed_day']);
echo Form::hidden('therapy_realm',	$input['therapy_realm']);
echo Form::hidden('apparatus',		$input['apparatus']);
echo Form::hidden('doctor_number',	$input['doctor_number']);
echo Form::hidden('nurse_number',	$input['nurse_number']);
echo Form::hidden('staff_number',	$input['staff_number']);
?>
<div class="actions">
	<?php echo Form::submit('submit1', '修正', array('class' => 'btn')); ?>
</div>
<?php
echo Form::close();


echo Form::open('clinic/mypage/set_detail_completion');

echo Form::csrf();
echo Form::hidden('c_name',			$input['c_name'],			array('id' => 'c_name'));
echo Form::hidden('l_name',			$input['l_name'],			array('id' => 'l_name'));
echo Form::hidden('f_name',			$input['f_name'],			array('id' => 'f_name'));
echo Form::hidden('l_name_kana',	$input['l_name_kana'],		array('id' => 'l_name_kana'));
echo Form::hidden('f_name_kana',	$input['f_name_kana'],		array('id' => 'f_name_kana'));
echo Form::hidden('zip1',			$input['zip1'],				array('id' => 'zip1'));
echo Form::hidden('zip2',			$input['zip2'],				array('id' => 'zip2'));
echo Form::hidden('prefecture',		$input['prefecture'],		array('id' => 'prefecture'));
echo Form::hidden('address',		$input['address'],			array('id' => 'address'));
echo Form::hidden('phone_number',	$input['phone_number'],		array('id' => 'phone_number'));
echo Form::hidden('start_time',		$input['start_time'],		array('id' => 'start_time'));
echo Form::hidden('end_time',		$input['end_time'],			array('id' => 'end_time'));
echo Form::hidden('closed_day',		$input['closed_day'],		array('id' => 'closed_day'));
echo Form::hidden('therapy_realm',	$input['therapy_realm'],	array('id' => 'therapy_realm'));
echo Form::hidden('apparatus',		$input['apparatus'],		array('id' => 'apparatus'));
echo Form::hidden('doctor_number',	$input['doctor_number'],	array('id' => 'doctor_number'));
echo Form::hidden('nurse_number',	$input['nurse_number'],		array('id' => 'nurse_number'));
echo Form::hidden('staff_number',	$input['staff_number'],		array('id' => 'staff_number'));
?>
<div class="actions">
	<?php echo Form::submit('submit2', '情報登録を登録する', array('class' => 'btn btn-primary')); ?>
</div>
<?php
echo Form::close();
?>
		</div>
		<div class="col-md-2"></div>
	</div>
</div>