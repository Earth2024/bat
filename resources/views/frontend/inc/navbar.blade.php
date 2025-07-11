<header>
    <div class="nav-container">
      <div class="nav-logo" style="display: flex; justify-content: space-between; align-items: flex-start;">
        <img src="{{url('binary/logo.jpg')}}" alt="binaryaitrade logo" style="width: 40px; height: 30px;">
        <h1 class="site-title">BINARYAITRADE</h1>
      </div>
      <div class="nav-controls">
        <button class="nav-toggle" onclick="toggleNav()">☰</button>
      </div>
      <nav id="navbar">
        <a href="{{url('/')}}">Home</a>
        <a href="{{route('login')}}">Login</a>
        <a href="{{route('register')}}">Register</a>
      </nav>
    </div>
  </header>