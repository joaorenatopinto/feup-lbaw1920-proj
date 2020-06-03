@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Notifications</li>
        </ol>
    </nav>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="thead-dark text-center">
                <th scope="col">#</th>
                <th scope="col">Title</a></th>
                <th scope="col">Date</th>
                <th scope="col">Description</th>
            </thead>
            
            <tbody class="text-center">
                @each('partials.notification', Auth::user()->notifications(), 'notification')
            </tbody>
        </table>
        {{ Auth::user()->notifications()->links() }}
    </div>
</div>
@endsection