@extends('admin.layout')

@section('adminContent')

<div>
  @each('admin.partials.auctionCard', $auctions, 'auction')
  {{$auctions->links()}}
</div>

@endsection