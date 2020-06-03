@extends('layouts.app')

@section('content')

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active "><a href="#">Search</a></li>
        </ol>
    </nav>

<div class="container">
    <div class="row">
        @each('partials.auctionCard', $auctions, 'auction')
    </div>
    <div class="mt-3" id="pag">
        {{ $auctions->links() }}
    </div>
</div>
@endsection
