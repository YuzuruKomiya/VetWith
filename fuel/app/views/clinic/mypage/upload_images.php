<?php echo Asset::js('jquery.uploadThumbs.js'); ?>
<script>
$(function() {
    // jQuery Upload Thumbs 
    $('form input:file').uploadThumbs({
        position : 1,      // 0:before, 1:after, 2:parent.prepend, 3:parent.append,
                           // any: arbitrarily jquery selector
        imgbreak : false   // append <br> after thumbnail images
    });
});
</script>
<?php if (isset($register_error)): ?>
<div class="alert alert-danger" role="alert">
	<?php echo $register_error; ?>
</div>
<?php endif; ?>
<div class="row">
	<div class="col-md-12 offerregister">
		<div class="alert alert-warning" role="alert">
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			求人ページに掲載する、動物病院の概観の写真と代表者の顔写真をアップロードします。
		</div>
		<div class="boxpaddingsmall">
			<ul>
				<li>
					「.jpg」「.jpeg」「.gif」「.png」の４種類の拡張子の画像が利用できます。
				</li>
				<li>
					アップロードできる画像のサイズは１つにつき２MBまでです。
				</li>
				<li>
					<?php echo Html::anchor('http://www.photo-kako.com/format.cgi', '写真加工.com', array('target' => '_blank')); ?>（外部サイト）にて画像の拡張子や色彩などを調節することができます。
				</li>
				<li>
					<span style="color: #f00">画像を登録すると、以前登録していた画像は自動的に削除されます。</span>
				</li>
			</ul>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-5 boxpaddingsmall text-center">
					<p>・現在登録している動物病院の概観の写真</p>
					<?php echo Form::open(array('action'	=> 'clinic/mypage/delete_images/', 'method'	=> 'post',)); ?>
					<?php echo Form::input('image_name', 'c_image', array('type' => 'hidden',)); ?>
					<p>
						<?php echo Form::submit('submit', '画像を削除する', array('class' => 'btn btn-warning')); ?>
					</p>
					<?php echo Form::close(); ?>
					<?php echo Asset::img($c_image, array('class' => 'sampleimage'));?>
				</div>
				<div class="col-xs-12 col-md-5 boxpaddingsmall text-center">
					<p>・現在登録している動物病院代表者の写真</p>
					<?php echo Form::open(array('action' => 'clinic/mypage/delete_images/', 'method' => 'post',)); ?>
					<?php echo Form::input('image_name', 'r_image', array('type' => 'hidden',)); ?>
					<p>
						<?php echo Form::submit('submit', '画像を削除する', array('class' => 'btn btn-warning')); ?>
					</p>
					<?php echo Form::close(); ?>
					<?php echo Asset::img($r_image, array('class' => 'sampleimage'));?>
				</div>
				<div class="col-xs-12 col-md-8 boxpaddingsmall form-group">
					<?php echo Form::open(array(
						'action'	=> 'clinic/mypage/upload_images_completion',
						'method'	=> 'post',
						'enctype'	=> 'multipart/form-data',
						)); ?>
					<p class="boxpaddingsmall">
						<?php echo Form::label('・動物病院の概観の写真', 'c_image'); ?>
						<?php echo Form::input('c_image', '', array(
							'type'		=> 'file',
							'accept'	=> 'image/*',
							'class'		=> 'form-control',
						)); ?>
					</p>
					<p class="boxpaddingsmall">
						<?php echo Form::label('・動物病院代表者の写真', 'r_image'); ?>
						<?php echo Form::input('r_image', '', array(
							'type'		=> 'file',
							'accept'	=> 'image/*',
							'class'		=> 'form-control',
						)); ?>
					</p>
					<div class="boxpaddingsmall text-center">
						<?php echo Form::submit('submit', '画像を登録する', array('class' => 'btn btn-primary btn-lg')); ?>	
					</div>
					<?php echo Form::close(); ?>
				</div>
			</div>
		</div>
			
	</div>
</div>