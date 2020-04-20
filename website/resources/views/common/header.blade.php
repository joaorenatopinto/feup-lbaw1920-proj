@section('header')
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
      <a class="navbar-brand text-light" href="/"><img src="{{ asset('img/logo_white.png') }}" width="80" height="60" alt="SLASH AH"></a>
        <button class="navbar-toggler bg-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <div class="d-flex justify-content-end flex-grow w-100">
          <ul class="navbar-nav">
              <li class="nav-item">
                <form class="form-inline my-2 my-lg-0 ">
                  <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
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