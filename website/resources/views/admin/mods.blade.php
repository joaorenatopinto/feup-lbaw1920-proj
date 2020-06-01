@extends('admin.layout')

@section('adminContent')

<div class="table-responsive">
    <table class="table table-hover">
        <thead class="thead-dark text-center">
            <th scope="col">Changed</th>
            <th scope="col">Change Type</th>
            <th scope="col">Date Changed</th>
            <th scope="col">Changer</th>
            <th scope="col">Changer Role</th>
            <th scope="col">Status</th>
            <th scope="col">Actions</th>
        </thead>
        
        <tbody class="text-center">
            @each('admin.partials.actionRow', $actions, 'action')
        </tbody>
    </table>
    {{ $actions->links() }}
</div>

@endsection