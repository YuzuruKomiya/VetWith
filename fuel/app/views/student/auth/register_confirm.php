<p>以下の内容でよろしければ、登録ボタンを押してください。</p>

<table class="table table-striped table-hover">
    <tbody>
      <tr>
        <th>ユーザーネーム</th>
        <td colspan="2"><?php echo $input['s_username']; ?></td>
      </tr>
      <tr>
		<th>名前</th>
		<td><?php echo $input['l_name']; ?></td>
		<td><?php echo $input['f_name']; ?></td>
      </tr>
	  <tr>
		<th>読み仮名</th>
		<td><?php echo $input['l_name_kana']; ?></td>
		<td><?php echo $input['f_name_kana']; ?></td>
      </tr>
	  <tr>
        <th>メールアドレス</th>
        <td colspan="2"><?php echo $input['s_email']; ?></td>
      </tr>
	  <tr>
		<th>生年月日</th>
		<td colspan="2"><?php
			echo $input['b_year'].'年';
			echo $input['b_month'].'月';
			echo $input['b_day'].'日';
		?></td>
      </tr>
	  <tr>
		<th>性別</th>
		<td colspan="2"><?php echo $input['gender']; ?></td>
      </tr>
	  <tr>
		<th>大学</th>
		<td colspan="2"><?php echo $input['university']; ?></td>
      </tr>
	  <tr>
		<th>学年</th>
		<td colspan="2"><?php echo $input['grade']; ?></td>
      </tr>
	  <tr>
		<th>住居の郵便番号</th>
		<td colspan="2"><?php
			echo $input['zip1'].'-'.$input['zip2'];
		?></td>
      </tr>
	  <tr>
		<th>住居の住所</th>
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
		<td colspan="2"><?php echo $input['s_password']; ?></td>
      </tr>
    </tbody>
  </table>
<?php
echo Form::open('student/auth/register/'.$input['preuser_id'].'/');

echo Form::hidden('s_username',		$input['s_username']);
echo Form::hidden('l_name',			$input['l_name']);
echo Form::hidden('f_name',			$input['f_name']);
echo Form::hidden('l_name_kana',	$input['l_name_kana']);
echo Form::hidden('f_name_kana',	$input['f_name_kana']);
echo Form::hidden('birthday',		$input['birthday']);
echo Form::hidden('gender',			$input['gender']);
echo Form::hidden('university',		$input['university']);
echo Form::hidden('grade',			$input['grade']);
echo Form::hidden('zip1',			$input['zip1']);
echo Form::hidden('zip2',			$input['zip2']);
echo Form::hidden('prefecture',		$input['prefecture']);
echo Form::hidden('address',		$input['address']);
echo Form::hidden('phone_number',	$input['phone_number']);
echo Form::hidden('s_password',		$input['s_password']);
?>
<div class="actions">
	<?php echo Form::submit('submit1', '修正', array('class' => 'btn btn-lg')); ?>
</div>
<?php
echo Form::close();


echo Form::open('student/auth/register_completion');

echo Form::csrf();
echo Form::hidden('preuser_id',		$input['preuser_id'],	array('id' => 'preuser_id'));
echo Form::hidden('s_username',		$input['s_username'],	array('id' => 's_username'));
echo Form::hidden('s_email',		$input['s_email'],		array('id' => 's_email'));
echo Form::hidden('l_name',			$input['l_name'],		array('id' => 'l_name'));
echo Form::hidden('f_name',			$input['f_name'],		array('id' => 'f_name'));
echo Form::hidden('l_name_kana',	$input['l_name_kana'],	array('id' => 'l_name_kana'));
echo Form::hidden('f_name_kana',	$input['f_name_kana'],	array('id' => 'f_name_kana'));
echo Form::hidden('birthday',		$input['birthday'],		array('id' => 'birthday'));
echo Form::hidden('gender',			$input['gender'],		array('id' => 'gender'));
echo Form::hidden('university',		$input['university'],	array('id' => 'university'));
echo Form::hidden('grade',			$input['grade'],		array('id' => 'grade'));
echo Form::hidden('zip1',			$input['zip1'],			array('id' => 'zip1'));
echo Form::hidden('zip2',			$input['zip2'],			array('id' => 'zip2'));
echo Form::hidden('prefecture',		$input['prefecture'],	array('id' => 'prefecture'));
echo Form::hidden('address',		$input['address'],		array('id' => 'address'));
echo Form::hidden('phone_number',	$input['phone_number'],	array('id' => 'phone_number'));
echo Form::hidden('s_password',		$input['s_password'],	array('id' => 's_password'));
?>
<div class="actions">
	<?php echo Form::submit('submit2', '登録', array('class' => 'btn btn-primary btn-lg')); ?>
</div>
<?php
echo Form::close();
?>