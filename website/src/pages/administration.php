<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="/stylesheets/bootstrap.css">

    <title>SlashAh</title>
  </head>

  <body>
    <header>
      <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <a class="navbar-brand text-light" href="/">SLASH AH (Administration)</a>
            <li class="nav-item">
              <a class="text-light">9999.99€</a>
            </li>
      </nav>
    </header>

  <div class="container">
    <div class="row">
      <div class="col">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Auctions</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Statistics</a>
          </li>
        </ul>
        <div class="tab-content mt-4" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"><div class="card mx-auto">
          <div class="d-flex justify-content-end">
            <img class="card-img-left rounded-circle my-auto" src="/img/cages.png" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Joao Cages</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary">Make Mod</a>
              <a href="#" class="btn btn-primary">Ban</a>
            </div>
          </div>
        </div>
        <div class="card mx-auto">
          <div class="d-flex justify-content-end">
            <img class="card-img-left rounded-circle my-auto" src="/img/cages.png" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Joao Samuel</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary">Make Mod</a>
              <a href="#" class="btn btn-primary">Ban</a>
            </div>
          </div>
        </div>
        <div class="card mx-auto">
          <div class="d-flex justify-content-end">
            <img class="card-img-left rounded-circle my-auto" src="/img/cages.png" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Joao Campos</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary">Make Mod</a>
              <a href="#" class="btn btn-primary">Ban</a>
            </div>
          </div>
        </div> 
          </div>
          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">Food truck fixie
            locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit,
            blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee.
            Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum
            PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS
            salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit,
            sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester
            stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.
          </div>
          <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
          <div class="card-deck">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Best Category</h5>
                  <p class="card-text">This week best selling category is Cars!</p>
                </div>
                <div class="card-footer">
                  <small class="text-muted">Last updated 3 mins ago</small>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Worst Category</h5>
                  <p class="card-text">This week worst selling category is Antiques!</p>
                </div>
                <div class="card-footer">
                  <small class="text-muted">Last updated 3 mins ago</small>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title"> Money Flow</h5>
                  <p class="card-text"> In the last hour 123,770.67€ entered our virtual wallet</p>
                </div>
                <div class="card-footer">
                  <small class="text-muted">Last updated 3 mins ago</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include_once 'footer.php' ?>
