<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" type="text/css" href="../stylesheets/bootstrap.css">

  <script src="https://kit.fontawesome.com/aac9f57b5f.js" crossorigin="anonymous"></script>

  <title>SlashAh</title>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <a class="navbar-brand text-light" href="index.php"><img src="../img/logo_white.png" width="80" height="60" alt="SLASH AH"></a>
        <div class="d-flex flex-row order-2 order-lg-3">
      </nav>

    </header>
<!-- end header -->

<div class="container mt-5">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Administrator Area</h3>
			</div>
			<div class="card-body">
				<form>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="admin username">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="password">
					</div>
					<div class="form-group d-flex p-2 bd-highlight ">
						<input type="submit" value="Administrator Login" class="btn btn-outline-info flex-grow-1">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<?php include_once 'footer.php' ?>
