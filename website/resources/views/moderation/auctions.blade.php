@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col">
            <form action="" method="get" class="form-inline my-lg-3 my-3">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="auction">
                {{ csrf_field() }}
            </form>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-dark text-center">
                        <th scope="col" class="align-middle">#</th>
                        <th scope="col" class="align-middle">Title</a></th>
                        <th scope="col" class="align-middle">Owner</a></th>
                        <th scope="col" class="align-middle">Starting Date</th>
                        <th scope="col" class="align-middle">Closing Date</th>
                        <th scope="col" class="align-middle">Current Bid</th>
                        <th scope="col" class="align-middle">Category</th>
                        <th scope="col" class="align-middle">Status</a></th>
                        <th scope="col" class="align-middle">Actions</th>
                    </thead>

                    <tbody class="text-center">
                        @each('moderation.partials.auctionRow', $auctions, 'auction')
                    </tbody>
                </table>
                {{ $auctions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
