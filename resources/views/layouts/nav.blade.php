<nav class="navbar navbar-expand navbar-light">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">飲酒日記</a>

      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">
      <!-- Authentication Links -->
        @guest
        @else
        <li class="nav-item">
          <span class="nav-link">{{ Auth::user()->name }}</span>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout">
            {{ __('Logout') }}
          </a>
        </li>
        @endguest
      </ul>
  </div>
</nav>
