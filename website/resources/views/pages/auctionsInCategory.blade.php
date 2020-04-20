@extends('layouts.app')

@section('content')

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active "><a href="#">Categories</a></li>
            <li class="breadcrumb-item active" aria-current="page">Motorcycles</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-center">
        <div>
            @foreach($auctions as $auction)
            <div class="card mx-auto m-3">
                <div class="row no-gutters">
                    <!--"{{ $auction->getImage()->path }}"-->
                    <img class="card-img col-md-5" src="/img/yamaha.jpg" alt="Card image cap">
                    <div class="card-body col-md-7 p-3">
                        <h5 class="card-title">  {{ $auction->title }} </h5>
                        <p class="card-text"> {{ $auction->description }}</p>
                        <p class="card-text"> {{ $auction->closedate }} </p>
                        <h3><a href="{{route('auction', [$id = $auction->id])}}" class="btn btn-primary" style="width: 10rem;">BID NOW</a> <span
                                class="badge">{{ $auction->getHighestBid() }}€</span></h3>
                    </div>
                </div>
            </div>
            @endforeach
            {{ $auctions->links() }}    
        </div>
        
    </div>
</div>
@endsection