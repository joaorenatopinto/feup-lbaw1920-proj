@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Image -->
    <div class="card my-4">
        <div class="center mt-5">
            <div class="text-center"><img src="img/cages.png" class="rounded-circle img-fluid" alt="..."></div>
        </div>

        <div class="pt-3 text-center">
            <a class="text-info" href="#">Edit Profile</a>
        </div>

        <!-- Rating / Name / Age / Desc / Contact -->
        <div class="d-flex justify-content-center mt-3 mb-5">
            <div class="container mt-4 mx-auto">
                <div class="center row">
                    <div class="text-center col">
                        <div>
                            <h5>Kid "Colher" Cages</h5>
                        </div>
                    </div>
                    <div class="w-100"></div>
                    <div class="text-center col">
                        <div>20 years old</div>
                    </div>
                </div>
                <div class="center row mt-1">
                    <div class="text-center col">
                        <img src="img/stars.png" class="img-fluid" alt="...">
                    </div>
                </div>
                <div class="center row mt-4">
                    <div class="text-center col-sm-4">
                    </div>
                    <div class="text-center col-sm-4">
                        <div>Newbie seller. Still learning the craft. Most interested in muscle cars and antique
                            watches.</div>
                    </div>
                    <div class="text-center col-sm-4">
                    </div>
                </div>
                <div class="center row mt-4">
                    <div class="text-center col">
                        <div>kidcages@gmail.com</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="container">
        <div class="row">
            <div class="col">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="auctions-tab" data-toggle="tab" href="#auctions" role="tab"
                            aria-controls="auctions" aria-selected="true">Active Auctions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="closed-auctions-tab" data-toggle="tab" href="#closed-auctions"
                            role="tab" aria-controls="closed-auctions" aria-selected="false">Closed Auctions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="money-tab" data-toggle="tab" href="#money" role="tab"
                            aria-controls="money" aria-selected="false">Money Transfers</a>
                    </li>
                </ul>
                <div class="tab-content mt-4" id="myTabContent">
                    <div class="tab-pane fade show active" id="auctions" role="tabpanel" aria-labelledby="auctions-tab">
                        <div class="card m-3 mx-auto">
                            <div class="row no-gutters">
                                <img class="card-img col-md-5" src="img/Harley-Davidson-FXDR-114_Fernando-M-1.jpg"
                                    alt="Card image cap">
                                <div class="card-body col-md-7 p-3">
                                    <h5 class="card-title">Harley Davidson</h5>
                                    <p class="card-text">2008, 1600cc, 6vel, many extras and in immaculate condition.
                                        Recent overhaul and new tires.</p>
                                    <p class="card-text">00d 22h 25m 17s left</p>
                                    <h3><a href="auction.php" class="btn btn-primary" style="width: 10rem;">GOTO
                                            PAGE</a><span class="badge">1337.69€</span></h3>
                                </div>
                            </div>
                        </div>
                        <div class="card m-3 mx-auto">
                            <div class="row no-gutters">
                                <img class="card-img col-md-5" src="img/yamaha.jpg" alt="Card image cap">
                                <div class="card-body col-md-7 p-3">
                                    <h5 class="card-title">Yamaha R10M</h5>
                                    <p class="card-text">2018, 1600cc, 5vel, many extras and new tires. Recent overhaul.
                                    </p>
                                    <p class="card-text">10d 20h 35m 12s left</p>
                                    <h3><a href="auction.php" class="btn btn-primary" style="width: 10rem;">GOTO
                                            PAGE</a> <span class="badge">1337.69€</span></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="closed-auctions" role="tabpanel"
                        aria-labelledby="closed-auctions-tab">
                        <div class="card m-3 mx-auto">
                            <div class="row no-gutters">
                                <img class="card-img col-md-5" src="img/Harley-Davidson-FXDR-114_Fernando-M-1.jpg"
                                    alt="Card image cap">
                                <div class="card-body col-md-7 p-3">
                                    <h5 class="card-title">Harley Davidson</h5>
                                    <p class="card-text">2008, 1600cc, 6vel, many extras and in immaculate condition.
                                        Recent overhaul and new tires.</p>
                                    <h3>SOLD FOR 1337.69€</h3>
                                    <h4>On 13-6-2019</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card m-3 mx-auto">
                            <div class="row no-gutters">
                                <img class="card-img col-md-5" src="img/yamaha.jpg" alt="Card image cap">
                                <div class="card-body col-md-7 p-3">
                                    <h5 class="card-title">Yamaha R10M</h5>
                                    <p class="card-text">2018, 1600cc, 5vel, many extras and new tires. Recent overhaul.
                                    </p>
                                    <h3>SOLD FOR 1337.69€</h3>
                                    <h4>On 13-6-2019</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card m-3 mx-auto">
                            <div class="row no-gutters">
                                <img class="card-img col-md-5" src="img/yamaha.jpg" alt="Card image cap">
                                <div class="card-body col-md-7 p-3">
                                    <h5 class="card-title">Yamaha R10M</h5>
                                    <p class="card-text">2018, 1600cc, 5vel, many extras and new tires. Recent overhaul.
                                    </p>
                                    <h3>SOLD FOR 1337.69€</h3>
                                    <h4>On 13-6-2019</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card m-3 mx-auto">
                            <div class="row no-gutters">
                                <img class="card-img col-md-5" src="img/yamaha.jpg" alt="Card image cap">
                                <div class="card-body col-md-7 p-3">
                                    <h5 class="card-title">Yamaha R10M</h5>
                                    <p class="card-text">2018, 1600cc, 5vel, many extras and new tires. Recent overhaul.
                                    </p>
                                    <h3>SOLD FOR 1337.69€</h3>
                                    <h4>On 13-6-2019</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card m-3 mx-auto">
                            <div class="row no-gutters">
                                <img class="card-img col-md-5" src="img/yamaha.jpg" alt="Card image cap">
                                <div class="card-body col-md-7 p-3">
                                    <h5 class="card-title">Yamaha R10M</h5>
                                    <p class="card-text">2018, 1600cc, 5vel, many extras and new tires. Recent overhaul.
                                    </p>
                                    <h3>SOLD FOR 1337.69€</h3>
                                    <h4>On 13-6-2019</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="money" role="tabpanel" aria-labelledby="money-tab">
                        <div class="card m-3 mx-auto">
                            <div class="row no-gutters">
                                <img class="card-img col-md-5" src="img/yamaha.jpg" alt="Card image cap">
                                <div class="card-body col-md-7 p-3">
                                    <h5 class="card-title"><b>Sold</b> Yamaha R10M</h5>
                                    <h3><span class="badge">200.00€</span></h3>
                                    <h3><span class="badge">02-02-2019</span></h3>
                                    <div class="d-flex align-items-end flex-column" style="height: 200px;">
                                        <div class="mt-auto p-2">
                                            <h1><span class="badge badge-success">+ 200.00€</span></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card m-3 mx-auto">
                            <div class="row no-gutters">
                                <img class="card-img col-md-5" src="img/yamaha.jpg" alt="Card image cap">
                                <div class="card-body col-md-7 p-3">
                                    <h5 class="card-title"><b>Bought</b> This website</h5>
                                    <h3><span class="badge">300.00€</span></h3>
                                    <h3><span class="badge">03-02-2019</span></h3>
                                    <div class="d-flex align-items-end flex-column" style="height: 200px;">
                                        <div class="mt-auto p-2">
                                            <h1><span class="badge badge-danger">- 300.00€</span></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection