@extends('layouts.app')

@section('content')
<link href="{{ asset('css/name.css') }}" rel="stylesheet">

<div class="container">
  <div id="center" class="d-flex p-3 bd-highlight justify-content-center">
    <!-- Featured Auctions Carousel -->
    <div id="featuredAuctions" class="carousel slide w-100 " data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#featuredAuctions" data-slide-to="0" class="active"></li>
        <li data-target="#featuredAuctions" data-slide-to="1"></li>
        <li data-target="#featuredAuctions" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <a href="auction.php">
            <img class="d-block w-100 img-rounded img-fluid" src="img/Harley-Davidson-FXDR-114_Fernando-M-1.jpg"
              alt="First slide">
          </a>
          <div class="black-overlay"></div>
          <div class="carousel-caption d-none d-md-block">
            <h5 class="text-light">Harley Davidson</h5>
            <p>2000.34€</p>
          </div>
        </div>
        <div class="carousel-item">
          <img class="d-block w-100 img-rounded img-fluid" src="img/naom_5dd790964de6c.jpg" alt="Second slide">
          <div class="black-overlay"></div>
          <div class="carousel-caption d-none d-md-block">
            <h5 class="text-light">Tesla</h5>
            <p>3000.00€</p>
          </div>
        </div>
        <div class="carousel-item">
          <img class="d-block w-100 img-fluid" src="img/11154232_xxl_v1557372653930.jpg" alt="Third slide">
          <div class="black-overlay"></div>
          <div class="carousel-caption d-none d-md-block">
            <h5 class="text-light">Rolex</h5>
            <p>300.00€</p>
          </div>
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

  <!-- Categories -->
  <!-- 
  <div class="d-flex p-2 bd-highlight justify-content-center">
    <div class="container w-100 m-3">
      <div class="row">
        <div class="col m-2"><a href="{{route('category', [$id = 2])}}"><img class="d-block w-100 img-rounded img-fluid"
              src="img/motos.png" alt="Category Motos"></a></div>
        <div class="col m-2"><a href="{{route('category', [$id = 1])}}"><img class="d-block w-100 img-rounded img-fluid"
              src="img/cars.png" alt="Category Cars"></a></div>
        <div class="w-100"></div>
        <div class="col m-2"><a href="{{route('category', [$id = 5])}}"><img class="d-block w-100 img-rounded img-fluid"
              src="img/antiques.png" alt="Category antiques"></a></div>
        <div class="col m-2"><a href="{{route('category', [$id = 4])}}"><img class="d-block w-100 img-rounded img-fluid"
              src="img/computers.png" alt="Category Computers"></a></div>
      </div>
    </div>  
  </div>
   -->

  <div class="d-flex p-2 bd-highlight justify-content-center">
    <div class="container w-100 m-3">
      <div class="row">
        @each('partials.categoryCard', $categories, 'category')
<!-- 
        <div class="col m-2"><a href="{{route('category', [$id = 2])}}"><img class="d-block w-100 img-rounded img-fluid"
              src="img/motos.png" alt="Category Motos"></a></div>
        <div class="col m-2"><a href="{{route('category', [$id = 1])}}"><img class="d-block w-100 img-rounded img-fluid"
              src="img/cars.png" alt="Category Cars"></a></div>
        <div class="w-100"></div>
        <div class="col m-2"><a href="{{route('category', [$id = 5])}}"><img class="d-block w-100 img-rounded img-fluid"
              src="img/antiques.png" alt="Category antiques"></a></div>
        <div class="col m-2"><a href="{{route('category', [$id = 4])}}"><img class="d-block w-100 img-rounded img-fluid"
              src="img/computers.png" alt="Category Computers"></a></div>
 -->
      </div>
    </div>
  </div>
</div>
@endsection