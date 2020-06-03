@section('header')
<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <a class="navbar-brand text-light" href="/" style="max-height: 2em; margin-left: 5%; padding:0">
      <img src="{{ asset('img/logo_white.png') }}" style="max-height: 2em; padding:0" alt="SLASH AH">
    </a>

    <div class="my-2 my-lg-0 collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="text-white" href="{{ route('adminUsers') }}">Users</a>
        </li>
        <li class="nav-item">
          <a class="text-white" href="{{ route('adminAuctions') }}">Auctions</a>
        </li>
        <li class="nav-item">
          <a class="text-white" href="{{ route('adminMods') }}">Moderation Logs</a>
        </li>
        <li class="nav-item">
          <a class="text-white" href="{{ route('adminReports') }}">Reports</a>
        </li>
        <li class="nav-item">
          <a class="text-white" href="{{ route('adminStats') }}">Statistics</a>
        </li>
        <li class="nav-item">
          <a class="text-white" href="{{ route('adminCategories') }}">Categories</a>
        </li>
      </ul>
    </div>

    <a class="nav-link text-white" href="{{ route('adminUsers') }}">{{ Auth::guard('admin')->user()->username }}</a>

    <a class="navbar-brand nav-link text-white" href="{{ route('adminLogout') }}">
      <i class="fas fa-door-open m-2"></i>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>
</header>
@show
