<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
	<div class="container">
		<a class="navbar-brand text-white" href="/system/">AutoFleet</a>
		!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
			<span class="navbar-toggler-icon"></span>
		</button> -->

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<!-- Left Side Of Navbar -->
			<ul class="navbar-nav mr-auto">
				<li class="nav-item"><a class="nav-link" href="/system/rent.php">Aluguel de Veiculos</a></li>
				<li class="nav-item dropdown">
					<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
						<i class="fas fa-cogs"></i> Gerenciar <span class="caret"></span>
					</a>

					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="/system/manager/clients.php">Clientes</a>
						<a class="dropdown-item" href="/system/manager/fines.php">Multas</a>
						<a class="dropdown-item" href="/system/manager/users.php">Usuários</a>
						<a class="dropdown-item" href="/system/manager/vehicles.php">Veículos</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
					<i class="fas fa-copy"></i> Relatórios <span class="caret"></span>
					</a>

					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
						<a class="dropdown-item"  href="/system/reports/reportreservations.php"> Reservas</a>
						<a class="dropdown-item" href="/system/reports/reportfines.php">Multas</a>
					</div>
				</li>
			</ul>

			<!-- Right Side Of Navbar -->
			<ul class="navbar-nav ml-auto">
				<li class="nav-item dropdown">
					<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
						<i class="fas fa-user"></i> UserName <span class="caret"></span>
					</a>

					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="../index.php">Logout</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
</nav>
