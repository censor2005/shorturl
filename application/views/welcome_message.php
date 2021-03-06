<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<link href="/assets/css/bootstrap.min.css" rel="stylesheet">
	<script src="/assets/js/jquery-3.3.1.min.js"></script>
	<script src="/assets/js/bootstrap.min.js"></script>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Укорачиватель ссылок (У-ь)</h1>

	<div id="body">
		<div class="form-group">
			<label>Введите URL для укорачивания:</label>
			<input type="text" class="form-control" id="url" placeholder="http://">
		</div>
		<div class="form-group">
			<label for="">Срок жизни ссылки:</label>
			<select name="expire" id="expire" class="custom-select">
				<option value="0">Без срока</option>
				<option value="year">1 год</option>
				<option value="month">1 месяц</option>
				<option value="day">1 день</option>
				<option value="hour">1 час</option>
			</select>
		</div>
		<button class="btn btn-primary" id="generate">Генерировать</button>
		<div class="alert alert-success" id="result" style="display:none;">Ваша короткая ссылка: <input type="text"><br>Статистика по ссылке: <span></span></div>
		<div class="alert alert-danger" id="result_error" style="display:none;">Ошибка при генерации ссылки</div>
	</div>
	<script>
	$(function(){
		$("#generate").on('click', function(){
			var $url = encodeURIComponent($("#url").val());
			var $expire = $("#expire").val();
			$.post('process', {url:$url, expire:$expire}, function(data){
				//alert(data);
				console.log(data);
				if(data.status != 0){
					$("#result input").val("Ошибка при генерации");
					$("#result_error").show();
					$("#result").hide();
				} else {
					$("#result input").val( "<?php echo base_url();?>s/" + data.short);
					$("#result span").html("<a href='<?php echo base_url();?>stat/show/"+data.id+"'><?php echo base_url();?>stat/show/"+data.id+"</a>");
					$("#result_error").hide();
					$("#result").show();
				}
				
			}, "json");
		});
	});
	</script>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>