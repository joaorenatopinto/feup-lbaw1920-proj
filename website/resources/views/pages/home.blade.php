    @extends('layouts.app')

@section('content')
<link href="{{ asset('css/name.css') }}" rel="stylesheet">

<div class="container">
  <div id="center" class="d-flex p-3 bd-highlight justify-content-center">
    <!-- Featured Auctions Carousel -->
    <div id="featuredAuctions" class="carousel slide w-100 " data-ride="carousel" style="height: 10%; width: 100%">
      <ol class="carousel-indicators">
        <li data-target="#featuredAuctions" data-slide-to="0" class="active"></li>
        <li data-target="#featuredAuctions" data-slide-to="1"></li>
        <li data-target="#featuredAuctions" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <a href="auction/{{$featured->first()->id}}">
            <img class="d-block w-100 img-rounded img-fluid h-75" src="{{$featured->first()->getImage()->path}}" alt="First slide">
          </a>
          <div class="black-overlay"></div>
          <div class="carousel-caption d-none d-md-block">
            <h5 class="text-light">{{ $featured->first()->title }}</h5>
            <p>{{ $featured->first()->getHighestBid() }}€</p>
          </div>
        </div>
        <div class="carousel-item">
          <a href="auction/{{$featured->skip(1)->first()->id}}">
            <img class="d-block w-100 img-rounded img-fluid h-75" src="{{$featured->skip(1)->first()->getImage()->path}}" alt="Second slide">
          </a>
          <div class="black-overlay"></div>
          <div class="carousel-caption d-none d-md-block">
            <h5 class="text-light">{{ $featured->skip(1)->first()->title }}</h5>
            <p>{{ $featured->skip(1)->first()->getHighestBid() }}€</p>
          </div>
        </div>
        <div class="carousel-item">
          <a href="auction/{{$featured->skip(2)->first()->id}}">
            <img class="d-block w-100 img-fluid h-75" src="{{$featured->skip(2)->first()->getImage()->path}}" alt="Third slide">
          </a>
          <div class="black-overlay"></div>
          <div class="carousel-caption d-none d-md-block">
            <h5 class="text-light">{{ $featured->skip(2)->first()->title }}</h5>
            <p>{{ $featured->skip(2)->first()->getHighestBid() }}€</p>
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
  <div class="d-flex p-2 bd-highlight justify-content-center">
    <div class="container w-100 m-3">
      <div class="row">
        @foreach ($categories->chunk(4) as $chunk)
          @foreach ($chunk as $category)
            <div class="col m-2">
              <a href="{{route('category', [$id = $category->id])}}">
              <img class="d-block img-rounded img-fluid" src="img/{{$category->name}}.png" alt="Category {{$category->name}}"></a></div>
          @endforeach
          <div class="w-100"></div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection
