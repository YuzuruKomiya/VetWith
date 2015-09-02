<?php if (isset($register_error)): ?>
<div class="alert alert-danger" role="alert">
	<?php echo $register_error; ?>
</div>
<?php endif; ?>
<div class="row">
	<div class="col-md-12 offerregister">
		<div class="alert alert-warning" role="alert">
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			掲載する求人の内容を入力・編集することができます。
		</div>
		<div class="boxpaddingsmall">
			<ul>
				<li>
					VetWithにログインしている全ユーザーが、このフォームに入力した内容を閲覧することができます。入力内容にご注意ください。
				</li>
				<li>
					「*」印のついた項目は必須項目です。
				</li>
				
			</ul>
		</div>
		<div class="col-md-8 boxpaddingsmall">
			<?php echo $offer_form; ?>
		</div>
	</div>
</div>