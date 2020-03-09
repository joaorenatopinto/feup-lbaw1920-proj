<?php include_once 'header.php' ?>

<div class="container-fluid">
  <div class="row mt-5">
    <div class="col-3"></div>
    <div class="col">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="users-tab" data-toggle="tab" href="#users" role="tab" aria-controls="users" aria-selected="true">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="auctions-tab" data-toggle="tab" href="#auctions" role="tab" aria-controls="auctions" aria-selected="false">Auctions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="reports-tab" data-toggle="tab" href="#reports" role="tab" aria-controls="reports" aria-selected="false">Reports</a>
        </li>
      </ul>
      <div class="tab-content" id="users">
        <div class="row">
          <div class="col-1">#</div>
          <div class="col-2">Name</div>
          <div class="col-1">#</div>
          <div class="col-1">#</div>
        </div>
      </div>
      <div class="tab-pane fade" id="auctions" role="tabpanel" aria-labelledby="auctions-tab">
        Penis2
      </div>
      <div class="tab-pane fade" id="reports" role="tabpanel" aria-labelledby="reports-tab">
        Penis3
      </div>
    </div>
  </div>
  <div class="col-3"></div>
</div>



<?php include_once 'footer.php' ?>
