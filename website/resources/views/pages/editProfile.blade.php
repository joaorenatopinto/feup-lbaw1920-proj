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
                    <input type="text" class="form-control mr-3" placeholder="First Name" value="{{ Auth::user()->name }}" id="name" name="name">
                        <input type="text" class="form-control" placeholder="Last Name" name="lastName">
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                    <input type="text" class="form-control" placeholder="Email" value="{{ Auth::user()->email }}" id="email" name="email">
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Username" value="{{ Auth::user()->username }}" id="username" name="username">
                    </div>

                    @if(Auth::user()->description == null)
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-font"></i></span>
						</div>
						<textarea class="form-control" placeholder="Description" id="description" name="description"></textarea>
                    </div>
                    @else 
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-font"></i></span>
						</div>
						<textarea class="form-control" placeholder="Description" id="description" name="description">{{ Auth::user()->description }}</textarea>
                    </div>
                    @endif

                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Profile Picture</label>
                        </div>
                    </div>

                </div>

                <div class="form-group d-flex p-2 bd-highlight ">
                    <input type="submit" value="Submit" class="btn btn-outline-info flex-grow-1">
                </div>
            </form>
        </div>
	</div>
</div>
@endsection