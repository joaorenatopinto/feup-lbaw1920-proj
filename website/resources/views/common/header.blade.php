@section('header')

@guest
<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <a class="navbar-brand text-light" href="/"><img src="{{ asset('img/logo_white.png') }}" width="80" height="60"
        alt="SLASH AH"></a>
    <button class="navbar-toggler bg-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
@endguest

@auth('web')
<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <a class="navbar-brand text-light" href="/"><img src="{{ asset('img/logo_white.png') }}" width="80" height="60"
        alt="SLASH AH"></a>

    @if(Auth::user()->getLastStatus()->status == 'moderator')
      <a href="{{ route('modUsers') }}" class="nav-link text-light">Moderation</a>
    @endif
    
    <button class="navbar-toggler bg-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <div class="d-flex justify-content-end flex-grow w-100">
        <ul class="navbar-nav">
          <li class="nav-item">
            <form class="form-inline my-2 my-lg-0 ">
              <a class="btn btn-danger mr-2 text-light">Create Auction</a>
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            </form>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" data-toggle="modal"
              data-target="#moneyModal">{{ Auth::user()->balance }}€</a>

            <!-- Modal -->
            <div class="modal fade" id="moneyModal" tabindex="-1" role="dialog"
              aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Balance Management</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <a href="{{ route('showDeposit') }}" class="m-1 btn btn-block btn-dark">Deposit Money </a>
                    <a href="{{ route('showWithdrawal') }}" class="m-1 btn btn-block btn-outline-dark">Withdraw Money </a>
                    <a href = "{{ route('showStatement',['id' => Auth::id()]) }}"class="m-1 btn btn-block btn-outline-dark">Check Statement </a>
                  </div>
                </div>
              </div>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link text-light"
              href="{{ route('profile',['id' => Auth::id()]) }}">{{ Auth::user()->name }}</a>
          </li>

          <li class="nav-item">
            <a class="navbar-brand" href="{{ route('profile',['id' => Auth::id()]) }}">
              <img src="{{ Auth::user()->getImage()->path }}" class="rounded-circle" width="35"
                height="35" alt="">
            </a>
          </li>

          <li class="nav-item">
            <a class="navbar-brand text-white" href="{{ route('logout') }}">
              <i class="fas fa-door-open m-2"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>
@endauth

@show