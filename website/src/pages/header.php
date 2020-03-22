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
        <a class="navbar-brand text-light" href="index.php"><img src="/img/logo_white.png" width="80" height="60" alt="SLASH AH"></a>
        <div class="d-flex flex-row order-2 order-lg-3">
          <ul class="navbar-nav flex-row">
            <li class="nav-item">
              <a class="nav-link text-light" data-toggle="modal" data-target="#moneyModal">7.75€</a>

              <!-- Modal -->
              <div class="modal fade" id="moneyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Money Management</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <button class="btn btn-block btn-danger">Deposit Money</button>
                      <button class="btn btn-block btn-outline-danger">Extract Money</button>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link text-light" href="userprofile.php">João Cages</a>
            </li>
            <li class="navbar-nav">
              <a class="navbar-brand" href="userprofile.php">
                <img src="/img/cages.png" class="rounded-circle" width="35" height="35" alt="">
              </a>
            </li>
          </ul>
          <button class="navbar-toggler bg-light" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse" id="navbarNav">
          <div class="w-100 d-flex flex-row-reverse">
            <form class="form-inline">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            </form>
          </div>
        </div>
      </nav>

    </header>
