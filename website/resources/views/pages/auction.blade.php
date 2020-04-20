@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row text-center pt-4">
        <h3 class="col-sm">Harley Davidson</h3>
    </div>
    <div class="row">
        <div class="col-sm">
            <div class="text-start">{{$auction->description}}</div>
            <div class="text-center m-3">
                <h6 class="align-middle">Auction by <a href="userprofile.php">Kid Cages</a></h6>
            </div>
        </div>
        <div class="col-sm card text-center p-0">
            <div class="card-header">
                <h4>2000.34€</h4>
            </div>
            <h6 class="mt-3 card-title">Quick Bid</h5>
            <div class="input-group d-flex justify-content-around">
                <button type="button" class="btn btn-outline-danger">2250.00€</button>
                <button type="button" class="btn btn-outline-danger">2350.00€</button>
                <button type="button" class="btn btn-outline-danger">2450.00€</button>
            </div>
            <div class="input-group mt-3">
                <input type="number" class="form-control" placeholder="Place your Bid">
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger px-5">Bid <i class="fas fa-coins"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-sm text-center">
            <h3>00d 22h 25m 17s</h3>
        </div>
    </div>
</div>

@endsection