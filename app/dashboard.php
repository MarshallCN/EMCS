<div class="col-sm-6"><canvas id="assocfoodChart"></canvas></div>
		<script>
			var assoc = document.getElementById("assocfoodChart");
			var data_radar = {
				labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
				datasets: [
					{
						label: "My First dataset",
						backgroundColor: "rgba(179,181,198,0.2)",
						borderColor: "rgba(179,181,198,1)",
						pointBackgroundColor: "rgba(179,181,198,1)",
						pointBorderColor: "#fff",
						pointHoverBackgroundColor: "#fff",
						pointHoverBorderColor: "rgba(179,181,198,1)",
						data: [65, 59, 90, 81, 56, 55, 40]
					},
					{
						label: "My Second dataset",
						backgroundColor: "rgba(255,99,132,0.2)",
						borderColor: "rgba(255,99,132,1)",
						pointBackgroundColor: "rgba(255,99,132,1)",
						pointBorderColor: "#fff",
						pointHoverBackgroundColor: "#fff",
						pointHoverBorderColor: "rgba(255,99,132,1)",
						data: [28, 48, 40, 19, 96, 27, 100]
						,fill: true
						,lineTension: 0
					}
				]
			};
			var myRadarChart = new Chart(assoc, {
				type: 'radar',
				data: data_radar,
				options: {
					responsive: true,
					title: {
						display: true,
						text: 'Titile test'
					},
					scale: {
						reverse: false,
						ticks: {
							beginAtZero: true
							,suggestedMin: 0
							,suggestedMax: 100
							,fixedStepSize: 10
						}
					}
				}
			});
		</script>