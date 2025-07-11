<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Genzy Fintech Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .card {
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card:hover {
      transform: translateY(-4px);
      box-shadow: 0 10px 15px rgba(0, 0, 0, 0.15);
    }
  </style>
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

  <!-- Header -->
  <header class="bg-cyan-600 text-white p-4 shadow-md">
    <div class="max-w-6xl mx-auto flex justify-between items-center">
      <h1 class="text-2xl font-bold">💼 Genzy Dashboard</h1>
      <button class="bg-white text-cyan-600 px-4 py-2 rounded font-semibold hover:bg-gray-100">Logout</button>
    </div>
  </header>

  <!-- Main Content -->
  <main class="max-w-6xl mx-auto p-6 space-y-6">

    <!-- Card 1: Balance & History -->
    <div class="card bg-white p-6 rounded-lg shadow flex flex-col md:flex-row justify-between items-center gap-6">
      <div class="flex">
        <div class="flex-1">
            <h2 class="text-lg font-semibold text-gray-700">💰 Balance</h2>
            <p class="text-3xl font-bold text-cyan-600 mt-2">₦125,000.00</p>
        </div>
        <div class="flex-1">
            <h2 class="text-lg font-semibold text-gray-700">📜 Transaction</h2>
        </div>
      </div>
      <div class="flex-1 text-center">
        <button class="bg-cyan-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-cyan-700">➕ Add Money</button>
      </div>
    </div>

    <!-- Card 2: Major Grid -->
    <div class="card bg-white p-6 rounded-lg shadow">
      <div class="grid grid-cols-3 sm:grid-cols-4 gap-4 text-center text-sm mx-auto w-3/4">
        <div class="bg-gray-100 p-4 rounded hover:bg-gray-200">⚡ GPay</div>
        <div class="bg-gray-100 p-4 rounded hover:bg-gray-200">🏦 Bank</div>
        <div class="bg-gray-100 p-4 rounded hover:bg-gray-200">➕ Crypto</div>
      </div>
    </div>




    <!-- Card 3: Services Grid -->
    <div class="card bg-white p-6 rounded-lg shadow">
      <h2 class="text-lg font-semibold text-gray-700 mb-4">📱 Services</h2>
      <div class="grid grid-cols-3 sm:grid-cols-4 gap-4 text-center text-sm">
        <div class="bg-gray-100 p-4 rounded hover:bg-gray-200">📞 Airtime</div>
        <div class="bg-gray-100 p-4 rounded hover:bg-gray-200">📶 Data</div>
        <div class="bg-gray-100 p-4 rounded hover:bg-gray-200">🎮 Betting</div>
        <div class="bg-gray-100 p-4 rounded hover:bg-gray-200">📺 TV</div>
        <div class="bg-gray-100 p-4 rounded hover:bg-gray-200">💼 Ogenzy</div>
        <div class="bg-gray-100 p-4 rounded hover:bg-gray-200">💳 Loan</div>
        <div class="bg-gray-100 p-4 rounded hover:bg-gray-200">🎁 Invitation</div>
        <div class="bg-gray-100 p-4 rounded hover:bg-gray-200">➕ More</div>
      </div>
    </div>

  </main>

  <!-- Footer -->
  <footer class="bg-gray-800 text-white text-center p-4 mt-10">
    &copy; 2025 Genzy. All rights reserved.
  </footer>

</body>
</html>
