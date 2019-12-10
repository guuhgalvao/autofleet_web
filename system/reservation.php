<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Reserva</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/all.min.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<script src="../js/jquery-3.4.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</head>

<body>
	<div id="app">
		<?php require_once "./header.php"; ?>
	
		<!--------- Pagamento ---------->
		<div class="container mt-3">
            <div class="card border-dark mb-3">
                <div class="card-header bg-dark text-white">
                    <h3>Reserva</h3>                
                </div>
                <div class="container-fluid py-3">
    <div class="row">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4 mx-auto">
            <div id="pay-invoice" class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center">Reserva</h3>
                    </div>
                    <hr>
                    <form action="/echo" method="post" novalidate="novalidate" class="needs-validation">
                    
                        <div class="form-group">
                            <label for="" class="control-label mb-1">Data de Retirada</label>
                            <input id="cc-payment" name="cc-payment" type="date" class="form-control"> 
                            <br> 
                            <label for="" class="control-label mb-1">Data de Retorno</label>
                            <input id="cc-payment" name="cc-payment" type="date" class="form-control">  
                        </div>
                       
                            <button id="payment-button" type="submit" class="btn btn-lg btn-black btn-block">
                                <span id="payment-button-amount">Confirmar reserva </span>
                                <span id="payment-button-sending" style="display:none;">Enviando…</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
	
	<script> 
		$(function () {
  $('[data-toggle="popover"]').popover()
})


$("#payment-button").click(function(e) {

    // Fetch form to apply Bootstrap validation
    var form = $(this).parents('form');
    
    if (form[0].checkValidity() === false) {
      e.preventDefault();
      e.stopPropagation();
    }
    else {
      // Perform ajax submit here
      form.submit();
    }
    
    form.addClass('was-validated');
});
	</script>
</body>
</html>