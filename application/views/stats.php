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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data_platforms = google.visualization.arrayToDataTable([
                ['Platform', 'Hits'],
            <?php foreach($by_platform as $item):?>
                ['<?php echo $item->platform;?>',<?php echo $item->cnt;?>],
            <?php endforeach?>
            ]);

            var options = {
            title: 'Stats by platform'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_platform'));

            chart.draw(data_platforms, options);

            var data_browsers = google.visualization.arrayToDataTable([
                ['Browser', 'Hits'],
            <?php foreach($by_browser as $item):?>
                ['<?php echo $item->browser;?>',<?php echo $item->cnt;?>],
            <?php endforeach?>
            ]);

            var options = {
            title: 'Stats by browser'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_browser'));

            chart.draw(data_browsers, options);
        }
    </script>
</head>
<body>

<div id="container">
	<h1>Statistics</h1>

	<div id="body">
		<p>Общее количество: <?php echo $total_hits;?></p>
        <p><h3>По платформам:</h3>
        <div id="piechart_platform" style="width: 900px; height: 500px;"></div>
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Платформа</th>
                    <th>Хиты</th>
                </tr>Платформа
            </thead>
        <?php foreach($by_platform as $item):?>
            <tr>
                <td><?php echo $item->platform;?></td>
                <td><?php echo $item->cnt;?></td>
            </tr>
        <?php endforeach?>
        </table></p>

        <p><h3>По браузерам:</h3>
        <div id="piechart_browser" style="width: 900px; height: 500px;"></div>
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Браузер</th>
                    <th>Хиты</th>
                </tr>
            </thead>
        <?php foreach($by_browser as $item):?>
            <tr>
                <td><?php echo $item->browser;?></td>
                <td><?php echo $item->cnt;?></td>
            </tr>
        <?php endforeach?>
        </table></p>
	</div>
	<script>

	</script>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>