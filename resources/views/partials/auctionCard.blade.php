<div class="col-sm-4 p-0 card">
    <img class="card-img-top" src="{{App\Image::where('auction_id',$auction->id)->first()->path}}" height="200" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title">  {{ $auction->title }} </h5>
        <p class="card-text"> {{ $auction->description }}</p>
        <p class="card-text mt-auto"> {{ $auction->closedate }} </p>
        <h3><a href="{{route('auction', [$id = $auction->id])}}" class="btn btn-primary" style="width: 10rem;">BID NOW</a> <span
                    class="badge">{{ $auction->getHighestBid() }}€</span></h3>
    </div>
</div>