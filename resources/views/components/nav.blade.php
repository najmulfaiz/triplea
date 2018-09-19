   <nav class="navbar navbar-expand-lg navbar-light fixed-top header-bg" id="mainNav">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Booking Online</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
          @if (empty(session('userid')))
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/') }}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/daftar-peserta') }}">Daftar Peserta</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/login') }}">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/register') }}">Register</a>
            </li>
          @else

            <li class="nav-item">
              <a class="nav-link" href="{{ url('/') }}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/daftar-peserta') }}">Daftar Peserta</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/') }}">Beli</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/profile') }}">Profil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/dashboard') }}">Logout</a>
            </li>
          @endif

          </ul>
        </div>
      </div>
    </nav>
