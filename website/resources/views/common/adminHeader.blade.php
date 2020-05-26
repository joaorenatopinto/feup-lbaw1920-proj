@section('header')
<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <a class="navbar-brand text-light" href="{{ route('home') }}"><img src="{{ asset('img/logo_white.png') }}" width="80" height="60"
        alt="SLASH AH"></a>
    <div class="d-flex justify-content-end flex-grow w-100">
      <ul class="navbar-nav">

        <li class="nav-item">
        <a class="text-white" href="{{ route('adminUsers') }}">{{ Auth::guard('admin')->user()->username }}</a>
          <a class="navbar-brand text-white" href="{{ route('adminLogout') }}">
            <i class="fas fa-door-open m-2"></i>
          </a>
        </li>
      </ul>
    </div>
  </nav>

</header>
@show