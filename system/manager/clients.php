<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cadastro de Clientes</title>
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../css/all.min.css">
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
	<script src="../../js/jquery-3.4.1.min.js"></script>
	<script src="../../js/bootstrap.min.js"></script>
</head>

<body>
	<div id="app">
		<?php require_once "../header.php"; ?>
	
		<!--------- Cadastro de Clientes ---------->
		<div class="container mt-3">
            <div class="card border-dark mb-3">
                <div class="card-header bg-dark text-white">
                    <h3>Gerenciar Clientes</h3>                
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <form>
                                <div class="form-group">
                                    <label for="">Razão Social</label>
                                    <input type="text" class="form-control" id="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">CNPJ</label>
                                    <input type="text" class="form-control" id="" placeholder="">
                                </div>
                                <h2>Endereço</h2>
                                <div class="form-group">
                                    <label for="">Logradouro</label>
                                    <input type="text" class="form-control" id="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">Número</label>
                                    <input type="number" class="form-control" id="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">Complemento</label>
                                    <input type="text" class="form-control" id="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">Bairro</label>
                                    <input type="text" class="form-control" id="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">Cidade</label>
                                    <input type="text" class="form-control" id="" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">Estado</label>
                                    <input type="text" class="form-control" id="" placeholder="">
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
                                <th>Razão</th>
                                <th>CNPJ</th>
                                <th>Endereço</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Cliente 1</td>
                                <td>1235.12512.1512~123-2</td>
                                <td>Rua das flores, 420</td>
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