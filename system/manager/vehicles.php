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
    <script src="../../js/sweetalert2.all.min.js"></script>
    <script src="../../js/jquery.mask.min.js"></script>
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
                            <form id="frmBase">
                                <div class="form-group">
                                    <label for="">Placa</label>
                                    <input type="text" class="form-control" id="plate" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">Marca</label>
                                    <input type="text" class="form-control" id="brand" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">Modelo</label>
                                    <input type="text" class="form-control" id="model" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">Cor</label>
                                    <input type="text" class="form-control" id="color" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">Ano</label>
                                    <input type="text" class="form-control" id="year" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">KM</label>
                                    <input type="text" class="form-control" id="mileage" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">Escolha a opção</label>
                                    <select class="form-control" id="type">
                                        <option value="" selected>Selecione</option>
                                        <option value="1">Reservar</option>
                                        <option value="2">Alugar</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Cliente</label>
                                    <select class="form-control" id="client_id">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Valor</label>
                                    <input type="text" class="form-control" id="price" placeholder="">
                                </div>
                                <input type="hidden" id="status" value="1">
                                <input type="hidden" id="vehicle_id">

                                <button type="button" class="btn btn-dark mt-5" id="btnSave">Salvar</button>
                                <button type="button" class="btn btn-dark mt-5" id="btnConsult">Consultar</button>
                                <button type="button" class="btn btn-dark mt-5" id="btnEdit">Editar</button>
                                <button type="button" class="btn btn-dark mt-5" id="btnRemove">Excluir</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-dark mb-5 d-none" id="divResult">
                <div class="card-header bg-dark text-white">
                    <h3>Lista de Veículos</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-strped" id="listResult">
                        <thead>
                            <tr>
                                <th>Placa</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Cor</th>
                                <th>Ano</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#plate').mask('SSS-0000');
            $('#year').mask('0000');
            $('#mileage').mask("#.##0.000", {reverse: true});
            $('#price').mask("#.##0.00", {reverse: true});

            $.ajax({
                type: "GET",
                url: "http://localhost:8080/api/clients/",
                dataType: 'json',
                contentType: "application/json; charset=utf-8",
                success: function(response) {

                    if (response.length > 0) {
                        $('#client_id').append(`<option value="" selected>Selecione</option>`);
                        $.each(response, function(index, obj) {
                            $('#client_id').append(`<option value="${obj.id}">${obj.name}</option>`);
                        });
                    } else {
                        $('#client_id').append(`<option value="" selected>Nenhum</option>`);
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

            var clients = {};

            $('#btnSave').on('click', function(e) {

                var formData = {
                    plate: $('#plate').val(),
                    brand: $('#brand').val(),
                    model: $('#model').val(),
                    color: $('#color').val(),
                    year: $('#year').val(),
                    mileage: $('#mileage').val(),
                    type: $('#type').val(),
                    client_id: $('#client_id').val(),
                    price: $('#price').val(),
                    status: $('#status').val()
                };

                $.ajax({
                    type: "POST",
                    url: "http://localhost:8080/api/vehicle/",
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    data: JSON.stringify(formData),
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#frmBase')[0].reset();
                            $('#vehicle_id').val('')
                            Swal.fire({
                                title: 'Alerta!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
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

            $('#btnConsult').on('click', function(e) {

                $.ajax({
                    type: "GET",
                    url: "http://localhost:8080/api/vehicles/",
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    success: function(response) {
                        console.log(response);
                        clients = response;

                        $('#listResult tbody tr').remove()
                        if (clients.length > 0) {
                            $.each(clients, function(index, obj) {
                                $('#listResult tbody').append(`<tr data-index="${index}"><td>${obj.plate}</td><td>${obj.brand}</td><td>${obj.model}</td><td>${obj.color}</td><td>${obj.year}</td></tr>`);
                            });

                            $('#divResult').removeClass('d-none');
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

            $('#btnEdit').on('click', function(e) {

                if ($('#vehicle_id').val() !== '') {
                    var formData = {
                        id: $('#vehicle_id').val(),
                        plate: $('#plate').val(),
                        brand: $('#brand').val(),
                        model: $('#model').val(),
                        color: $('#color').val(),
                        year: $('#year').val(),
                        mileage: $('#mileage').val(),
                        type: $('#type').val(),
                        client_id: $('#client_id').val(),
                        price: $('#price').val(),
                        status: $('#status').val()
                    };

                    $.ajax({
                        type: "POST",
                        url: "http://localhost:8080/api/vehicle/update",
                        dataType: 'json',
                        contentType: "application/json; charset=utf-8",
                        data: JSON.stringify(formData),
                        success: function(response) {
                            if (response.status === 'success') {
                                $('#frmBase')[0].reset();
                                $('#vehicle_id').val('')
                                Swal.fire({
                                    title: 'Alerta!',
                                    text: response.message,
                                    icon: 'success',
                                    confirmButtonText: 'OK'
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
                } else {
                    Swal.fire({
                        title: 'Alerta!',
                        text: 'Consulte e selecione um registro!',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    })
                }
            });

            $('#btnRemove').on('click', function(e) {

                if ($('#vehicle_id').val() !== '') {
                    var formData = {
                        id: $('#vehicle_id').val()
                    };

                    $.ajax({
                        type: "POST",
                        url: "http://localhost:8080/api/vehicle/delete",
                        dataType: 'json',
                        contentType: "application/json; charset=utf-8",
                        data: JSON.stringify(formData),
                        success: function(response) {
                            if (response.status === 'success') {
                                $('#frmBase')[0].reset();
                                $('#vehicle_id').val('')
                                Swal.fire({
                                    title: 'Alerta!',
                                    text: response.message,
                                    icon: 'success',
                                    confirmButtonText: 'OK'
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
                } else {
                    Swal.fire({
                        title: 'Alerta!',
                        text: 'Consulte e selecione um registro!',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    })
                }
            });

            $(document).on('click', '#listResult tbody tr', function(e) {
                var client = clients[$(this).attr('data-index')];

                $('#vehicle_id').val(client.id);
                $('#plate').val(client.plate);
                $('#brand').val(client.brand);
                $('#model').val(client.model);
                $('#color').val(client.color);
                $('#year').val(client.year);
                $('#mileage').val(client.mileage);
                $('#type').val(client.type);
                $('#client_id').val(client.client_id);
                $('#price').val(client.price);
                $('#status').val(client.status);

                $('#divResult').addClass('d-none');
            });
        });
    </script>
</body>

</html>