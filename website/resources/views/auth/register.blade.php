@extends('layouts.app')

@section('content')
<div class="container mt-5">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign Up</h3>
			</div>
    <div class="card-body" action="{{ route('register') }}">
				<form method="POST" a>
					<div class="input-group form-group d-flex">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-signature"></i></span>
						</div>
            <input type="text" class="form-control mr-3" placeholder="First Name">
            <input type="text" class="form-control" placeholder="Last Name">
          </div>

          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            </div>
            <input type="text" class="form-control" placeholder="Email">
          </div>

          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input type="text" class="form-control" placeholder="Username">
          </div>

          <div class="input-group form-group d-flex">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            <input type="text" class="form-control mr-3" placeholder="Password">
            <input type="text" class="form-control" placeholder="Confirm Password">
          </div>

          <div class="form-check form-group">
            <input class="form-check-input align-middle" type="checkbox" value="" id="defaultCheck1">
            <label class="form-check-label" for="defaultCheck1">
             I have read and accept the <a href="#"> Terms and Conditions</a>
            </label>
          </div>

					<div class="form-group d-flex p-2 bd-highlight ">
						<input type="submit" value="Sign Up" class="btn btn-outline-info flex-grow-1">
          </div>

          <div class="px-2">
            <button class="btn btn-block btn-outline-danger">
              <i class="fab fa-google"></i> Sign up with Google
            </button>
          </div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Already have an account?&nbsp<a href="{{ route('login') }}">Login</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
