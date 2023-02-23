<?php


$url = 'http://137.135.245.31:3000/api/v1/informations/1';
$data = file_get_contents($url);

// Convertir les données JSON en tableau PHP
$data_array = json_decode($data, true);

 ?>



<!DOCTYPE html>
<html>
<head>
	<title>Exemple de graphique avec Chart.js</title>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
	<canvas id="myChart"></canvas>

	<script>
		// Récupération des données depuis le tableau PHP
		<?php
		$dates = array();
		$temp = array();
		$hum = array();
		foreach ($data_array['data'] as $row) {
			array_push($dates, $row['date_information']);
			array_push($temp, $row['informations_type_température']);
			array_push($hum, $row['informations_type_humidité']);
		}
		?>

		// Création du graphique
		var ctx = document.getElementById('myChart').getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: <?php echo json_encode($dates); ?>,
				datasets: [{
					label: 'Humidité',
					data: <?php echo json_encode($temp); ?>,
					fill: false,
					borderColor: 'rgb(0, 27, 255)',
					lineTension: 0.1
				}, {
					label: 'Température',
					data: <?php echo json_encode($hum); ?>,
					fill: false,
					borderColor: 'rgb(255, 0, 0)',
					lineTension: 0.1
				}]
				
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero: true
						}
					}]
				}
			}
		});
	</script>
</body>
</html>