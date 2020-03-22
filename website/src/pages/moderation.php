<?php include_once 'header.php' ?>

<div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Moderation</li>
      </ol>
    </nav>
    <div class="row">
      <div class="col">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
          <a class="nav-link active" id="users-tab" data-toggle="tab" href="#users" role="tab" aria-controls="users" aria-selected="true">Users</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" id="auctions-tab" data-toggle="tab" href="#auctions" role="tab" aria-controls="auctions" aria-selected="false">Auctions</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Reports</a>
          </li>
        </ul>
        <div class="tab-content mt-4" id="myTabContent">
          <div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="users-tab">
            <div class="card mx-auto">  
              <div class="d-flex justify-content-end">
                <img class="d-none d-sm-block card-img-left rounded-circle my-auto p-3" src="../img/cages.png" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">Joao Cages</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <p class="card-text">-User Registered on: 13/3/17</p>
                  <p class="card-text"> -Status: Active</p>
                  <a href="#" class="btn btn-primary">Suggest to Mod</a>
                  <a href="#" class="btn btn-primary">Ban</a>
                </div>
              </div>
            </div>
            <div class="card mx-auto">
              <div class="d-flex justify-content-end">
                <img class="d-none d-sm-block card-img-left rounded-circle my-auto p-3" src="../img/cages.png" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">Joao Samuel</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <p class="card-text">-User Registered on: 13/3/17</p>
                  <p class="card-text"> -Status: Active</p>
                  <a href="#" class="btn btn-primary">Suggest to Mod</a>
                  <a href="#" class="btn btn-primary">Ban</a>
                </div>
              </div>
            </div>
            <div class="card mx-auto">
              <div class="d-flex justify-content-end">
                <img class="d-none d-sm-block card-img-left rounded-circle my-auto p-3" src="../img/cages.png" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">Joao Campos</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <p class="card-text">-User Registered on: 13/3/17</p>
                  <p class="card-text"> -Status: Banned</p>
                  <a href="#" class="btn btn-primary">Suggest to Mod</a>
                  <button type="button" class="btn btn-outline-white">Not Banned by you</button>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="auctions" role="tabpanel" aria-labelledby="auctions-tab">
            <div class="d-flex justify-content-end mt-5">
              <div>
                <div class="card mx-auto">
                  <div class="row no-gutters">
                    <img class="card-img col-md-5" src="../img/Harley-Davidson-FXDR-114_Fernando-M-1.jpg" alt="Card image cap">
                    <div class="card-body col-md-7 p-3">
                      <h5 class="card-title float-right text-success">OnGOING </h5>
                      <h5 class="card-title">Harley Davidson</h5>
                      <p class="card-text">2008, 1600cc, 6vel, many extras and in immaculate condition. Recent overhaul and new tires.</p>
                      <p class="card-text">00d 22h 25m 17s left</p>
                      <a href="#" class="btn btn-primary">REMOVE</a>
                      <a href="#" class="btn btn-primary">CHANGE CATEGORY</a>
                    </div>
                  </div>

                </div>
                <div class="card mx-auto">
                  <div class="row no-gutters">
                    <img class="card-img col-md-5" src="../img/yamaha.jpg" alt="Card image cap">
                    <div class="card-body col-md-7 p-3">
                      <h5 class="card-title float-right text-danger">REMOVED </h5>
                      <h5 class="card-title">Yamaha R10M</h5>
                      <p class="card-text">2018, 1600cc, 5vel, many extras and new tires. Recent overhaul.</p>
                      <p class="card-text">10d 20h 35m 12s left</p>
                      <a href="#" class="btn btn-primary">UNDO REMOVE</a>
                      <a href="#" class="btn btn-primary">CHANGE CATEGORY</a>
                    </div>
                  </div>
                </div>
                <div class="card mx-auto">
                  <div class="row no-gutters">
                    <img class="card-img col-md-5" src="../img/kawasaki.jpg" alt="Card image cap">
                    <div class="card-body col-md-7 p-3">
                      <h5 class="card-title float-right text-muted">Closed </h5>
                      <h5 class="card-title">Kawasaki Ninja</h5>
                      <p class="card-text">2015, 1600cc, 7vel, next-level technology advancements and sharp styling updates.</p>
                      <p class="card-text">03d 02h 21m 57s left</p>
                      <a href="#" class="btn btn-primary">REMOVE</a>
                      <a href="#" class="btn btn-primary">CHANGE CATEGORY</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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