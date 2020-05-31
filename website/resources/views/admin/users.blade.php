@extends('admin.layout')

@section('adminContent')

<div>
    @each('admin.partials.userCard', $users, 'user')
    {{ $users->links() }}
</div>

@endsection