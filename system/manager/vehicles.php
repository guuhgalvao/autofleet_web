<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cadastro de Veículos</title>
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../css/all.min.css">
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
	<script src="../../js/jquery-3.4.1.min.js"></script>
	<script src="../../js/bootstrap.min.js"></script>
</head>

<body>
	<div id="app">
		<?php require_once "../header.php"; ?>
	
		<!--------- Cadastro de Veículos ---------->
		<div class="container mt-3">
            <div class="card border-dark mb-3">
                <div class="card-header bg-dark text-white">
                    <h3>Gerenciar Veículos</h3>                
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <form>
                                <div class="form-group">
                                    <label for="">Placa</label>
                                    <input type="text" class="form-control" id="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">Marca</label>
                                    <input type="text" class="form-control" id="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">Modelo</label>
                                    <input type="text" class="form-control" id="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">Cor</label>
                                    <input type="text" class="form-control" id="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">Ano</label>
                                    <input type="text" class="form-control" id="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">KM</label>
                                    <input type="text" class="form-control" id="" placeholder="">
                                </div>
								<div class="form-group">
									<label for="">Escolha a opção</label>
									<select class="form-control" id="">
										<option>Alugar Veículo</option>
										<option>Reservar Veículo</option>
									</select>
								</div>
                                <button type="button" class="btn btn-dark mt-5">Salvar</button>
                                <button type="button" class="btn btn-dark mt-5">Editar</button>
                                <button type="button" class="btn btn-dark mt-5">Excluir</button>
                                <button type="button" class="btn btn-dark mt-5">Consultar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-dark mb-5">
                <div class="card-header bg-dark text-white">
                    <h3>Lista de Clientes</h3>                
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-strped">
                        <thead>
                            <tr>
                                <th>Placa</th>
                                <th>Marca</th>
                                <th>Modelo</th>
								<th>Cor</th>
                                <th>Ano</th>
								<th>Opção<th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>AAA-2222</td>
								<td>FIAT</td>
								<td>PALIO AX</td>
                                <td>PRETO</td>
								<td>2006</td>
                                <td>Reserva</td>
                                
                            </tr>
                        </tbody>
                    </table>
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