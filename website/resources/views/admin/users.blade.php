@extends('admin.layout')

@section('adminContent')

<div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="users-tab">
    @each('admin.partials.userAdminCard', $users, 'user')
    {{ $users->links() }}
</div>

@endsection