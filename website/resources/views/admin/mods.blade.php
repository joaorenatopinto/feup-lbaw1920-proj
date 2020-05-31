@extends('admin.layout')

@section('adminContent')

<div>
    <div class="">
      <div>
        <div class="card mx-auto">
          <div class="row no-gutters">
            <img class="card-img col-md-5" src="img/Harley-Davidson-FXDR-114_Fernando-M-1.jpg" alt="Card image cap">
            <div class="card-body col-md-7 p-3">
              <h5 class="card-title float-right text-success">OnGOING </h5>
              <h5 class="card-title">Harley Davidson</h5>
              <p class="card-text">2008, 1600cc, 6vel, many extras and in immaculate condition. Recent overhaul and new tires.</p>
              <p class="card-text">00d 22h 25m 17s left</p>
              <p class="card-text text-primary">Changed Category from: Phones to Motorcycles by <a href="userprofile.php">Kid Cages</a>, On: 23/03/2020</p>
              <a href="#" class="btn btn-primary"> UNDO CHANGE</a>
            </div>
          </div>
        </div>
        <div class="card mx-auto">
          <div class="row no-gutters">
            <img class="card-img col-md-5" src="img/yamaha.jpg" alt="Card image cap">
            <div class="card-body col-md-7 p-3">
              <h5 class="card-title float-right text-danger">REMOVED </h5>
              <h5 class="card-title">Yamaha R10M</h5>
              <p class="card-text">2018, 1600cc, 5vel, many extras and new tires. Recent overhaul.</p>
              <p class="card-text">10d 20h 35m 12s left</p>
              <p class="card-text text-primary">Removed by <a href="userprofile.php">Kid Cages</a>, On: 22/03/2020</p>
              <a href="#" class="btn btn-primary">UNDO REMOVE</a>
            </div>
          </div>
        </div>
        <div class="card mx-auto">
          <div class="d-flex justify-content-end">
            <img class="d-none d-sm-block card-img-left rounded-circle my-auto p-3" src="img/cages.png" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Joao Samuel</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <p class="card-text">-User Registered on: 13/3/17</p>
              <p class="card-text"> -Status: Active</p>
              <p class="card-text-primary ">Suggestion by: <a href="userprofile.php">Kid Cages</a>, On 22/03/2020</p>
              <a href="#" class="btn btn-primary">Accept Suggestion</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection