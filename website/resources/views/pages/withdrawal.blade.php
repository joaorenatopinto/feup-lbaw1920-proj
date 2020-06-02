@extends('layouts.app')

@section('content')
<div class="container mt-5">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Withdraw</h3>
			</div>
            <div class="card-body">
                <form method="POST" action="{{ route('withdrawal') }}">
                    {{ csrf_field() }}
                    <div class="input-group form-group d-flex">
                        <input  type="number" class="form-control mr-3" placeholder="Money to Withdraw" value="{{ Auth::user()->name }}" name = "money" min="1" max="{{ Auth::user()->balance }}" required>
                    </div>
                    @error('money')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group d-flex p-2 bd-highlight ">
                        <input type="submit" value="Withdraw" class="btn btn-dark flex-grow-1">
                    </div>
                </form>
            </div>
    
        </div>
	</div>
</div>
@endsection