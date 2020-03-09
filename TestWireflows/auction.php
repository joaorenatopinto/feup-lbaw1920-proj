<?php include_once 'header.php' ?>

<div id="center" class="d-flex p-3 justify-content-center min-vh-25">
  <!-- Images carousel -->
  <div id="featuredAuctions" class="carousel slide w-50" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#featuredAuctions" data-slide-to="0" class="active"></li>
      <li data-target="#featuredAuctions" data-slide-to="1"></li>
      <li data-target="#featuredAuctions" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100 img-rounded img-fluid" src="img/Harley-Davidson-FXDR-114_Fernando-M-1.jpg" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100 img-rounded img-fluid" src="img/harley1.png" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100 img-fluid" src="img/harley2.png" alt="Third slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#featuredAuctions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#featuredAuctions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>





<?php include_once 'footer.php' ?>