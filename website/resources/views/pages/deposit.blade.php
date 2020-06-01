@extends('layouts.app')

@section('content')

<div class="container mt-5">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Deposit</h3>
			</div>
            <div class="card-body">
                <form method="POST" action="{{ route('deposit') }}">
                    {{ csrf_field() }}
                    <div class="input-group form-group d-flex">
                        <input  type="number" class="form-control mr-3" placeholder="Money to deposit" value="{{ Auth::user()->name }}" name = "money" min="1" required>
                    </div>
                    @error('money')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group d-flex p-2 bd-highlight ">
                        <input type="submit" value="Submit" class="btn btn-dark flex-grow-1">
                    </div>
                </form>
            </div>
    
        </div>
	</div>
</div>
@endsection