<script type="text/javascript">
$(function()
{
	var c_id = '<?php echo $c_id; ?>';
	var button	= $('.bookmark');

	$.ajax(
		{
			url:			'<?php echo Uri::base();?>'+'bookmark/precheck.json',
			type:			'POST',
			dataType:		'json',
			data: {c_id: c_id},
			success: function(data)
			{
				if (data.login_check == false)
				{
					$(button).attr('class', 'btn btn-default btn-lg bookmark');
					$(button).attr('condition', 'notbookmark');
					$(button).text("病院ブックマークに登録する");
				}
				else if(data.login_check == true && data.bookmark == true)
				{
					$(button).attr('class', 'btn btn-success btn-lg bookmark');
					$(button).attr('condition', 'bookmark');
					$(button).text("ブックマーク登録を解除する");
				}
				else if(data.login_check == true && data.bookmark == false)
				{
					$(button).attr('class', 'btn btn-default btn-lg bookmark');
					$(button).attr('condition', 'notbookmark');
					$(button).text("病院ブックマークに登録する");
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

$(function()
{	
	$('.bookmark').click(function()
	{
		var c_id = '<?php echo $c_id; ?>';
		var button	= this;
		$(button).prop('disabled', true);
		
		if($(this).attr('condition') == 'notbookmark')
		{
			$.ajax(
			{
				url:			'<?php echo Uri::base();?>'+'bookmark/add.json',
				type:			'POST',
				dataType:		'json',
				data: {c_id: c_id},
				success: function(data)
				{
					if (data.login_check == false)
					{
						$(button).attr('class', 'btn btn-warning btn-lg bookmark');
						$(button).attr('condition', 'notbookmark');
						$(button).text("ログインする必要があります");
						$(button).prop('disabled', true);
					}
					else if(data.login_check == true && data.register_check == true)
					{
						$(button).attr('class', 'btn btn-success btn-lg bookmark');
						$(button).attr('condition', 'bookmark');
						$(button).text("ブックマーク登録を解除する");
						$(button).prop('disabled', false);
					}else if(data.login_check == true && data.register_check == false)
					{
						$(button).attr('class', 'btn btn-warning btn-lg bookmark');
						$(button).data('condition','bookmark');
						$(button).text("ブックマークに登録済みです");
					}		
					return;
				},
				error: function()
				{
					alert('サーバーエラーです。');
					console.log("ブックマークに登録できませんでした。");
				}
			});
	
		}
		else if($(this).attr('condition') == 'bookmark')
		{
			$.ajax({
				url:			'<?php echo Uri::base();?>'+'bookmark/delete.json',
				type:			'POST',
				dataType:		'json',
				data: {c_id: c_id},
				success: function(data)
				{
					if (data.login_check == false)
					{
						$(button).attr('class', 'btn btn-warning btn-lg bookmark');
						$(button).attr('condition', 'notbookmark');
						$(button).text("ログインする必要があります");
						$(button).prop('disabled', true);
					}
					else if(data.login_check == true && data.register_check == false)
					{
						$(button).attr('class', 'btn btn-default btn-lg bookmark');
						$(button).attr('condition', 'notbookmark');
						$(button).text("病院ブックマークに登録する");
						$(button).prop('disabled', false);
					}	
					return;
				},
				error: function()
				{
					alert('サーバーエラーです。');
					console.log("ブックマーク登録を解除できませんでした。");
				}
			})
		}
	});
});
</script>
<div class="jumbotron offerheader">
    <div class="container offerheadercontents">
		<h1><?php echo $c_name; ?></h1>
		<?php echo $catchcopy; ?>
		<address>
			<?php echo $zip3.'-'.$zip4; ?><br />
			<?php echo $prefecture.$address; ?><br />
			<abbr title="電話番号">TEL:</abbr> <?php echo $phone_number; ?>
		</address>
    </div>
</div>

<div class="row">
	<nav class="sidebar col-xs-6 col-md-4 " id="affix-nav">
		<ul class="nav side-nav" data-spy="affix" data-offset-top="400">
			<li><h3><?php echo $c_name; ?></h3></li>
			<li><a href="#message">代表者のメッセージ</a></li>
			<li><a href="#access">基本情報</a></li>
			<li><a href="#employ">採用情報</a></li>
		</ul>
	</nav>
	<div class="col-xs-12 col-md-8 offermaincontents">
		<?php echo Asset::img($c_image, array('id' => 'featureimage')); ?>
		<div class="row">
			<div class="col-xs-12 offersubcontents">
				<div class="alert alert-info">
					<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					<?php echo $c_name.'の求人は現在、「'.$reception.'」です。'; ?> 
				</div>
				<p class="text-center">
					<button type="button" class="btn btn-default btn-lg bookmark" condition="notbookmark">　　　　　　　　</button>
					<?php echo Html::anchor(Uri::base().'offers/apply/'.$c_id, '病院の実習・面談に応募する', array('class' => 'btn btn-primary btn-lg')); ?>
				</p>
				<div class="page-header">
					<h3 class="topic" id="message">
						<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
						代表者のメッセージ
					</h3>
				</div>
				<p>
					<?php echo Asset::img($r_image, array('id' => 'representativeimage')); ?>
				</p>
				<div class="fukidashiwrapper">
					<div class="fukidashi">
						<?php echo $message; ?>
					</div>
				</div>
				<div class="page-header">
					<h3 class="topic" id="access">
						<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
						基本情報
					</h3>
				</div>
				<h4>
					<span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
					アクセス
				</h4>
				<div class="offersubcontents">
					<p>
						<?php echo $zip3.'-'.$zip4; ?><br />
						<?php echo $prefecture.$address; ?>
					</p>	
				</div>
				<h4>
					<span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
					代表者名
				</h4>
				<div class="offersubcontents">
					<p>
						<?php echo $l_name.'　'.$f_name; ?>
					</p>	
				</div>
				<h4>
					<span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
					診療スケジュール
				</h4>
				<div class="offersubcontents">
					<p>
						<?php echo $start_time.'～'.$end_time; ?><br />
						休診日：<?php echo $closed_day; ?>
					</p>	
				</div>
				<h4>
					<span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
					診療領域
				</h4>
				<div class="offersubcontents">
					<p>
						<?php echo $closed_day; ?>
					</p>	
				</div>
				<h4>
					<span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
					主な医療機器
				</h4>
				<div class="offersubcontents">
					<p>
						<?php echo $apparatus; ?>
					</p>	
				</div>
				<h4>
					<span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
					従業員の構成人数
				</h4>
				<div class="offersubcontents">
					<p>
					獣医師：<?php echo $doctor_number; ?>人<br />
					看護師：<?php echo $nurse_number; ?>人<br />
					スタッフ：<?php echo $staff_number; ?>人
					</p>	
				</div>
				<div class="page-header">
					<h3 class="topic" id="employ">
						<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
						採用情報
					</h3>
				</div>
				<?php echo $employ_part; ?>
				
			</div>
		</div>
	</div>
</div>