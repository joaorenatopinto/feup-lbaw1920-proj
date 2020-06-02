@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row text-center pt-4 mt-3 mb-5">
        <h3 class="col-sm">{{$auction->title}}</h3>
    </div>
    <div class="row justify-content-between">
        <div class="col-sm-7 ">
            <img class="card-img center" src="{{App\Image::where('auction_id',$auction->id)->first()->path}}"
                alt="Card image cap">
        </div>

        <div class="col-sm-4 text-center">
            <img src="{{ $auction->user->getImage()->path }}" class="rounded-circle img-thumbnail w-50">
            <h6 class="align-middle text-center">
                <a href="{{ route('profile',['id' => $auction->user->id ]) }}">{{$auction->user->name}}</a>
            </h6>

            <div class="col-sm card text-center p-0">
                <div class="card-header">
                    <h4>{{$auction->getHighestBid()}}€</h4>
                </div>
                <h6 class="mt-3 card-title">Quick Bid</h6>
                <div class="input-group d-flex justify-content-around">
                    <button type="button" class="btn btn-outline-danger">{{$auction->getHighestBid()+150}}€</button>
                    <button type="button" class="btn btn-outline-danger">{{$auction->getHighestBid()+300}}€</button>
                    <button type="button" class="btn btn-outline-danger">{{$auction->getHighestBid()+450}}€</button>
                </div>
                <form action="{{$auction->id}}/bid" method="post">
                    {{ csrf_field() }}
                    <div class="container mt-3">
                        <div class="row justify-content-between">
                            <div class="col-sm-8">
                                <input type="number" id="value" name="value" class="form-control"
                                    placeholder="Place your Bid">
                            </div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-danger btn-block">Bid <i
                                        class="fas fa-coins"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <div class="row justify-content-between">
        <div class="col-sm-7">
            <div class=" mt-3 mx-0 text-start h5 p-0">{{$auction->description}}</div>
        </div>
    </div>

</div>


<div class="row mt-5">
    <div class="col-sm text-center">
        <h3>{{$auction->closedate}}</h3>
    </div>
</div>

<div class="py-3">
    <div class="row">
        <div class="col-sm-2 mx-auto">

            <div class="rounded bg-gradient-1 text-black shadow p-5 text-center mb-5">
                <p class="mb-4 font-weight-bold text-uppercase">Ends in</p>
                <p id="demo"></p>

                <script>
                    // Set the date we're counting down to
                    var countDownDate = new Date("Jan 5, 2021 15:37:25").getTime();

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
                        document.getElementById("demo").innerHTML = days + "d " + hours + "h " +
                            minutes + "m " + seconds + "s ";

                        // If the count down is finished, write some text
                        if (distance < 0) {
                            clearInterval(x);
                            document.getElementById("demo").innerHTML = "EXPIRED";
                        }
                    }, 1000);
                </script>

                <div id="clock-b" class="countdown-circles d-flex flex-wrap justify-content-center pt-4"></div>
            </div>

        </div>

    </div>
</div>


@endsection