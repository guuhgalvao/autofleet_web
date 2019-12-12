<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
	<div class="container">
		<a class="navbar-brand text-white" href="<?= SYS_URL ?>/system/">AutoFleet</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<!-- Left Side Of Navbar -->
			<ul class="navbar-nav mr-auto">
				<li class="nav-item"><a class="nav-link disabled" href="<?= SYS_URL ?>/system/rent.php">Alugar Veículos</a></li>
				<li class="nav-item dropdown">
					<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
						<i class="fas fa-cogs"></i> Gerenciar <span class="caret"></span>
					</a>

					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="<?= SYS_URL ?>/system/manager/clients.php">Clientes</a>
						<a class="dropdown-item disabled" href="<?= SYS_URL ?>/system/manager/fines.php">Multas</a>
						<a class="dropdown-item" href="<?= SYS_URL ?>/system/manager/users.php">Usuários</a>
						<a class="dropdown-item" href="<?= SYS_URL ?>/system/manager/vehicles.php">Veículos</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
						<i class="fas fa-copy"></i> Relatórios <span class="caret"></span>
					</a>

					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
						<a class="dropdown-item disabled" href="<?= SYS_URL ?>/system/reports/reportreservations.php"> Reservas</a>
						<a class="dropdown-item disabled" href="<?= SYS_URL ?>/system/reports/reportfines.php">Multas</a>
					</div>
				</li>
			</ul>

			<!-- Right Side Of Navbar -->
			<ul class="navbar-nav ml-auto">
				<li class="nav-item dropdown">
					<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
						<i class="fas fa-user"></i> <span id="userName">UserName</span> <span class="caret"></span>
					</a>

					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="" id="logout">Logout</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
</nav>

<script>
	$(document).ready(function() {
		var user = JSON.parse(sessionStorage.getItem('user'));

		$('#userName').text(user.name);

		$('#logout').on('click', function(e){
			e.preventDefault();
			e.stopPropagation();

			console.log('Okay');
			sessionStorage.clear();
			window.location = '<?= SYS_URL ?>';
		});
	});
</script>