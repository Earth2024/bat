<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cal+Sans&display=swap" rel="stylesheet">
    @livewireStyles

    <script src="https://cdn.tailwindcss.com"></script>
  
    <link rel="stylesheet" href="{{url('binary/latest.css')}}">
    @yield('style')
    @yield('special-script')
    <meta name="trade-finalize-url" content="{{ route('option.update') }}">
</head>
<body style="width: 100%;">

    <div class="body-container">
        @include('backend.inc.navbar')
        @include('backend.inc.sidebar')

        @yield('content')
        
        <!-- @include('backend.inc.bottom-nav') -->
    </div>

    @livewireScripts
    @stack('scripts')
    @yield('script')
    <script>

        document.getElementById("menuButton").addEventListener("click", function () {
        document.getElementById("sidebar").classList.toggle("show");
        });

        function menuButton(){
            document.getElementById("sidebar").classList.toggle("show");
        }

    </script>

</body>
</html>