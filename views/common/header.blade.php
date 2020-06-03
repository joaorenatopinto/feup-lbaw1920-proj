@section('header')
<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-primary" style="max-height: 3em; padding: 0">
      <a class="navbar-brand text-light" href="/" style="max-height: 2em; margin-left: 5%; padding:0">
        <img src="{{ asset('img/logo_white.png') }}" style="max-height: 2em; padding:0" alt="SLASH AH">
      </a>
        <button class="navbar-toggler bg-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <div class="d-flex justify-content-end flex-grow w-100">
            <ul class="navbar-nav" style="align-items: center; display: flex;">
              <li class="nav-item">
                <form action="/auction/search" method="post" class="form-inline" style="max-height: 2em; margin: auto 5% 0 auto; padding:0">
                  {{ csrf_field() }}
                  <input class="form-control" type="search" placeholder="Search" aria-label="Search" name="search" style="max-height: 2em;">
                </form>
              </li>

              <li class="nav-item">
                <a class="navbar-brand text-white ml-3 text-center" href="/login">
                  <i class="far fa-user w-100"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
    </nav>
</header>
@show
