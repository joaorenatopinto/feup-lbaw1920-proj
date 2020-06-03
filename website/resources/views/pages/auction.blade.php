@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row text-center pt-4 mt-3 mb-5">
        <h3 class="col-sm">
            <div class="text-muted">
                {{App\Category::Where('id',$auction->category_id)->first()->name}}/
              </div>
            {{$auction->title}}
        </h3>
    </div>
    <div class="row justify-content-between">
        <div class="col-sm-7 ">
            <img class="card-img center" src="{{App\Image::where('auction_id',$auction->id)->first()->path}}"
                alt="Card image cap">
        </div>

        <div class="col-sm-4 ">
            <h4 class="text-center">Seller</h4>
            <a href="{{ route('profile',['id' => $auction->user->id ]) }}">
                <div class="col text-center">
                    <img src="{{ $auction->user->getImage()->path }}" class="rounded-circle mx-auto img-thumbnail w-25">
                </div>
                <h6 class="align-middle text-center">
                    {{$auction->user->name}}
            </a>
            </h6>

            @if(App\AuctionStatus::where('auction_id',$auction->id)->orderBy('id','desc')->first()->status == 'ongoing')
            <div class="col-sm card p-0 text-left">
                <div class="card-header">
                    <h4>Current Bid: {{$auction->getHighestBid()}}€</h4>
                </div>
                <h6 class="mt-3 card-title text-center ">Quick Bid</h6>
                <div class="input-group d-flex justify-content-around">
                    <button id="bid1" type="button"
                        class="btn btn-outline-danger">{{$auction->getHighestBid()+150}}€</button>
                    <button id="bid2" type="button"
                        class="btn btn-outline-danger">{{$auction->getHighestBid()+300}}€</button>
                    <button id="bid3" type="button"
                        class="btn btn-outline-danger">{{$auction->getHighestBid()+450}}€</button>
                </div>
                <form action="{{$auction->id}}/bid" method="post">
                    {{ csrf_field() }}
                    <div class="container mt-3">
                        <div class="row justify-content-between">
                            <div class="col-sm-8">
                                <input type="number" id="value" name="value" class="form-control"
                                    placeholder="Place your Bid" min="{{$auction->getHighestBid()+1}}" max="{{ Auth::user()->balance }}" required>
                            </div>
                            @error('value')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <div class="col-sm-4">
                                <button id="bid4" type="submit" class="btn btn-danger btn-block">Bid <i
                                        class="fas fa-coins"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row text-center mt-2">
                    <div id=demo class="col-sm font-weight-bold">

                    </div>
                </div>
                <script>
                    // Set the date we're counting down to
                    var countDownDate = new Date("{{$auction->closedate}}").getTime();

                    // Update the count down every 1 second
                    var x = setInterval(function () {

                        // Get today's date and time
                        var now = new Date().getTime();

                        // Find the distance between now and the count down date
                        var distance = countDownDate - now;

                        // Time calculations for days, hours, minutes and seconds
                        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                        // Display the result in the element with id="demo"
                        document.getElementById("demo").innerHTML = "ENDS IN: " + days + "d " + hours +
                            "h " +
                            minutes + "m " + seconds + "s ";

                        // If the count down is finished, write some text
                        if (distance < 0) {
                            clearInterval(x);
                            document.getElementById("demo").innerHTML = "EXPIRED";
                        }
                    }, 1000);
                </script>
            </div>
            @endif
            @if(App\AuctionStatus::where('auction_id',$auction->id)->orderBy('id','desc')->first()->status == 'closed')
            <div class="col-sm card p-0 text-left">
                <div class="card-header">
                    <h4>Winning Bid: {{$auction->getHighestBid()}}€</h4>
                </div>
                <h4 class="text-center">Winner</h4>
                <a href="{{ route('profile',['id' => $auction->user->id ]) }}">
                    <div class="col text-center">
                        <img src="{{ $auction->getWinner()->getWinner()->getImage()->path }}"
                            class="rounded-circle mx-auto img-thumbnail w-25">
                    </div>
                    <h6 class="align-middle text-center">
                        {{$auction->getWinner()->getWinner()->name}}
                </a>
                </h6>

            </div>

            @endif
            <div class="col text-right mt-2">
                @if(Auth::user() != $auction->user &&
                App\AuctionStatus::where('auction_id',$auction->id)->orderBy('id','desc')->first()->status == 'ongoing')

                <a id="report" class="btn-sm btn-danger" href="{{ route('reportAuction',['id' => $auction->id ]) }}"
                    role="button">Report</a>
                @endif
            </div>
        </div>

    </div>

    <div class="row justify-content-between">
        <div class="col-sm-7">
            <div class=" mt-3 mx-0 text-start h5 p-0">{{$auction->description}}</div>
        </div>
        <div class="row">
            <div class="col mx-auto">


            </div>
        </div>
    </div>


    @if(Auth::user() == $auction->user)
    <script>
        document.getElementById("bid1").disabled = true;
        document.getElementById("bid2").disabled = true;
        document.getElementById("bid3").disabled = true;
        document.getElementById("bid4").disabled = true;
        document.getElementById("report").disabled = true;
    </script>
    @endif
</div>




@endsection