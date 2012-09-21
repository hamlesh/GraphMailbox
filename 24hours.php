<!-- Created using code from: https://github.com/hamlesh/GraphMailbox //-->
<?
	$iam = "24_hours"; //set page name - needs to be unique for each
	include('conf/db.php');
		// get some data
		$sql = "SELECT * FROM inbox 
		ORDER BY LTS desc 
		LIMIT 24"; 
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
			$graphdata = $graphdata."['".$row['LogDate']." / ".$row['LogHour']."', ".$row['LogCount']."],";
			} while ( $row = mysql_fetch_array($result) );
			echo substr_replace($graphdata,"",-1);
			?>
		]);

	// Set some chart options
	var options = {
						title:'Last 24 hours (<?=$lastitemcount?>)',
						hAxis: {title: 'Date / Hour'},
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
<div id="chart_<?=$iam?>" style="width: 100%; height:100%;"></div>