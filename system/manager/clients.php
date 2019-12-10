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
    <script src="../../js/sweetalert2.all.min.js"></script>
    <script src="../../js/jquery.mask.min.js"></script>
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
                            <form id="frmBase">
                                <div class="form-group">
                                    <label for="">Razão Social</label>
                                    <input type="text" class="form-control" id="name" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">CNPJ</label>
                                    <input type="text" class="form-control" id="cnpj" placeholder="">
                                </div>
                                <h2>Endereço</h2>
                                <div class="form-group">
                                    <label for="">Logradouro</label>
                                    <input type="text" class="form-control" id="address" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">Número</label>
                                    <input type="number" class="form-control" id="number" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">Complemento</label>
                                    <input type="text" class="form-control" id="complement" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">Bairro</label>
                                    <input type="text" class="form-control" id="district" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">Cidade</label>
                                    <input type="text" class="form-control" id="city" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">Estado</label>
                                    <input type="text" class="form-control" id="state" placeholder="">
                                </div>
                                <input type="hidden" id="client_id">

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
                    <h3>Lista de Clientes</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-strped" id="listResult">
                        <thead>
                            <tr>
                                <th>Razão</th>
                                <th>CNPJ</th>
                                <th>Endereço</th>
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
            $('#cnpj').mask('00.000.000/0000-00', {
                reverse: true
            });
            $('#number').mask('00999');
            $('#state').mask('SS');

            var clients = {};

            $('#btnSave').on('click', function(e) {

                var formData = {
                    name: $('#name').val(),
                    cnpj: $('#cnpj').val(),
                    address: $('#address').val(),
                    number: $('#number').val(),
                    complement: $('#complement').val(),
                    district: $('#district').val(),
                    city: $('#city').val(),
                    state: $('#state').val()
                };

                $.ajax({
                    type: "POST",
                    url: "http://localhost:8080/api/client/",
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    data: JSON.stringify(formData),
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#frmBase')[0].reset();
                            $('#client_id').val('')
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
                    url: "http://localhost:8080/api/clients/",
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    success: function(response) {
                        console.log(response);
                        clients = response;

                        $('#listResult tbody tr').remove()
                        if (clients.length > 0) {
                            $.each(clients, function(index, obj) {
                                $('#listResult tbody').append(`<tr data-index="${index}"><td>${obj.name}</td><td>${obj.cnpj}</td><td>${obj.address}, ${obj.number} ${obj.complement} - ${obj.district} - ${obj.city}/${obj.state}</td></tr>`);
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

                if ($('#client_id').val() !== '') {
                    var formData = {
                        id: $('#client_id').val(),
                        name: $('#name').val(),
                        cnpj: $('#cnpj').val(),
                        address: $('#address').val(),
                        number: $('#number').val(),
                        complement: $('#complement').val(),
                        district: $('#district').val(),
                        city: $('#city').val(),
                        state: $('#state').val()
                    };

                    $.ajax({
                        type: "POST",
                        url: "http://localhost:8080/api/client/update",
                        dataType: 'json',
                        contentType: "application/json; charset=utf-8",
                        data: JSON.stringify(formData),
                        success: function(response) {
                            if (response.status === 'success') {
                                $('#frmBase')[0].reset();
                                $('#client_id').val('')
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

                if ($('#client_id').val() !== '') {
                    var formData = {
                        id: $('#client_id').val()
                    };

                    $.ajax({
                        type: "POST",
                        url: "http://localhost:8080/api/client/delete",
                        dataType: 'json',
                        contentType: "application/json; charset=utf-8",
                        data: JSON.stringify(formData),
                        success: function(response) {
                            if (response.status === 'success') {
                                $('#frmBase')[0].reset();
                                $('#client_id').val('')
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

                $('#client_id').val(client.id);
                $('#name').val(client.name);
                $('#cnpj').val(client.cnpj);
                $('#address').val(client.address);
                $('#number').val(client.number);
                $('#complement').val(client.complement);
                $('#district').val(client.district);
                $('#city').val(client.city);
                $('#state').val(client.state);

                $('#divResult').addClass('d-none');
            });
        });
    </script>
</body>

</html>