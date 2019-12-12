<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reserva de Veiculos</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/sweetalert2.all.min.js"></script>
</head>

<body>
    <div id="app">
        <?php require_once "../config.php"; ?>
        <?php require_once "./header.php"; ?>

        <!--------- Galeria de Veículos ---------->

        <div class="container">
            <br>
            <h4>Reserva de Veículos</h2>
                <br>
                <div class="row" id="ads">

                    <!-- Category Card -->
                    <!-- <div class="col-md-4 mb-4">
                        <div class="card rounded">
                            <div class="card-image">
                                <span class="card-notify-badge">Low KMS</span>
                                <span class="card-notify-year">2018</span>
                                <img class="img-fluid" src="https://imageonthefly.autodatadirect.com/images/?USER=eDealer&PW=edealer872&IMG=USC80HOC011A021001.jpg&width=440&height=262" alt="Alternate Text" />
                            </div>
                            <div class="card-image-overlay m-auto">
                                <span class="card-detail-badge">2018</span>
                            </div>
                            <div class="card-body text-center">
                                <div class="ad-title m-auto">
                                    <h5>Honda Accord LX</h5>
                                </div>
                                <a class="ad-btn" href="reservation.php">Reservar</a>
                            </div>
                        </div>
                    </div> -->
                </div>
        </div>

        <script>
            $(document).ready(function() {

                $(document).on('click', '#reservation', function(e){
                    e.preventDefault();
                    e.stopPropagation();

                    var vehicle_id = $(this).attr('data-id');
                    sessionStorage.setItem('vehicle_id', vehicle_id);

                    window.location = './reservation.php';
                });

                var vehicles = {};

                $.ajax({
                    type: "GET",
                    url: "http://localhost:8080/api/vehicles/",
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    success: function(response) {
                        vehicles = response;

                        $('#ads div').remove();

                        if (vehicles.length > 0) {
                            $.each(vehicles, function(index, obj) {
                                if (obj.status === 1) {
                                    $('#ads').append(`<div class="col-md-4 mb-4">
                                                                    <div class="card rounded">
                                                                        <div class="card-image">
                                                                            <span class="card-notify-badge">${obj.mileage} Km</span>
                                                                            <span class="card-notify-year">${obj.year}</span>
                                                                            <img class="img-fluid" src="https://imageonthefly.autodatadirect.com/images/?USER=eDealer&PW=edealer872&IMG=USC80HOC011A021001.jpg&width=440&height=262" alt="Alternate Text" />
                                                                        </div>
                                                                        <div class="card-image-overlay m-auto">
                                                                            <span class="card-detail-badge">${obj.plate}</span>
                                                                        </div>
                                                                        <div class="card-body text-center">
                                                                            <div class="ad-title m-auto">
                                                                                <h5>${obj.brand} ${obj.model} - ${obj.color}</h5>
                                                                            </div>
                                                                            <a class="ad-btn" href="" id="reservation" data-id="${obj.id}">Reservar</a>
                                                                        </div>
                                                                    </div>
                                                                </div>`);
                                }
                            });
                        } else {
                            Swal.fire({
                                title: 'Alerta!',
                                text: 'Nenhum resultado encontrado!',
                                icon: 'info',
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
        </script>
</body>

</html>