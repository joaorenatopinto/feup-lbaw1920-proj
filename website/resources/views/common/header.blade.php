@section('header')

@guest
<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <a class="navbar-brand text-light" href="/" style="max-height: 2em; margin-left: 5%; padding:0">
      <img src="{{ asset('img/logo_white.png') }}" style="max-height: 2em; padding:0" alt="SLASH AH">
    </a>
    <button class="navbar-toggler bg-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" >
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
@endguest

@auth('web')
<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <a class="navbar-brand text-light" href="/" style="max-height: 2em; margin-left: 5%; padding:0">
        <img src="{{ asset('img/logo_white.png') }}" style="max-height: 2em; padding:0" alt="SLASH AH">
    </a>

    @if(Auth::user()->getLastStatus()->status == 'moderator')
      <div class="nav-item dropdown">
        <a href="" class="nav-link text-light dropdown-toggle" data-toggle="dropdown" id=dropdownMod>Moderation</a>
        <div class="dropdown-menu" aria-labelledby="dropdownMod">
          <a href="{{route('modUsers')}}" class="dropdown-item">Users</a>
          <a href="{{route('modAuctions')}}" class="dropdown-item">Auctions</a>
          <a href="{{route('modReports')}}" class="dropdown-item">Reports</a>
        </div>
      </div>
    @endif

    <button class="navbar-toggler bg-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="max-height: 2em; margin-right: 5%; padding:0">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <div class="d-flex justify-content-end flex-grow w-100">
        <ul class="navbar-nav" style="align-items: center; display: flex;">
          <li class="nav-item">
          <a class="btn btn-danger mr-2 text-light" href=" {{ route('createAuction') }}">Create Auction</a>
          </li>
          <li class="nav-item">
            <form action="/auction/search" method="get" class="form-inline" style="max-height: 2em; margin: auto 5% 0 auto; padding:0">
              {{ csrf_field() }}
              <input class="form-control" type="search" placeholder="Search" aria-label="Search" name="search" style="max-height: 2em;">
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
            <a class="navbar-brand" href="{{ route('notifications',['id' => Auth::id()]) }}">
              <i class='far fa-bell' style='font-size:18px;color:white'></i>
            </a>
          </li>

          <li class="nav-item">
            <a class="navbar-brand" href="{{ route('profile',['id' => Auth::id()]) }}">
              <img src="{{ Auth::user()->getImage()->path }}" class="rounded-circle" width="35" height="35" alt="">
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
