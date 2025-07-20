<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Crypto Admin Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script>
    function toggleSidebar() {
      document.getElementById('mobileSidebar').classList.toggle('-translate-x-full');
    }
  </script>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white font-sans">

  <!-- Mobile Nav -->
  <div class="md:hidden p-4 bg-gray-900 flex justify-between items-center">
    <h2 class="text-xl font-bold text-white">Crypto Admin</h2>
    <button onclick="toggleSidebar()" class="text-white focus:outline-none text-2xl">
      ☰
    </button>
  </div>

  <div class="min-h-screen flex flex-col md:flex-row relative">
    <!-- Sidebar -->
    <aside id="mobileSidebar" class="fixed inset-y-0 left-0 w-64 bg-gray-800 p-4 transform -translate-x-full transition-transform duration-300 z-50 md:translate-x-0 md:static md:block">
      <h2 class="text-xl font-bold mb-6">Crypto Admin</h2>
      <nav class="space-y-4">
        <a href="#" class="block text-gray-300 hover:text-white">Dashboard</a>
        <a href="#" class="block text-gray-300 hover:text-white">Trades</a>
        <a href="#" class="block text-gray-300 hover:text-white">Wallets</a>
        <a href="#" class="block text-gray-300 hover:text-white">Settings</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-auto mt-16 md:mt-0">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Cards -->
        <div class="bg-gray-700 p-4 rounded shadow">
          <h3 class="text-lg font-semibold">Total Assets</h3>
          <p class="text-2xl mt-2">$1.2M</p>
        </div>
        <div class="bg-gray-700 p-4 rounded shadow">
          <h3 class="text-lg font-semibold">Open Trades</h3>
          <p class="text-2xl mt-2">57</p>
        </div>
        <div class="bg-gray-700 p-4 rounded shadow">
          <h3 class="text-lg font-semibold">Active Users</h3>
          <p class="text-2xl mt-2">834</p>
        </div>
      </div>

      <!-- Charts & Tables -->
      <div class="bg-gray-800 p-6 rounded shadow mb-6">
        <h3 class="text-xl font-semibold mb-4">Market Trends</h3>
        <div class="h-64 bg-gray-700 flex items-center justify-center rounded">📈 Chart Placeholder</div>
      </div>

      <div class="bg-gray-800 p-6 rounded shadow">
        <h3 class="text-xl font-semibold mb-4">Recent Transactions</h3>
        <table class="w-full text-left table-auto">
          <thead>
            <tr>
              <th class="pb-2">User</th>
              <th class="pb-2">Asset</th>
              <th class="pb-2">Amount</th>
              <th class="pb-2">Status</th>
            </tr>
          </thead>
          <tbody>
            <tr class="border-t border-gray-700">
              <td class="py-2">Ibrahim</td>
              <td>BTC</td>
              <td>0.3</td>
              <td><span class="text-green-400">Completed</span></td>
            </tr>
            <tr class="border-t border-gray-700">
              <td class="py-2">Fatima</td>
              <td>ETH</td>
              <td>5</td>
              <td><span class="text-yellow-400">Pending</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>

</body>
</html>
