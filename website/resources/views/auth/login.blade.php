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
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="username">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="password">
					</div>
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
					Don't have an account? &nbsp<a href="/register">Sign Up</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
