@extends('layouts.app')

@section('content')
<div class="container mt-5">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Edit Profile</h3>
			</div>
            <div class="card-body">
                <form method="POST" action="{{ route('editProfile') }}">
                    {{ csrf_field() }}
                    <div class="input-group form-group d-flex">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-signature"></i></span>
                        </div>
                        <label for="name">
                            First Name
                            <input type="text" class="form-control mr-3" placeholder="First Name" value="{{ Auth::user()->name }}" id="name" name="name" required>
                        </label>
                        <label for="lastName">
                            Last Name
                            <input type="text" class="form-control" placeholder="Last Name" name="lastName">
                        </label>
                    </div>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <label for="email">
                            Email
                            <input type="text" class="form-control" placeholder="Email" value="{{ Auth::user()->email }}" id="email" name="email" required>
                        </label>
                    </div>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <label for="username">
                            Username
                            <input type="text" class="form-control" placeholder="Username" value="{{ Auth::user()->username }}" id="username" name="username" required>
                        </label>
                    </div>
                    @error('username')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @if(Auth::user()->description == null)
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-font"></i></span>
						</div>
                        <textarea class="form-control" placeholder="Description" id="description" name="description"></textarea>
                    </div>
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @else
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-font"></i></span>
						</div>
                        <label for="description">
                            Description
                            <textarea class="form-control" placeholder="Description" id="description" name="description">{{ Auth::user()->description }}</textarea>
                        </label>
                    </div>
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    @endif
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Profile Picture</label>
                        </div>
                        @error('customFile')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group d-flex p-2 bd-highlight ">
                    <input type="submit" value="Submit" class="btn btn-dark flex-grow-1">
                </div>
            </form>
        </div>
	</div>
</div>
@endsection
