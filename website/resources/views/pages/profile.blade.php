@extends('layouts.app')

@section('content')
<div class="container">
  <!-- Image -->
  <div class="card my-4">
    <div class="center mt-5">
    <div class="text-center"><img src="{{ asset('img/cages.png') }}" class="rounded-circle img-fluid" alt="..."></div>
    </div>

    @if ($user->id === Auth::id())
    <div class="pt-3 text-center">
    <a class="text-info" href="{{ route('editProfilePage',['id' => Auth::id()]) }}">Edit Profile</a>
    </div>
    @endif

    <!-- Rating / Name / Age / Desc / Contact -->
    <div class="d-flex justify-content-center mt-5 mb-5">
      <div class="container mt-4 mx-auto">
        <div class="center row">
          <div class="text-center col">
          <div class="mb-3"><h4>{{$user->name}}</h4></div>
          </div>
          <div class="w-100"></div>
        </div>
        <div class="center row mt-1">
          <div class="text-center col">
            <img src="{{ asset('img/stars.png') }}" class="img-fluid" alt="...">
          </div>
        </div>
        <div class="center row mt-4">
          <div class="text-center col-sm-4">
          </div>
          <div class="text-center col-sm-4">
            @if($user->description == null)
              <div>This user has not provided a description</div>
            @else
              <div>{{ $user->description }}</div>
            @endif
          </div>
          <div class="text-center col-sm-4">
          </div>
        </div>
        <div class="center row mt-4">
          <div class="text-center col">
          <div>{{ $user->email }}</div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <div class="card m-3 mx-auto">
    <div class="row no-gutters">
      <img class="card-img col-md-5" src="img/Harley-Davidson-FXDR-114_Fernando-M-1.jpg" alt="Card image cap">
      <div class="card-body col-md-7 p-3">
        <h5 class="card-title">Harley Davidson</h5>
        <p class="card-text">2008, 1600cc, 6vel, many extras and in immaculate condition. Recent overhaul and new tires.</p>
        <p class="card-text">00d 22h 25m 17s left</p>
        <h3><a href="auction.php" class="btn btn-primary" style="width: 10rem;">BID NOW</a> <span class="badge">1337.69€</span></h3>
      </div>
    </div>
  </div>
  <div class="card m-3 mx-auto">
    <div class="row no-gutters">
      <img class="card-img col-md-5" src="img/yamaha.jpg" alt="Card image cap">
      <div class="card-body col-md-7 p-3">
        <h5 class="card-title">Yamaha R10M</h5>
        <p class="card-text">2018, 1600cc, 5vel, many extras and new tires. Recent overhaul.</p>
        <p class="card-text">10d 20h 35m 12s left</p>
        <h3><a href="auction.php" class="btn btn-primary" style="width: 10rem;">BID NOW</a> <span class="badge">1337.69€</span></h3>
      </div>
    </div>
  </div>
</div>

</div>
@endsection