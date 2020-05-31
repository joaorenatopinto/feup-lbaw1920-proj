<div class="card mx-auto">
    <div class="row no-gutters">
    <img class="card-img col-md-5" src="{{$auction->getImage()->path}}" alt="{{$auction->getImage()->alt}}">
      <div class="card-body col-md-7 p-3">

        @if($auction->getLastStatus()->status === 'ongoing')
          <h5 class="card-title float-right text-success">{{$auction->getLastStatus()->status}} </h5>
        @elseif($auction->getLastStatus()->status === 'removed' || $auction->getLastStatus()->status === 'closed')
          <h5 class="card-title float-right text-danger">{{$auction->getLastStatus()->status}} </h5>
        @else 
          <h5 class="card-title float-right text-danger">INVALID STATUS</h5>
        @endif

        <h5 class="card-title">{{ $auction->title }}</h5>
        <p class="card-text">{{ $auction->description }}</p>
        <p class="card-text">{{ $auction->timeLeft() }} remaining</p>
        <a href="{{route('auction',[$id = $auction->id])}}" class="btn btn-primary">VIEW</a>
        <a href="#" class="btn btn-primary">REMOVE</a>
      </div>
    </div>
</div>