<div class="card mx-auto">  
    <div class="d-flex justify-content-end">
      <img class="d-none d-sm-block card-img-left rounded-circle my-auto p-3" src="img/cages.png" alt="Card image cap">
      <div class="card-body">
      <h5 class="card-title">{{ $user->name }}</h5>
      @if($user->description == null)
        <p class="card-text">No description provided</p>
      @else
        <p class="card-text">{{ $user->description }}</p>
      @endif
      <p class="card-text"> -Email: {{ $user->email }}</p>
      <p class="card-text"> -Balance: {{ $user->balance }}</p>
        <p class="card-text"> -Status: Active</p>
        <a href="#" class="btn btn-primary">Make Mod</a>
        <a href="#" class="btn btn-primary">Ban</a>
      </div>
    </div>
  </div>