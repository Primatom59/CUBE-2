<!DOCTYPE html>
<html>
<head>
	<title>Exemple de graphique avec Chart.js</title>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<?php

$url = 'http://137.135.245.31:3000/api/v1/informations/1';
$data = file_get_contents($url);

// Convertir les données JSON en tableau PHP
$data_array = json_decode($data, true);

// Afficher les données

?>

<body>
	
<canvas id="myChart"></canvas>


					<div class="card flex-fill">
						<div class="card-header">
							<div class="card-actions float-end">
								<div class="dropdown position-relative">
									<a href="#" data-bs-toggle="dropdown" data-bs-display="static">
									<a href="#" data-bs-toggle="dropdown" data-bs-display="static">
</a>

									
								</div>
							</div>
							<h5 class="card-title mb-0">Relevés capteurs</h5>
						</div>
						<div class="card-body">
						<table id="datatables-reponsive" class="table table-striped my-0">
							<thead>
								<tr>
									<th>Nom capteurs</th>
									<th class="d-none d-xl-table-cell">Date du relevé</th>
									<th class="d-none d-xl-table-cell">Température</th>
									<th class="d-none d-xl-table-cell">Humidité</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($data_array['data'] as $row) :?>
									<tr>
										<td></td>
										<td><?= $row['date_information'] ?></td>
										<td><?= $row['informations_type_humidité'] ?></td>
										<td><?= $row['informations_type_température'] ?></td>
									</tr>
									<?php endforeach ?>
									
							</tbody>
						</table>
					</div>
					</div>
</body>
					<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Datatables Responsive
			$("#datatables-reponsive").DataTable({
				responsive: true
			});
		});
	</script>