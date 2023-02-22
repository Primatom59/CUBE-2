<?php

$url = 'http://137.135.245.31:3000/api/v1/informations/1';
$data = file_get_contents($url);

// Convertir les données JSON en tableau PHP
$data_array = json_decode($data, true);

// Afficher les données

?>



<div class="col-12 ">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Area Chart</h5>
									<h6 class="card-subtitle text-muted">Area charts are used to represent quantitative variations.</h6>
								</div>
								<div class="card-body">
									<div class="chart w-100">
										<div id="apexcharts-area"></div>
									</div>
								</div>
							</div>
						</div>


						<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Area chart
			var options = {
				<?php foreach ($data_array['data'] as $row) : ?>
					chart: {
					height: 350,
					type: "area",
				},
				dataLabels: {
					enabled: false
				},
				stroke: {
					curve: "smooth"
				},
				series: [{
					name: "series1",
					data: [<?= $row['informations_type_humidité'] ?>]
				}, {
					name: "series2",
					data: [<?= $row['informations_type_température'] ?>]
				}],
				xaxis: {
					type: "datetime",
					categories: <?=  $row['date_information'] ?>
					,
				},
				tooltip: {
					x: {
						format: "dd/MM/yy HH:mm"
					},
				}
				<?php endforeach ?>
			}
			var chart = new ApexCharts(
				document.querySelector("#apexcharts-area"),
				options
			);
			chart.render();
		});
	</script>
