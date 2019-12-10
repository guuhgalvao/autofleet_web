<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de Usuários</title>
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

        <!--------- Cadastro de Usuários ---------->
        <div class="container mt-3">
            <div class="card border-dark mb-3">
                <div class="card-header bg-dark text-white">
                    <h3>Gerenciar Usuários</h3>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <form id="frmBase">
                                <div class="form-group">
                                    <label for="">Nome</label>
                                    <input type="text" class="form-control" id="name" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">Telefone</label>
                                    <input type="text" class="form-control" id="phone" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">CPF</label>
                                    <input type="text" class="form-control" id="cpf" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">CNH</label>
                                    <input type="text" class="form-control" id="cnh" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">Senha</label>
                                    <input type="text" class="form-control" id="password" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">Cliente</label>
                                    <select class="form-control" id="client_id">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Tipo</label>
                                    <select class="form-control" id="type">
                                        <option value="" selected>Selecione</option>
                                        <option value="admin">Admin</option>
                                        <option value="manager">Gerente</option>
                                        <option value="client">Cliente</option>
                                    </select>
                                </div>
                                <input type="hidden" id="user_id">

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
                                <th>Nome
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>CPF</th>
                                <th>Tipo</th>
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
            $('#phone').mask('(00) 00000-0000');
            $('#cpf').mask('000.000.000-00', {
                reverse: true
            });

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
                    name: $('#name').val(),
                    email: $('#email').val(),
                    phone: $('#phone').val(),
                    cpf: $('#cpf').val(),
                    cnh: $('#cnh').val(),
                    password: $('#password').val(),
                    client_id: $('#client_id').val(),
                    type: $('#type').val()
                };

                $.ajax({
                    type: "POST",
                    url: "http://localhost:8080/api/user/",
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    data: JSON.stringify(formData),
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#frmBase')[0].reset();
                            $('#user_id').val('')
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
                    url: "http://localhost:8080/api/users/",
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    success: function(response) {
                        console.log(response);
                        clients = response;

                        $('#listResult tbody tr').remove()
                        if (clients.length > 0) {
                            $.each(clients, function(index, obj) {
                                $('#listResult tbody').append(`<tr data-index="${index}"><td>${obj.name}</td><td>${obj.email}</td><td>${obj.phone}</td><td>${obj.cpf}</td><td>${obj.type.toUpperCase()}</td></tr>`);
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

                if ($('#user_id').val() !== '') {
                    var formData = {
                        id: $('#user_id').val(),
                        name: $('#name').val(),
                        email: $('#email').val(),
                        phone: $('#phone').val(),
                        cpf: $('#cpf').val(),
                        cnh: $('#cnh').val(),
                        password: $('#password').val(),
                        client_id: $('#client_id').val(),
                        type: $('#type').val()
                    };

                    $.ajax({
                        type: "POST",
                        url: "http://localhost:8080/api/user/update",
                        dataType: 'json',
                        contentType: "application/json; charset=utf-8",
                        data: JSON.stringify(formData),
                        success: function(response) {
                            if (response.status === 'success') {
                                $('#frmBase')[0].reset();
                                $('#user_id').val('')
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

                if ($('#user_id').val() !== '') {
                    var formData = {
                        id: $('#user_id').val()
                    };

                    $.ajax({
                        type: "POST",
                        url: "http://localhost:8080/api/user/delete",
                        dataType: 'json',
                        contentType: "application/json; charset=utf-8",
                        data: JSON.stringify(formData),
                        success: function(response) {
                            if (response.status === 'success') {
                                $('#frmBase')[0].reset();
                                $('#user_id').val('')
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

                $('#user_id').val(client.id);
                $('#name').val(client.name);
                $('#email').val(client.email);
                $('#phone').val(client.phone);
                $('#cpf').val(client.cpf);
                $('#cnh').val(client.cnh);
                $('#client_id').val(client.client_id);
                $('#type').val(client.type);

                $('#divResult').addClass('d-none');
            });
        });
    </script>
</body>

</html>