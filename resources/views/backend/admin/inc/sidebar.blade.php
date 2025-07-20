<!-- Sidebar -->
    <aside id="mobileSidebar" class="fixed inset-y-0 left-0 w-64 bg-gray-800 p-4 transform -translate-x-full transition-transform duration-300 z-50 md:translate-x-0 md:static md:block">
      <h2 class="text-xl font-bold mb-6">BinaryAiTrade Admin</h2>
      <nav class="space-y-4">
        <a href="{{route('admin.dashboard')}}" class="block text-gray-300 hover:text-white">Dashboard</a>
        <a href="#" class="block text-gray-300 hover:text-white">Trades</a>
        <a href="{{route('admin.wallet-fund')}}" class="block text-gray-300 hover:text-white">Wallets</a>
        <a href="{{route('admin.wallet-create')}}" class="block text-gray-300 hover:text-white">Create Wallet</a>
        <a href="#" class="block text-gray-300 hover:text-white">Settings</a>
        <a href="#" class="block text-gray-300 hover:text-white">
          <form action="{{route('logout')}}" method="post">
            @csrf
            <button class="btn btn-primary" type="submit">Logout</button>
          </form>
        </a>
      </nav>
    </aside>