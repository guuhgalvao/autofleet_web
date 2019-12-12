<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Relatórios de Multas</title>
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../css/all.min.css">
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
	<script src="../../js/jquery-3.4.1.min.js"></script>
	<script src="../../js/bootstrap.min.js"></script>
</head>

<body>
	<div id="app">
		<?php require_once "../../config.php"; ?>
		<?php require_once "../header.php"; ?>
	
		<!--------- Relatório de Multas ---------->
		<div class="container mt-3">
        <table class="table">
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Usuário</th>
      <th scope="col">Veículo</th>
      <th scope="col">Data</th>
      <th scope="col">Valor da Multa</th>

    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td></td>
      <td></td>
      <td></td>
      <td></td>

    </tr>
  </tbody>
</table>
		
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