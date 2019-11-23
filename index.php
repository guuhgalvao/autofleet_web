
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/all.min.css">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<script src="./js/jquery-3.4.1.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
</head>

<body>
	<div id="app">
		<?php require_once "./header.php";?>
	
		<!--------- Galeria de Veículos ---------->
		<div class="container mt-3">
			<div class="card" style="width: 18rem;">
	<img src="..." class="card-img-top" alt="...">
	<div class="card-body">
		<h5 class="card-title">Card title</h5>
		<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
	</div>
	<div class="card-body">
		<a href="#" class="card-link">Card link</a>
		<a href="#" class="card-link">Another link</a>
	</div>
	</div>
	
	<div class="card" style="width: 18rem;">
	<img src="..." class="card-img-top" alt="...">
	<div class="card-body">
		<h5 class="card-title">Card title</h5>
		<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
	</div>
	<div class="card-body">
		<a href="#" class="card-link">Card link</a>
		<a href="#" class="card-link">Another link</a>
	</div>
	</div>
		</div>
	</div>
	
	<script> 
		$(document).ready(function () {

			$(".filter-button").click(function () {
				var value = $(this).attr('data-filter');

				if (value == "all") {
					//$('.filter').removeClass('hidden');
					$('.filter').show('1000');
				}
				else {
					//            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
					//            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
					$(".filter").not('.' + value).hide('3000');
					$('.filter').filter('.' + value).show('3000');

				}
			});

			if ($(".filter-button").removeClass("active")) {
				$(this).removeClass("active");
			}
			$(this).addClass("active");

		});
	</script>
</body>
</html>