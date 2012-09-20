<!-- Created using code from: https://github.com/hamlesh/GraphMailbox //-->
<?
	$iam = "30days"; //set page name - needs to be unique for each
	include('conf/db.php');
		// get some data
		$sql = "SELECT * FROM inbox
		WHERE LogMonth = '09'
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
			$graphdata = $graphdata."['".$row['LogYear']."-".$row['LogMonth']."-".$row['LogDate']."', ".$row['LogCount']."],";
			} while ( $row = mysql_fetch_array($result) );
			echo substr_replace($graphdata,"",-1);
			?>
		]);

	// Set some chart options
	var options = {
						title:'Last 30 days (<?=$lastitemcount?>)',
						hAxis: {title: 'Year-Month-Date'},
						vAxis: {title: 'Emails'},
						legend: {position: 'none'}
								};

	//uncomment based on the type of chart you want
	//var chart = new google.visualization.ColumnChart(document.getElementById('chart_<?=$iam?>')); // bar chart
	//var chart = new google.visualization.LineChart(document.getElementById('chart_<?=$iam?>')); // line chart
	var chart = new google.visualization.AreaChart(document.getElementById('chart_<?=$iam?>')); // area chart

	chart.draw(data, options);
	}
</script>
<div id="chart_<?=$iam?>" style="width: 100%; height:50%;"></div>