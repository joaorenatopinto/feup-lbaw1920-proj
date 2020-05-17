<div class="col m-2">
    <img class="d-block w-100 img-rounded img-fluid"
        src="{{asset(App\Image::where('auction_id',App\Auction::where('category_id',$category->id)->first()->id)->first()->path)}}"
        alt="Category">
    {{$category->name}}

</div>