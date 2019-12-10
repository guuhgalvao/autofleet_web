<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Pagamento</title>
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
                    <h3>Pagamento</h3>                
                </div>
                <div class="container-fluid py-3">
    <div class="row">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4 mx-auto">
            <div id="pay-invoice" class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center">Pagamento</h3>
                    </div>
                    <hr>
                    <form action="/echo" method="post" novalidate="novalidate" class="needs-validation">
                        
                        <div class="form-group">
                            <label for="" class="control-label mb-1">Data de Retirada</label>
                            <input id="cc-payment" name="cc-payment" type="date" class="form-control">  
                            <label for="" class="control-label mb-1">Data de Retorno</label>
                            <input id="cc-payment" name="cc-payment" type="date" class="form-control">  
                        </div>
                        <div class="form-group">
                            <label for="cc-payment" class="control-label mb-1">Valor do pagamento</label>
                            <input id="cc-payment" name="cc-payment" type="text" class="form-control" aria-required="true" aria-invalid="false" required value="100.00">
                            <span class="invalid-feedback">Valor invalido </span>
                        </div>
                        <div class="form-group has-success">
                            <label for="cc-name" class="control-label mb-1">Nome no Cartão</label>
                            <input id="cc-name" name="cc-name" type="text" class="form-control cc-name" required autocomplete="cc-name" aria-required="true" aria-invalid="false" aria-describedby="cc-name-error">
                            <span class="invalid-feedback">Digite o nome do titular do cartão</span>
                        </div>
                        <div class="form-group">
                            <label for="cc-number" class="control-label mb-1">Número do Cartão</label>
                            <input id="cc-number" name="cc-number" type="tel" class="form-control cc-number identified visa" required="" pattern="[0-9]{16}">
                            <span class="invalid-feedback">Digite o número correto do cartão</span>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cc-exp" class="control-label mb-1">Expira em</label>
                                    <input id="cc-exp" name="cc-exp" type="tel" class="form-control cc-exp" required placeholder="MM / YY" autocomplete="cc-exp">
                                    <span class="invalid-feedback">Digite a data de vencimento</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="x_card_code" class="control-label mb-1"></label>
                                <div class="input-group">
                                    <input id="x_card_code" name="x_card_code" type="tel" class="form-control cc-cvc" required autocomplete="off">
                                    <span class="invalid-feedback order-last">Digite o código de segurança</span>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                        <span class="fa fa-question-circle fa-lg" data-toggle="popover" data-container="body" data-html="true" data-title="Security Code" 
                                        data-content="<div class='text-center one-card'>The 3 digit code on back of the card..<div class='visa-mc-cvc-preview'></div></div>"
                                        data-trigger="hover"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        <div>
                            <button id="payment-button" type="submit" class="btn btn-lg btn-black btn-block">
                                <i class="fa fa-lock fa-lg"></i>&nbsp;
                                <span id="payment-button-amount">Confirmar </span>
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