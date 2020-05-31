@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col">
      <div class="tab-content mt-4" id="myTabContent">
        @yield('adminContent')
      </div>
    </div>
  </div>
</div>
@endsection