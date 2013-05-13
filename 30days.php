<!-- Created using code from: https://github.com/hamlesh/GraphMailbox //-->
<?
	$iam = "30days"; //set page name - needs to be unique for each
	$month = date('m');
	include('conf/db.php');
		// get some data
		$sql = "SELECT * FROM inbox
		WHERE LogMonth = '$month'
		GROUP BY LogDate
		ORDER BY logdate desc
		LIMIT 30";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$num_rows = mysql_num_rows($result);
	$lastitemcount = $row['LogCount'];
?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<script type="text/javascript">
google.load('visualization', '1.0', {'packages':['corechart']});
google.setOnLoadCallback(drawChart);

	function drawChart() {
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Date');
		data.addColumn('number', 'Items');
		data.addRows([
			<?
			$graphdata = "";
			do {
			$graphdata = $graphdata."['".$row['LogDate']." ".date("F", mktime(0, 0, 0, $row['LogMonth'], 10))."', ".$row['LogCount']."],";
			} while ( $row = mysql_fetch_array($result) );
			echo substr_replace($graphdata,"",-1);
			?>
		]);

	// Set some chart options
	var options = {
						title:'Month of <?=date(F)." ".date(Y)?> (<?=$lastitemcount?>)',
						vAxis: {title: 'Number of Emails', viewWindow:{min:0}},
						legend: {position: 'none'}
								};

	//uncomment based on the type of chart you want
	//var chart = new google.visualization.ColumnChart(document.getElementById('chart_<?=$iam?>')); // bar graph
	//var chart = new google.visualization.LineChart(document.getElementById('chart_<?=$iam?>')); // line graph
	var chart = new google.visualization.AreaChart(document.getElementById('chart_<?=$iam?>')); // area graph

	chart.draw(data, options);
	}
</script>
<div id="chart_<?=$iam?>" style="width: 100%; height:100%;"></div>