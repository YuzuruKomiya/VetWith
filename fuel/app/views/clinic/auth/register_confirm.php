<p>以下の内容でよろしければ、登録ボタンを押してください。</p>

<table class="table table-striped table-hover">
    <tbody>
      <tr>
        <th>ユーザーネーム</th>
        <td colspan="2"><?php echo $input['c_username']; ?></td>
      </tr>
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
		<th>代表者氏名（読み仮名）</th>
		<td><?php echo $input['l_name_kana']; ?></td>
		<td><?php echo $input['f_name_kana']; ?></td>
      </tr>
	  <tr>
        <th>代表者メールアドレス</th>
        <td colspan="2"><?php echo $input['c_email']; ?></td>
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
		<th>パスワード</th>
		<td colspan="2"><?php echo $input['c_password']; ?></td>
      </tr>
    </tbody>
  </table>
<?php
echo Form::open('clinic/auth/register/'.$input['preuser_id'].'/');

echo Form::hidden('c_username',		$input['c_username']);
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
echo Form::hidden('c_password',		$input['c_password']);
?>
<div class="actions">
	<?php echo Form::submit('submit1', '修正', array('class' => 'btn')); ?>
</div>
<?php
echo Form::close();


echo Form::open('clinic/auth/register_completion');

echo Form::csrf();
echo Form::hidden('preuser_id',		$input['preuser_id'],	array('id' => 'preuser_id'));
echo Form::hidden('c_username',		$input['c_username'],	array('id' => 'c_username'));
echo Form::hidden('c_name',		$input['c_name'],   	array('id' => 'c_name'));
echo Form::hidden('c_email',		$input['c_email'],		array('id' => 'c_email'));
echo Form::hidden('l_name',			$input['l_name'],		array('id' => 'l_name'));
echo Form::hidden('f_name',			$input['f_name'],		array('id' => 'f_name'));
echo Form::hidden('l_name_kana',	$input['l_name_kana'],	array('id' => 'l_name_kana'));
echo Form::hidden('f_name_kana',	$input['f_name_kana'],	array('id' => 'f_name_kana'));
echo Form::hidden('zip1',			$input['zip1'],			array('id' => 'zip1'));
echo Form::hidden('zip2',			$input['zip2'],			array('id' => 'zip2'));
echo Form::hidden('prefecture',		$input['prefecture'],	array('id' => 'prefecture'));
echo Form::hidden('address',		$input['address'],		array('id' => 'address'));
echo Form::hidden('phone_number',	$input['phone_number'],	array('id' => 'phone_number'));
echo Form::hidden('c_password',		$input['c_password'],	array('id' => 'c_password'));
?>
<div class="actions">
	<?php echo Form::submit('submit2', '登録', array('class' => 'btn btn-primary')); ?>
</div>
<?php
echo Form::close();
?>