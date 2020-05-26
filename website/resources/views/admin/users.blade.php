@extends('admin.layout')

@section('adminContent')

<div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="users-tab">
    @each('partials.userAdminCard', $users, 'user')
    {{ $users->links() }}
</div>

@endsection