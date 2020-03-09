<?php include_once 'header.php' ?>

<div class="container-fluid">
  <div class="row mt-5">
    <div class="col">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="users-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="auctions-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Auctions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="reports-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Reports</a>
        </li>
      </ul>
      <div class="tab-content mt-4" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="users-tab">
        <div class="card mx-auto">
          <div class="d-flex justify-content-end">
            <img class="card-img-left rounded-circle my-auto" src="img/cages.png" alt="Card image cap">
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
            <img class="card-img-left rounded-circle my-auto" src="img/cages.png" alt="Card image cap">
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
            <img class="card-img-left rounded-circle my-auto" src="img/cages.png" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Joao Campos</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary">Make Mod</a>
              <a href="#" class="btn btn-primary">Ban</a>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="auctions-tab">Food truck fixie
          locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit,
          blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee.
          Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum
          PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS
          salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit,
          sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester
          stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="reports-tab">Etsy mixtape
          wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack
          lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard
          locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify
          squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie
          etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog
          stumptown. Pitchfork sustainable tofu synth chambray yr.</div>
      </div>
    </div>
  </div>
</div>

<?php include_once 'footer.php' ?>
