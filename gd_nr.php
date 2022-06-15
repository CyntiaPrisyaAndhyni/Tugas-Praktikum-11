<?php
include('koneksi.php');
$country = mysqli_query ($koneksi, "select * from datacovid");
while ($row = mysqli_fetch_array($country)){
    $negara[] = $row['country'];

    $query = mysqli_query($koneksi,"select sum(new_recovered) as new_recovered from datacovid where id='".$row['id']."'");
    $row = $query->fetch_array();
    $new_recovered[] = $row['new_recovered'];
}
?>
<!doctype html>
<html>

<head>
    <title>New Recovered</title>
    <script type="text/javascript" src="Chart.js"></script>
</head>

<body>
<a href="menu1.html">kembali</a>
    <div id="canvas-holder" style="width:80%">
        <canvas id="chart-area"></canvas>
    </div>
    <script>
        var config = {
            type:'doughnut',
            data: {
                datasets:[{
                    data:<?php echo json_encode($new_recovered);
?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(219, 112, 147, 0.2)',
                    'rgba(218, 112, 214, 0.2)',
                    'rgba(0, 250, 154, 0.2)',
                    'rgba(123, 104, 238, 0.2)',
                    'rgba(72, 209, 204, 0.2)',
                    'rgba(199, 21, 133, 0.2)'
                ],
                borderColor: [
					'rgba(255,99,132,1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
                    'rgba(219, 112, 147, 1)',
                    'rgba(218, 112, 214, 1)',
                    'rgba(0, 250, 154, 1)',
                    'rgba(123, 104, 238, 1)',
                    'rgba(72, 209, 204, 1)',
                    'rgba(199, 21, 133, 1)'
					],
					label: 'Presentase Data New Recovered'
				}],
				labels: <?php echo json_encode($negara); ?>},
			options: {
				responsive: true
			}
		};
 
		window.onload = function() {
			var ctx = document.getElementById('chart-area').getContext('2d');
			window.myPie = new Chart(ctx, config);
		};
 
		document.getElementById('randomizeData').addEventListener('click', function() {
			config.data.datasets.forEach(function(dataset) {
				dataset.data = dataset.data.map(function() {
					return randomScalingFactor();
				});
			});
 
			window.myPie.update();
		});
 
		var colorNames = Object.keys(window.chartColors);
		document.getElementById('addDataset').addEventListener('click', function() {
			var newDataset = {
				backgroundColor: [],
				data: [],
				label: 'New dataset ' + config.data.datasets.length,
			};
 
			for (var index = 0; index < config.data.labels.length; ++index) {
				newDataset.data.push(randomScalingFactor());
 
				var colorName = colorNames[index % colorNames.length];
				var newColor = window.chartColors[colorName];
				newDataset.backgroundColor.push(newColor);
			}
 
			config.data.datasets.push(newDataset);
			window.myPie.update();
		});
 
		document.getElementById('removeDataset').addEventListener('click', function() {
			config.data.datasets.splice(0, 1);
			window.myPie.update();
		});
	</script>
</body>
 
</html>