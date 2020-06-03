@extends('layouts.app')

@section('content')
<div class="container mt-5">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Report auction</h3>
			</div>
            <div class="card-body">
                <form method="POST" action="{{ route('report',['id' => $auction->id ]) }}">
                    {{ csrf_field() }}
                    <div class="input-group form-group d-flex">
                        <input  type="text" class="form-control mr-3" placeholder="Tell us what's wrong..." name="description" required>
                    </div>
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group d-flex p-2 bd-highlight ">
                        <input type="submit" value="Report" class="btn btn-dark flex-grow-1">
                    </div>
                </form>
            </div>
    
        </div>
	</div>
</div>
@endsection