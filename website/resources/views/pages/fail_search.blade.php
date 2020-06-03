@extends('layouts.app')

@section('content')

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active "><a href="#">Search</a></li>
        </ol>
    </nav>

    <div class="d-flex justify-content-center" id="search_auctions">
      <div class="mt-5">
          NO AUCTIONS FOUND
      </div>
    </div>
</div>
@endsection
