<?php include_once 'header.php' ?>

<div class="container">
    <div class="row text-center pt-4">
        <h3 class="col-sm">Harley Davidson</h3>
    </div>
    <div class="row">
        <div class="d-flex p-3 justify-content-center min-vh-25 col-sm">
            <!-- Images carousel -->
            <div id="featuredAuctions" class="carousel slide w-100" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#featuredAuctions" data-slide-to="0" class="active"></li>
                    <li data-target="#featuredAuctions" data-slide-to="1"></li>
                    <li data-target="#featuredAuctions" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100 img-rounded img-fluid"
                            src="/img/Harley-Davidson-FXDR-114_Fernando-M-1.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100 img-rounded img-fluid" src="/img/harley1.png" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100 img-fluid" src="/img/harley2.png" alt="Third slide">
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
    </div>
    <div class="row">
        <div class="col-sm">
            <div class="text-start">
                A harley davidson motorbike. Never used so it's in a perfect condition. There are only 5 like this one
                in the world.
                I bought it for my father be he had an accident before he could ever ride it. I do not own an license to
                drive bikes
                so I'm deciding to sell it to someone who can give it some good use.
            </div>
            <div class="text-center m-3">
                <h6 class="align-middle">Auction by <a href="userprofile.php">Kid Cages</a></h6>
            </div>
        </div>
        <div class="col-sm text-center">
            <h4>2000.34€</h4>
            <h5>Quick Bid</h5>
            <div class="row justify-content-center">
                <button type="button" class="btn btn-danger mx-1 my-1 mh-25 ">2250.00€</button>
                <button type="button" class="btn btn-danger mx-1 my-1 mh-25 ">2250.00€</button>
                <button type="button" class="btn btn-danger mx-1 my-1 mh-25 ">2250.00€</button>
            </div>
            <div class="input-group form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-eur" aria-hidden="true"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Place your Bid">
                <button type="button" class="btn btn-danger">Bid <i class="fas fa-coins"></i></button>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-sm text-center">
            <h3>00d 22h 25m 17s</h3>
        </div>
    </div>
</div>


<?php include_once 'footer.php' ?>