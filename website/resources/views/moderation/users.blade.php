@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-dark text-center">
                        <th scope="col" class="align-middle">Username</th>
                        <th scope="col" class="align-middle">Name</a></th>
                        <th scope="col" class="align-middle">Email</th>
                        <th scope="col" class="align-middle">Status</th>
                        <th scope="col" class="align-middle">Actions</th>
                    </thead>
                    
                    <tbody class="text-center">
                        @each('moderation.partials.userRow', $users, 'user')
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection