<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Deriv Auto Bot</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background: linear-gradient(to right, #0f172a, #1e293b);
      font-family: 'Segoe UI', sans-serif;
    }
    .glass {
      backdrop-filter: blur(10px);
      background-color: rgba(255, 255, 255, 0.04);
    }
    table th, td {
      white-space: nowrap;
    }
  </style>
</head>
<body class="text-white min-h-screen flex flex-col items-center py-10 px-4">
  <h1 class="text-3xl font-bold text-cyan-400 mb-6">🧠 Deriv Auto Bot</h1>

  <form id="botForm" class="w-full max-w-md glass p-6 rounded-xl">
    <div class="mb-4">
      <label class="block mb-1">Select Market</label>
      <select id="symbol" required class="w-full bg-slate-700 text-white px-3 py-2 rounded">
        <option value="R_75">Volatility 75 Index</option>
        <option value="1HZ100V">Step Index</option>
        <option value="frxXAUUSD">Gold (XAU/USD)</option>
        <option value="frxUSDJPY">USD/JPY</option>
        <option value="WLDAUDUSD">AUD/USD</option>
        <option value="OTC_USXUSD">US30 Index</option>
        <option value="cryBTCUSD">Bitcoin (BTC/USD)</option>
      </select>
    </div>
    <div class="mb-4">
      <label class="block mb-1">Lot Size</label>
      <input type="number" id="lotSize" placeholder="0.01" step="0.01" min="0.01" max="10" class="w-full bg-slate-700 text-white px-3 py-2 rounded" />
    </div>
    <div class="mb-4">
      <label class="block mb-1">Stop Loss ($)</label>
      <input type="number" id="stopLoss" required class="w-full bg-slate-700 text-white px-3 py-2 rounded" />
    </div>
    <div class="mb-4">
      <label class="block mb-1">Take Profit ($)</label>
      <input type="number" id="takeProfit" required class="w-full bg-slate-700 text-white px-3 py-2 rounded" />
    </div>
    <button id="startBtn" type="submit" class="w-full bg-cyan-500 hover:bg-cyan-600 text-black font-semibold py-2 rounded">Start Bot</button>
  </form>

  <div class="w-full max-w-md flex justify-between items-center mt-3">
    <span id="statusBadge" class="text-xs px-3 py-1 rounded-full font-semibold bg-slate-700">Idle</span>
    <button id="stopBtn" type="button" disabled class="bg-red-500 hover:bg-red-600 text-white text-sm font-semibold py-1 px-4 rounded">Stop Bot</button>
  </div>

  <div class="mt-6 text-center space-y-2">
    <p>📈 <span class="text-cyan-300 font-semibold">Price:</span> <span id="currentPrice">—</span></p>
    <p>📊 <span class="text-cyan-300 font-semibold">Trades Today:</span> <span id="tradeCount">0</span></p>
    <p>💰 <span class="text-cyan-300 font-semibold">Total PnL:</span> <span id="totalPnL">0.00</span></p>
    <p>🕹️ <span class="text-cyan-300 font-semibold">Trade Status:</span> <span id="liveStatus">Bot idle</span></p>
  </div>

  <div class="mt-8 overflow-x-auto w-full max-w-4xl">
    <table class="w-full table-auto text-sm bg-slate-800 rounded-lg overflow-hidden">
      <thead class="bg-slate-700 text-cyan-300 uppercase">
        <tr>
          <th class="px-4 py-2">#</th>
          <th class="px-4 py-2">Time</th>
          <th class="px-4 py-2">Type</th>
          <th class="px-4 py-2">Price</th>
          <th class="px-4 py-2">Profit</th>
          <th class="px-4 py-2">Result</th>
        </tr>
      </thead>
      <tbody id="resultsTableBody" class="text-white"></tbody>
    </table>
  </div>

  <script src="{{url('backend/js/bot.js')}}"></script>
</body>
</html>
