<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title')</title>
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
    
    @include('backend.admin.inc.sidebar')

    @yield('content')
    
  </div>

</body>
</html>

