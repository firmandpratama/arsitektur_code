<!-- PWA Offcanvas
<div class="offcanvas offcanvas-bottom pwa-offcanvas">
	<div class="container">
		<div class="offcanvas-body small">
			<img class="logo" src="../assets/images/icon.png" alt="">
			<h5 class="title">Jobie on Your Home Screen</h5>
			<p class="pwa-text">Install Jobie job portal mobile app template to your home screen for easy access, just like any other app</p>
			<a href="javascrpit:void(0);" class="btn btn-sm btn-secondary pwa-btn">Add to Home Screen</a>
			<a href="javascrpit:void(0);" class="btn btn-sm pwa-close light btn-danger ms-2">Maybe later</a>
		</div>
	</div>
</div>
<div class="offcanvas-backdrop pwa-backdrop"></div> -->
<!-- PWA Offcanvas End -->
<!--**********************************
    Scripts
***********************************-->
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="index.js" defer=""></script>
<script src="assets/js/jquery.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/settings.js"></script>
<script src="assets/js/custom.js"></script>
<script src="assets/js/dz.carousel.js"></script><!-- Swiper -->
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script><!-- Swiper -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
	var options = {
		series: [44, 55, 41],
		chart: {
			type: 'donut',
		},
		colors: ["#ff6e31", "#ffebb7", "#ad8e70"],

		responsive: [{
			breakpoint: 480,
			options: {
				chart: {
					height: 200,
					width: 300,
				},
				legend: {
					show: false
				},
				plotOptions: {
					pie: {
						donut: {
							size: '40%'
						}
					}
				},

			}
		}]
	};

	var chart = new ApexCharts(document.querySelector("#chart"), options);
	chart.render();
</script>
</body>

</html>