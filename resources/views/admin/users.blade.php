@extends('admin.layout')

@section('adminContent')
<form action="" method="get" class="form-inline my-lg-3 my-3">
    <input class="form-control border border-primary mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="username">
    {{ csrf_field() }}
</form>
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
