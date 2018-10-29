	<nav class="navbar navbar-light bg-light">
		<div class="container">
			<span class="menu" id="menu">&#9776;</span>
			<h1 class="brand">AppSend</h1>
			<div class="dropdown">
				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
					<?php echo strtoupper($_SESSION["sw"]); ?>
				</button>
				<div class="dropdown-menu">
				    <a class="dropdown-item" href="#">Change Password</a>
				    <a class="dropdown-item" href="../logout.php">Logout</a>
				</div>
			</div>			
		</div>
	</nav>