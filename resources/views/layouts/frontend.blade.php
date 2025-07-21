<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{url('frontend/all.css')}}">
  <!-- Select2 CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery and Select2 JS -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
<script src="https://s3.tradingview.com/tv.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
@livewireStyles()
</head>
<body>

@include('frontend.inc.navbar')

@yield('content')

@include('frontend.inc.footer')

@livewireScripts()
<script>
  document.getElementById("year").textContent = new Date().getFullYear();

  function subscribe() {
    const email = document.getElementById("email").value;
    const msg = document.getElementById("msg");
    if (email && email.includes("@")) {
      msg.textContent = "Thanks for subscribing!";
      msg.style.color = "#00ffcc";
    } else {
      msg.textContent = "Please enter a valid email.";
      msg.style.color = "red";
    }
  }
  
</script>

  <script>
    function toggleNav() {
      document.getElementById("navbar").classList.toggle("show");
    }
  </script>

  <script src="https://s3.tradingview.com/tv.js"></script>
  <script>
    let widget;

    function createChart(symbol) {
      if (widget) widget.remove();

      widget = new TradingView.widget({
        symbol: symbol ?? "BINANCE:BTCUSDT",
        interval: "1",
        timezone: "Etc/UTC",
        theme: "light",
        style: "1",
        locale: "en",
        toolbar_bg: "#f1f3f6",
        enable_publishing: false,
        container_id: "tradingview_chart",
        autosize: true
      });
    }

    function updateChartSymbol() {
      const selectedSymbol = document.getElementById("symbolSelect").value;
      createChart(selectedSymbol);
    }

    document.addEventListener("DOMContentLoaded", function () {
      createChart("BINANCE:BTCUSDT");
    });
  </script>
  
  @stack('scripts')

</body>
</html>
