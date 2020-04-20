@extends('layouts.app')

@section('content')
<div class="container mt-5">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign In</h3>
			</div>
			<div class="card-body">
            <form method="POST" action="{{route('login')}}">

                {{ csrf_field() }}

					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="email" class="form-control" placeholder="username" name="email" id="email">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="password" id="password" name="password">
                    </div>
                    
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </label>

					<div class="form-group d-flex p-2 bd-highlight ">
						<input type="submit" value="Login" class="btn btn-outline-info flex-grow-1">
					</div>
						
                    <div class="px-2">
                        <button class="btn btn-block btn-outline-danger">
                            <i class="fab fa-google"></i> Sign In with Google
                        </button>
                    </div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Don't have an account? &nbsp<a href="{{ route('register') }}">Sign Up</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection