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
    <script src="../js/sweetalert2.all.min.js"></script>
    <script src="../js/jquery.mask.min.js"></script>
</head>

<body>
    <div id="app">
        <?php require_once "../config.php"; ?>
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
                                            <input type="text" class="form-control" id="reservation" placeholder="aaaa-mm-dd">
                                            <br>
                                            <label for="" class="control-label mb-1">Data de Retorno</label>
                                            <input type="text" class="form-control" id="return" placeholder="aaaa-mm-dd">
                                        </div>

                                        <button id="btnConfirm" type="button" class="btn btn-lg btn-black btn-block">
                                            <span id="payment-button-amount">Confirmar reserva </span>
                                            <span id="payment-button-sending" class="d-none">Enviando…</span>
                                        </button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#reservation, #return').mask('0000-00-00');

            var user = JSON.parse(sessionStorage.getItem('user'));
            var vehicle_id = JSON.parse(sessionStorage.getItem('vehicle_id'));

            $('#btnConfirm').on('click', function(e) {

                var reservationDate = $('#reservation').val().split('-');
                var returnDate = $('#return').val().split('-');

                var formData = {
                    vehicle_id: vehicle_id,
                    user_id: user.id,
                    reservation_date: new Date(reservationDate[0], reservationDate[1], reservationDate[2]).getTime(),
                    return_date: new Date(returnDate[0], returnDate[1], returnDate[2]).getTime(),
                };

                $.ajax({
                    type: "POST",
                    url: "http://localhost:8080/api/reservation/",
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    data: JSON.stringify(formData),
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                title: 'Alerta!',
                                text: 'Veículo reservado',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.value) {
                                    window.location = '<?= SYS_URL ?>/system';
                                }
                            })
                        } else {
                            Swal.fire({
                                title: 'Alerta!',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            })
                        }
                    },
                    error: function(data) {
                        console.log(data);
                        Swal.fire({
                            title: 'Alerta!',
                            text: 'Erro ao conectar, tente novamente!',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        })
                    }
                });
            });
        });
    </script>
</body>

</html>