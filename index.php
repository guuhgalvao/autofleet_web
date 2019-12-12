
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/all.min.css">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<script src="./js/jquery-3.4.1.min.js"></script>
   <script src="./js/bootstrap.min.js"></script>
   <script src="./js/sweetalert2.all.min.js"></script>
</head>
<body>
   <div class="sidenav">
      <div class="login-main-text">
      <img src="css/giphy.gif">
      </div>
   </div>
   <div class="main">
      <div class="row align-items-center h-100">
         <div class="col-md-4 col-sm-12">
            <div class="login-form">
               <form id="frmLogin">
                  <div class="form-group">
                     <label>E-mail</label>
                     <input type="email" class="form-control" placeholder="E-mail" name="email" id="email" required>
                  </div>
                  <div class="form-group">
                     <label>Senha</label>
                     <input type="password" class="form-control" placeholder="Senha" name="password" id="password" required>
                  </div>
                  <button type="submit" class="btn btn-black" id="btnLogin">Login</button>
               </form>
            </div>
         </div>
      </div>
   </div>
   <script>
      $(document).ready(function(){
         var user = JSON.parse(sessionStorage.getItem('user'));

         if (user !== null) {
            window.location = './system';
         }

         $('#frmLogin').on('submit', function(e){
            e.preventDefault();
            e.stopPropagation();

            var formData = {
               email: $('#email').val(),
               password: $('#password').val()
            };

            $.ajax({
               type: "POST",
               url: "http://localhost:8080/api/user/login",
               dataType: 'json',
               contentType: "application/json; charset=utf-8",
               data: JSON.stringify(formData),
               success: function(response) {
                  if (response.status === 'success') {
                     // console.log(response);
                     sessionStorage.setItem('user', JSON.stringify(response.data));
                     window.location = './system';
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