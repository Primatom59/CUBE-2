<!-- Inclure jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Inclure le JavaScript de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<?php


$url = 'http://137.135.245.31:3000/api/v1/informations/1';
$data = file_get_contents($url);

// Convertir les données JSON en tableau PHP
$data_array = json_decode($data, true);
$dates = array();
$temp = array();
$hum = array();
?>

<main class="content">
                <div class="container-fluid p-0">

                    <div class="row mb-2 mb-xl-3">
                        <div class="col-auto d-none d-sm-block">
                            <h3>Dashboard</h3>
                        </div>

                        <div class="col-auto ms-auto text-end mt-n1">

                        <div class="dropdown me-2 d-inline-block">
  <button class="btn btn-light bg-white shadow-sm dropdown-toggle time-dropdown" type="button" id="time-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="align-middle mt-n1" data-feather="calendar"></i><span id="selected-time"> Aujourd'hui</span>
  </button>
  <ul class="dropdown-menu" aria-labelledby="time-dropdown">
    <li><a class="dropdown-item" href="#" data-value="today">Aujourd'hui</a></li>
    <li><a class="dropdown-item" href="#" data-value="all-time">All</a></li>
  </ul>
</div>

                            <button class="btn btn-primary shadow-sm" onclick="location.reload()">
      <i class="align-middle" data-feather="refresh-cw">&nbsp;</i>
    </button>
                        </div>
                    </div>
                    <?php
		                    foreach ($data_array['data'] as $row) {
			                    array_push($dates, $row['date_information']);
			                    array_push($temp, $row['informations_type_température']);
			                    array_push($hum, $row['informations_type_humidité']);
		                    }
                            $last_hum = 0;
                            $last_temp = 0;
                            $last_temp = end($temp);
		                    $last_hum = end($hum);
		                    ?>
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="card illustration flex-fill">
                                <div class="card-body p-0 d-flex flex-fill">
                                    <div class="row g-0 w-100">
                                        <div class="col-6">
                                            <div class="illustration-text p-3 m-1">
                                                <h4 class="illustration-text">Méteo du jour</h4>
                                                <p class="mb-0">Aujourd'hui : </p>
                                            </div>
                                        </div>
                                        <div class="col-6 align-self-end text-end">
                                        <?php if($last_hum <=20): ?>
                                            <i class="align-middle text-danger" data-feather="sun" style="width: 106px; height: 160px; margin-right: 40px"></i>
                                            
                                            <?php elseif($last_hum >20 and $last_hum <80): ?>
                                                 <i class="align-middle text-danger" data-feather="cloud" style="width: 106px; height: 160px;margin-right: 40px"></i>
                                            
                                            <?php else : ?>
                                                <i class="align-middle text-danger" data-feather="cloud-rain" style="width: 106px; height: 160px; margin-right: 40px"></i>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card flex-fill">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <h3 class="mb-2"><?= "$last_hum" . "%" ?></h3>
                                            <p class="mb-2">Humidité</p>
                                            <div class="mb-0">
                                                <span class="text-muted">depuis la dernière lecture</span>
                                            </div>
                                        </div>
                                        <div class="d-inline-block ms-3">
                                            <div class="stat">
                                                <i class="align-middle text-success" data-feather="droplet"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="card flex-fill">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <h3 class="mb-2"><?= "$last_temp" . "°C" ?></h3>
                                            <p class="mb-2">Température</p>
                                            <div class="mb-0">
                                                <span class="text-muted">depuis la dernière lecture</span>
                                            </div>
                                        </div>
                                        <div class="d-inline-block ms-3">
                                            <div class="stat">
                                                <i class="align-middle text-danger" data-feather="thermometer"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <?php require 'table/gpt.php' ;?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 ">
                            <?php require 'table/FirstTable.php' ;?>
                        </div>
                    </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Support</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Help Center</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Privacy</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Terms of Service</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-6 text-end">
                            <p class="mb-0">
                                &copy; 2022 - <a href="index.html" class="text-muted">AppStack</a>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="js/app.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Bar chart
            new Chart(document.getElementById("chartjs-dashboard-bar"), {
                type: "bar",
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                        label: "Last year",
                        backgroundColor: window.theme.primary,
                        borderColor: window.theme.primary,
                        hoverBackgroundColor: window.theme.primary,
                        hoverBorderColor: window.theme.primary,
                        data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
                        barPercentage: .325,
                        categoryPercentage: .5
                    }, {
                        label: "This year",
                        backgroundColor: window.theme["primary-light"],
                        borderColor: window.theme["primary-light"],
                        hoverBackgroundColor: window.theme["primary-light"],
                        hoverBorderColor: window.theme["primary-light"],
                        data: [69, 66, 24, 48, 52, 51, 44, 53, 62, 79, 51, 68],
                        barPercentage: .325,
                        categoryPercentage: .5
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    cornerRadius: 15,
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                stepSize: 20
                            },
                            stacked: true,
                        }],
                        xAxes: [{
                            gridLines: {
                                color: "transparent"
                            },
                            stacked: true,
                        }]
                    }
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $("#datetimepicker-dashboard").datetimepicker({
                inline: true,
                sideBySide: false,
                format: "L"
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Pie chart
            new Chart(document.getElementById("chartjs-dashboard-pie"), {
                type: "pie",
                data: {
                    labels: ["Direct", "Affiliate", "E-mail", "Other"],
                    datasets: [{
                        data: [2602, 1253, 541, 1465],
                        backgroundColor: [
                            window.theme.primary,
                            window.theme.warning,
                            window.theme.danger,
                            "#E8EAED"
                        ],
                        borderWidth: 5,
                        borderColor: window.theme.white
                    }]
                },
                options: {
                    responsive: !window.MSInputMethodContext,
                    maintainAspectRatio: false,
                    cutoutPercentage: 70,
                    legend: {
                        display: false
                    }
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $("#datatables-dashboard-projects").DataTable({
                pageLength: 6,
                lengthChange: false,
                bFilter: false,
                autoWidth: false
            });
        });
    </script>
    <script>
  const timeDropdownButton = document.getElementById('time-dropdown');
  const selectedTimeSpan = document.getElementById('selected-time');

  document.querySelectorAll('#time-dropdown + .dropdown-menu a').forEach(item => {
    item.addEventListener('click', event => {
      event.preventDefault();

      const selectedTime = event.target.dataset.value;

      if (selectedTime === 'all-time') {
        selectedTimeSpan.textContent = ' All';
      } else {
        selectedTimeSpan.textContent = ' Aujourd\'hui';
      }
    });
  });
</script>

<script>$(document).readyfunction() 
	// Écouter les événements de clic sur les éléments de menu déroulant
	$('.time-dropdown a').click(function(e) {
		e.preventDefault();

		// Récupérer la valeur de l'option de temps sélectionnée
		var value = $(this).data('value');

		// Mettre à jour l'affichage pour montrer quelle option est sélectionnée
		$('#selected-time').text($(this).text());

		// Mettre à jour le graphique en fonction de l'option de temps sélectionnée
		updateChart(value);
	});

	// Fonction pour mettre à jour le graphique en fonction de l'option de temps sélectionnée
	function updateChart(time) 
		var dates = [];
		var temp = [];
		var hum = [];

		// Récupérer les données du graphique
		$('.chart-data').eachfunction() 
			var date = $(this).data('date');
			var tempVal = $(this).data('temp');
			var humVal = $(this).data('hum');

			// Ajouter les données à des tableaux en fonction de l'option de temps sélectionnée
			if (time === 'today') {
				if (date === '<?php echo date("Y-m-d"); ?>') {
					dates.push(date);
					temp.push(tempVal);
					hum.push(humVal);
				}
			} else if (time === 'all-time') 
				dates.push(date);
</script>

</body>

</html>
