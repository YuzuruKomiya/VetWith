<div class="alert alert-warning" role="alert">
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			<?php echo $c_profile['c_name']; ?>の見学、面談、実習へ応募します。
</div>
<h2><?php echo Html::anchor(Uri::base().'offers/'.$c_profile['c_id'], $c_profile['c_name']); ?>への応募</h2>
<div class="boxpaddingsmall">
	<ul>
		<li>
			動物病院の担当者が直接「応募理由」を見ることに留意し、内容をご記入ください。
		</li>
		<li>
			動物病院には、ご登録された名前、性別、大学、学年、メールアドレス、電話番号の情報もあわせて伝えられます。
		</li>
		<li>
			動物病院からは、ご登録されたメールアドレスもしくは電話番号宛に折り返し連絡があります。
		</li>
	</ul>
</div>
<?php if (isset($apply_error)): ?>
<div class="alert alert-danger" role="alert">
	<?php echo $apply_error; ?>
</div>
<?php endif; ?>
<div class="container">
	<div class="row">
		<div class="col-xs-6 col-md-6">
			<?php echo $apply_form; ?>
		</div>
	</div>
</div>
