@extends('layouts.app')

@section('content')
<script type="text/javascript" src={{ asset('js/category.js') }} defer> </script>
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active "><a href="#">Categories</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{  App\Category::find($id)->name }}</li>
        </ol>
    </nav>

<div class="d-flex justify-content-center" id="category_auctions" data-id="{{ $id }}">
        <div id="auction_cards">
            @each('partials.auctionCard', $auctions, 'auction')
            {{ $auctions->links() }}    
        </div>
    </div>
</div>
@endsection