<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Bot Trade Panel</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-950 text-gray-100 p-6 font-sans">
  <div class="max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold text-teal-400 mb-6">📈 Trade Signal Dashboard</h1>

    <div class="bg-gray-900 p-6 rounded shadow-md">
      <div class="grid lg:grid-cols-2 gap-6">
        <div>
          <label class="block mb-1">Symbol</label>
          <input id="symbol" type="text" value="EURUSD" class="w-full p-2 rounded bg-gray-800 text-white" />
        </div>

        <div>
          <label class="block mb-1">Trade Direction</label>
          <select id="action" class="w-full p-2 rounded bg-gray-800 text-white">
            <option value="buy">Buy</option>
            <option value="sell">Sell</option>
          </select>
        </div>

        <div>
          <label class="block mb-1">Lot Size</label>
          <input id="lot" type="number" value="0.1" step="0.01" min="0.01" class="w-full p-2 rounded bg-gray-800 text-white" />
        </div>

        <div>
          <label class="block mb-1">Stop Loss ($)</label>
          <input id="sl" type="number" value="10" step="1" min="1" class="w-full p-2 rounded bg-gray-800 text-white" />
        </div>

        <div>
          <label class="block mb-1">Take Profit ($)</label>
          <input id="tp" type="number" value="20" step="1" min="1" class="w-full p-2 rounded bg-gray-800 text-white" />
        </div>

        <div class="flex items-end gap-3">
          <button onclick="sendTrade()" class="px-4 py-2 bg-green-600 hover:bg-green-700 rounded text-white">📤 Send Trade</button>
          <button onclick="sendTest()" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded text-white">🧪 Test</button>
          <button onclick="pauseBot()" class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 rounded text-white">⏸️ Pause</button>
        </div>
      </div>

      <div id="status" class="text-sm text-teal-300 mt-6 font-semibold">Status: —</div>
    </div>

    <div class="mt-8">
      <h2 class="text-xl font-bold mb-2 text-teal-400">🕒 Closed Trade History</h2>
      <pre id="log" class="bg-gray-800 p-4 rounded h-48 overflow-y-auto text-sm">—</pre>
    </div>
  </div>

  <script>
    async function sendTrade() {
      const payload = {
        symbol: document.getElementById("symbol").value.toUpperCase(),
        action: document.getElementById("action").value,
        lot: parseFloat(document.getElementById("lot").value),
        sl: parseFloat(document.getElementById("sl").value),
        tp: parseFloat(document.getElementById("tp").value)
      };

      const res = await fetch("http://localhost:4000/trade", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(payload)
      });

      const data = await res.json();
      document.getElementById("status").innerText = "Status: " + (data.status || data.error);
    }

    async function sendTest() {
      const res = await fetch("http://localhost:4000/test-signal", { method: "POST" });
      const data = await res.json();
      document.getElementById("status").innerText = "Test: " + (data.status || data.error);
    }

    async function pauseBot() {
      await fetch("http://localhost:4000/pause", { method: "POST" });
      document.getElementById("status").innerText = "Bot paused.";
    }

    async function loadHistory() {
      const res = await fetch("http://localhost:4000/history");
      const trades = await res.json();
      const log = trades.map(t => `${t.symbol} | ${t.action.toUpperCase()} | $${t.profit}`).join("\n");
      document.getElementById("log").innerText = log || "No history available.";
    }

    setInterval(loadHistory, 4000);
    loadHistory();
  </script>
</body>
</html>
