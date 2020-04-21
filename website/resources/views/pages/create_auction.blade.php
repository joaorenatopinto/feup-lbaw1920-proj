@extends('layouts.app')

@section('content')

<div class="container mt-5">
	<div class="row justify-content-center">
		<div class="card col-sm-7 col-11">
			<div class="card-header">
				<h3>New Auction</h3>
			</div>
			<div class="card-body">
                <form method="POST" action="/auction/create">

                    {{ csrf_field() }}

                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-font"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="Auction Title" name="title" id="title">
					</div>

					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-font"></i></span>
						</div>
						<textarea class="form-control" placeholder="Auction Description" name="description" id="description"></textarea>
					</div>

                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Product Pictures</label>
                        </div>
                    </div>

                    <h6 class="card-title mt-5">Auction Configuration</h5>

                    <div class="form-group">
                        <label for="category">Auction Category</label>
                           <select class="form-control" id="category" name="category">
                                @foreach( App\Category::all() as $category)
                                    <option>{{$category->name}}</option>
                                @endforeach
                        </select>
                    </div>

                    <label for="closeDate">Auction Closing Date</label>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-calendar-week"></i></span>
						</div>
						<input type="date" class="form-control" name="closeDate" id="closeDate">
					</div>

                    <label for="initialValue">Minimum Price</label>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-money-bill-wave"></i></span>
						</div>
						<input type="number" value="5" class="form-control" name="initialValue" id="initialValue">
					</div>

                    <label for="auctionMinInc">Minimum Increment</label>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-arrow-up"></i></i></span>
						</div>
						<input type="number" name="mininc" value="1" class="form-control" id="auctionMinInc">
					</div>

                    <a data-toggle="collapse" aria-expanded="false" aria-controls="advOptions" href="#advOptions">
                        <h6>Advanced Options</h6>
                    </a>

                    <div class="collapse my-3" id="advOptions">
                        <label for="auctionMaxPrice">Minimum Increment</label>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-arrow-up"></i></i></span>
                            </div>
                            <input type="number" name="maxprice" value="100" class="form-control" id="auctionMaxPrice">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <input type="checkbox" aria-label="Checkbox for following text input">
                                </div>
                            </div>
                            <input type="text" class="form-control" value="Closed Auction" disabled>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <input type="checkbox" aria-label="Checkbox for following text input">
                                </div>
                            </div>
                            <input type="text" class="form-control" value="Automatic Bid Price" disabled>
                        </div>
                    </div>

					<div class="form-group d-flex p-2 bd-highlight ">
						<input type="submit" value="Create Auction" class="btn btn-info flex-grow-1">
					</div>
                </form>
			</div>
		</div>
	</div>
</div>
@endsection
