<hr>
<div id="footer">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-md-12">
				<h2 id="sublogo">
					<?php echo Html::anchor(Uri::base(), 'VetWith'); ?>
				</h2>
				<p>
					<?php echo Form::open(array('action' => 'offers/search', 'method' => 'get', 'class' => 'form-inline')); ?>
					<?php echo Form::input('q', Input::get('q'), array('class' => 'form-control input-sm', 'placeholder' => '地名や設備など')); ?>
					<?php echo Form::submit('submit', '求人検索', array('class' => 'btn btn-primary btn-sm')); ?>
					<?php echo Form::close(); ?>
				</p>
				<ul class="list-inline" id="footerlist">
					<li>
						<?php echo Html::anchor(Uri::base().'terms', 'ご利用規約'); ?>
					</li>
					<li>
						<?php echo Html::anchor(Uri::base().'contact', 'お問い合わせ'); ?>
					</li>
					<li>
						<?php echo Html::anchor(Uri::base().'operation', '運営情報'); ?>
					</li>
				</ul>
				<p id="copyright">
					&copy; 2015 VetWith（ベットウィズ）
				</p>
				<div class="fb-like" data-href="http://vetwith.com/" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
				<p id="poweredby">
					Icon made by
					<a href="http://buditanrim.co" title="Budi Tanrim">Budi Tanrim</a>
					from
					<a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a><br />
					<a href="https://www.pakutaso.com" title="写真素材ぱくたそ">写真素材ぱくたそ</a>
				</p>
			</div>
		</div>
	</div>
</div>

