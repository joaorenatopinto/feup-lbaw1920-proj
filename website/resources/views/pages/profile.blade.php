@extends('layouts.app')

@section('content')
<div class="container">
  <!-- Image -->
  <div class="card my-4">
    <div class="center mt-5">
    <div class="text-center"><img class="rounded-circle" src="{{asset(App\Image::where('user_id',$user->id)->first()->path)}}"  width="300" height="300"alt="..."></div>
    </div>

    @if ($user->id === Auth::id())
    <div class="pt-3 text-center">
      <a class="text-info" href="{{ route('editPage') }}">Edit Profile</a>
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
  
  @each('partials.auctionCard', $user->auctions, 'auction')

</div>

</div>
@endsection