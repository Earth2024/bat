<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>AI Trading Bot</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white p-6 font-sans">
  <h1 class="text-3xl font-bold text-cyan-400 mb-6">🤖 AI Trading Bot</h1>

  <form id="tradeForm" class="space-y-4 max-w-xl mb-10">
    <div>
      <label class="block text-sm">Strategy</label>
      <select id="strategy" class="w-full p-2 bg-gray-800 rounded">
        <option value="1">Strategy 1 – RSI + EMA</option>
        <option value="2">Strategy 2 – Multi-layer</option>
        <option value="3">Strategy 3 – OB + FVG</option>
        <option value="4">Strategy 4 – Trendline + EMA</option>
        <option value="5">Strategy 5 – Candle patterns</option>
      </select>
    </div>

    <div>
      <label class="block text-sm">Symbol</label>
      <select id="symbol" class="w-full p-2 bg-gray-800 rounded">
        <optgroup label="Step Indices">
          <option value="Step Index">Step Index</option>
          <option value="Step Index 2">Step Index 2</option>
          <option value="Step Index 3">Step Index 3</option>
        </optgroup>
        <optgroup label="Volatility Indices">
          <option value="Volatility 25 Index">Volatility 25 Index</option>
          <option value="Volatility 50 Index">Volatility 50 Index</option>
          <option value="Volatility 75 Index">Volatility 75 Index</option>
        </optgroup>
        <optgroup label="Forex & Crypto">
          <option value="XAUUSD">XAUUSD</option>
          <option value="US30">US30</option>
          <option value="SOLUSD">SOLUSD</option>
          <option value="BITUSD">BITUSD</option>
        </optgroup>
      </select>
    </div>

    <div>
      <label class="block text-sm">Lot</label>
      <input type="number" id="lot" step="0.001" value="0.2" class="w-full p-2 bg-gray-800 rounded" required />
    </div>

    <div class="grid grid-cols-2 gap-4">
      <div>
        <label class="block text-sm">SL (pts)</label>
        <input type="number" id="sl" value="1000" class="w-full p-2 bg-gray-800 rounded" />
      </div>
      <div>
        <label class="block text-sm">TP (pts)</label>
        <input type="number" id="tp" value="1000" class="w-full p-2 bg-gray-800 rounded" />
      </div>
    </div>

    <button type="submit" class="w-full py-2 bg-cyan-500 hover:bg-cyan-600 rounded text-black font-bold">🚀 Place Trade</button>
  </form>

  <div id="status" class="mb-4 text-green-400">📡 Waiting for trade...</div>

  <div class="overflow-x-auto">
    <table class="min-w-full bg-gray-800 rounded-lg overflow-hidden text-sm">
      <thead class="bg-gray-700 text-cyan-300">
        <tr>
          <th class="px-4 py-2 text-left">Status</th>
          <th class="px-4 py-2 text-left">Symbol</th>
          <th class="px-4 py-2 text-left">Lot</th>
          <th class="px-4 py-2 text-left">SL</th>
          <th class="px-4 py-2 text-left">TP</th>
          <th class="px-4 py-2 text-left">Price</th>
          <th class="px-4 py-2 text-left">Profit</th>
          <th class="px-4 py-2 text-left">Time</th>
        </tr>
      </thead>
      <tbody id="tradeTable" class="text-white"></tbody>
    </table>
  </div>

  <script>
    const form = document.getElementById('tradeForm');
    const statusBox = document.getElementById('status');
    const tradeTable = document.getElementById('tradeTable');

    form.onsubmit = async (e) => {
      e.preventDefault();

      const payload = {
        symbol: document.getElementById('symbol').value,
        lot: parseFloat(document.getElementById('lot').value),
        sl: parseFloat(document.getElementById('sl').value),
        tp: parseFloat(document.getElementById('tp').value),
        strategy: parseInt(document.getElementById('strategy').value)
      };

      console.log(payload);
      try {
        const res = await fetch('http://localhost:3000/signal', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(payload)
        });

        if (res.ok) {
          statusBox.textContent = `✅ Signal sent for ${payload.symbol}`;
        } else {
          statusBox.textContent = `❌ Failed to send signal: ${res.statusText}`;
        }
      } catch (err) {
        statusBox.textContent = `❌ Error: ${err.message}`;
      }
    };

    function addTradeRow(trade) {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td class="px-4 py-2">${trade.status}</td>
        <td class="px-4 py-2">${trade.symbol}</td>
        <td class="px-4 py-2">${trade.lot}</td>
        <td class="px-4 py-2">${trade.sl || '-'}</td>
        <td class="px-4 py-2">${trade.tp || '-'}</td>
        <td class="px-4 py-2">${trade.price?.toFixed(5) || '-'}</td>
        <td class="px-4 py-2">${trade.profit?.toFixed(2) || '-'}</td>
        <td class="px-4 py-2">${trade.ts?.replace('T', ' ').slice(0, 16)}</td>
      `;
      tradeTable.prepend(row);
    }

    // Load history on page load
    fetch('http://127.0.0.1:3000/history')
      .then(res => res.json())
      .then(data => data.forEach(addTradeRow));

    // Real-time updates
    const eventSource = new EventSource('http://127.0.0.1:3000/stream');
    eventSource.onmessage = (event) => {
      const trade = JSON.parse(event.data);
      addTradeRow(trade);
      statusBox.textContent = `📬 ${trade.status.toUpperCase()}: ${trade.symbol}`;
    };
  </script>
</body>
</html>
