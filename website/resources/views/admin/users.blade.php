@extends('admin.layout')

@section('adminContent')

<div class="table-responsive">
    <table class="table table-hover">
        <thead class="thead-dark text-center">
            <th scope="col">#</th>
            <th scope="col">Name</a></th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Nif</th>
            <th scope="col">Balance</th>
            <th scope="col">Status</th>
            <th scope="col">Actions</th>
        </thead>
        
        <tbody class="text-center">
            @each('admin.partials.userRow', $users, 'user')
        </tbody>
    </table>
    {{ $users->links() }}
</div>

@endsection