@extends('layouts.app')

@section('content')

<div class="container mt-5">
	<div class="row justify-content-center">
		<div class="card col-sm-7 col-11">
			<div class="card-header mt-3">
				<h3>New Auction</h3>
			</div>
			<div class="card-body">
                <form method="POST" action="{{ route('auctionCreate') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-font"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="Auction Title" name="title" id="title" required>
					</div>
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-font"></i></span>
						</div>
						<textarea class="form-control" placeholder="Auction Description" name="description" id="description" required></textarea>
					</div>
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" name="image" class="form-control custom-file-input" id="image">
                            <label class="custom-file-label" for="image">Product Pictures</label>
                        </div>
                    </div>
                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <h6 class="card-title mt-5">Auction Configuration</h5>

                    <div class="form-group">
                        <label for="category">Auction Category</label>
                           <select class="form-control" id="category" name="category" required>
                                @foreach( App\Category::all() as $category)
                                    <option>{{$category->name}}</option>
                                @endforeach
                        </select>
                    </div>
                    @error('category')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <label for="closeDate">Auction Closing Date</label>
                    <div class="input-group form-group row">
                        <div>
                            <input type="date" placeholder="date" name="closeDate" class="form-control ml-3" id="closeDate" min="{{ now()->format('Y-m-d') }}" required>
                        </div>
                        @error('closeDate')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div>
                            <input class="form-control ml-5" type="time" name="time" id="time" value="13:45:00" id="example-time-input" required>
                        </div>
                        @error('money')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
					</div>

                    <label for="initialValue">Initial Value</label>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-money-bill-wave"></i></span>
						</div>
                        <input type="number" value="5" min="1" max="1000000" class="form-control" name="initialValue" id="initialValue" required>
					</div>
                    @error('initialValue')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
					<div class="form-group d-flex p-2 bd-highlight ">
						<input type="submit" value="Create Auction" class="btn btn-dark flex-grow-1">
					</div>
                </form>
			</div>
		</div>
	</div>
</div>
@endsection
