<!-- Sidebar -->
    <aside id="mobileSidebar" class="fixed inset-y-0 left-0 w-64 bg-gray-800 p-4 transform -translate-x-full transition-transform duration-300 z-50 md:translate-x-0 md:static md:block">
      <h2 class="text-xl font-bold mb-6">BinaryAiTrade Admin</h2>
      <nav class="space-y-4">
        <a href="{{route('admin.dashboard')}}" class="block text-gray-300 hover:text-white">Dashboard</a>
        <a href="{{route('admin.users')}}" class="block text-gray-300 hover:text-white">Users</a>
        <a href="{{route('admin.wallet-fund')}}" class="block text-gray-300 hover:text-white">Fund Wallet</a>
        <a href="{{route('admin.wallet-create')}}" class="block text-gray-300 hover:text-white">Create Wallet</a>
        <a href="{{route('admin.wallet-users')}}" class="block text-gray-300 hover:text-white">Users Wallet</a>
        <a href="#" class="block text-gray-300 hover:text-white">
          <form action="{{route('logout')}}" method="post">
            @csrf
            <button class="btn btn-primary" type="submit">Logout</button>
          </form>
        </a>
      </nav>
    </aside>