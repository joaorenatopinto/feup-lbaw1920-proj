@section('header')
<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <a class="navbar-brand text-light" href="#"><img src="{{ asset('img/logo_white.png') }}" width="80" height="60" alt="SLASH AH"></a>
    <li class="nav-item">
      <a class="text-light">9999.99€</a>
    </li>
  <li class="nav-item"><a class="text-light" href="">{{ Auth::guard('admin')->user()->username }}</a></li>
  </nav>
</header>
@show