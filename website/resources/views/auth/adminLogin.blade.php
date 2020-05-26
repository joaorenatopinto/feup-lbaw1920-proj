@extends('layouts.app')

@section('content')

<div class="container mt-5">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Administrator Area</h3>
			</div>
			<div class="card-body">
				<form method="POST" action="{{route('adminLogin')}}">
				{{ csrf_field() }}

					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input id="username" type="text" class="form-control" placeholder="admin username" name="username">
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input id="adminPassword" type="password" class="form-control" placeholder="password" name="password">
					</div>
					@error('username')
						<div class="alert alert-danger">{{ $message }}</div>
					@enderror
					@error('password')
						<div class="alert alert-danger">{{ $message }}</div>
					@enderror
					<div class="form-group d-flex p-2 bd-highlight ">
						<input type="submit" value="Administrator Login" class="btn btn-outline-info flex-grow-1">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


@endsection
