<header class="flex items-center justify-between bg-white p-4 shadow-md md:ml-64">
    <button id="menu-toggle" class="md:hidden text-blue-800 focus:outline-none">
      ☰
    </button>
    <div style="width: 100%; display: flex; justify-content: space-between;">
      <h1 class="text-xl font-semibold">Admin Panel</h1>
      <div style="display: flex; width: 30%; justify-content: space-around;">
        @if (auth()->user())
          <p>{{auth()->user()->firstName}}</p>
          <p>
            <form action="{{route('logout')}}" method="post">
              @csrf
              <button class="btn btn-info" type="submit">Logout</button>
            </form>
          </p>
        @endif
      </div>
    </div>

  </header>