@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="thead-dark text-center">
                <th scope="col">#</th>
                <th scope="col">Date</a></th>
                <th scope="col">Value</th>
                <th scope="col">Description</th>
            </thead>
            
            <tbody class="text-center">
                @each('partials.transaction', Auth::user()->transactions(), 'transaction')
            </tbody>
        </table>
    </div>
</div>
@endsection