@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="users-tab" data-toggle="tab" href="#users" role="tab" aria-controls="users" aria-selected="true">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="auctions-tab" data-toggle="tab" href="#auctions" role="tab" aria-controls="auctions" aria-selected="false">Auctions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="modActions-tab" data-toggle="tab" href="#modActions" role="tab" aria-controls="modActions" aria-selected="false">Mod Actions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="statistics-tab" data-toggle="tab" href="#statistics" role="tab" aria-controls="statistics" aria-selected="false">Statistics</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="categories-tab" data-toggle="tab" href="#categories" role="tab" aria-controls="categories" aria-selected="false">Categories</a>
        </li>
      </ul>
      <div class="tab-content mt-4" id="myTabContent">
        @yield('adminContent')
      </div>
    </div>
  </div>
</div>
@endsection