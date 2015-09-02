<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning" role="alert">
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			ご質問、ご要望などはこちらからどうぞ。
		</div>
		<div class="boxpaddingsmall">
			<ul>
				<li>
					対応までに２～３日程度のお時間をいただく場合がございます。
				</li>
				<li>
					「*」印のついた項目は必須項目です。
				</li>
			</ul>
		</div>
	</div>
	<div class="col-xs-12 col-md-8 col-md-offset-1 boxpaddingsmall">
		<?php if (isset($contact_error)): ?>
		<div class="alert alert-danger">
			<?php echo $contact_error; ?>
		</div>
		<?php endif; ?>
		<?php echo $contact_form; ?>
	</div>
</div>