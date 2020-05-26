<div class="card mx-auto m-3">
    <div class="row no-gutters">
        <img class="card-img col-md-5" src="{{App\Image::where('auction_id',$auction->id)->first()->path}}" alt="Card image cap">
        <div class="card-body col-md-7 p-3">
            <h5 class="card-title">  {{ $auction->title }} </h5>
            <p class="card-text"> {{ $auction->description }}</p>
            <p class="card-text"> {{ $auction->closedate }} </p>
            <h3><a href="{{route('auction', [$id = $auction->id])}}" class="btn btn-primary" style="width: 10rem;">BID NOW</a> <span
                    class="badge">{{ $auction->getHighestBid() }}€</span></h3>
        </div>
    </div>
</div>