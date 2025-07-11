// === CONFIG ===
const API_TOKEN = "tA2pyAlp6NYzHVc";
const APP_ID = "80418";
const ZONE_LOOKBACK = 50;
const ATR_PERIOD = 14;
const MA_PERIOD = 20;
const MAX_TRADES_PER_DAY = 2;

// === STATE ===
let selectedSymbol = "R_75";
let ws, candles = [];
let latestPrice = 0, zone = null, atr = 0;
let tradeCount = 0, totalPnL = 0;
let retestCount = 0, tradeDirection = null, lastTrade = null;
let lotSize = 1.0, stopLoss = 10, takeProfit = 20;
let isBotRunning = false;

let formEl, startBtn, stopBtn, statusEl;

// === INIT BOT ===
function initBot(config) {
  if (isBotRunning) return;

  selectedSymbol = document.getElementById("symbol").value;
  lotSize = parseFloat(config.lotSize) || 1.0;
  stopLoss = parseFloat(config.stopLoss);
  takeProfit = parseFloat(config.takeProfit);

  updateStatus("Running", "bg-green-600");
  updateLiveStatus("Starting bot...");
  disableForm(true);
  isBotRunning = true;
  tradeCount = 0;
  totalPnL = 0;
  updateUI("tradeCount", "0");
  updateUI("totalPnL", "0.00");

  connectWebSocket();
}

function stopBot() {
  if (ws) ws.close();
  updateStatus("Stopped", "bg-red-600");
  updateLiveStatus("Bot stopped");
  disableForm(false);
  isBotRunning = false;
}

// === CONNECT TO DERIV ===
function connectWebSocket() {
  ws = new WebSocket(`wss://ws.derivws.com/websockets/v3?app_id=${APP_ID}`);

  ws.onopen = () => {
    ws.send(JSON.stringify({ authorize: API_TOKEN }));
    ws.send(JSON.stringify({
      ticks_history: selectedSymbol,
      style: "candles",
      count: ZONE_LOOKBACK,
      granularity: 60
    }));
    ws.send(JSON.stringify({
      ticks: selectedSymbol,
      subscribe: 1
    }));
  };

  ws.onmessage = (msg) => {
    const data = JSON.parse(msg.data);

    if (data.candles) {
      candles = data.candles;
      zone = calculateZone(candles);
      atr = calculateATR(candles, ATR_PERIOD);
      updateLiveStatus("Market data loaded");
    }

    if (data.tick) {
      latestPrice = parseFloat(data.tick.quote);
      updateUI("currentPrice", latestPrice.toFixed(5));
      processLogic(latestPrice);
    }

    if (data.buy) {
      lastTrade = {
        type: data.buy.contract_type,
        price: data.buy.buy_price.toFixed(2),
        time: new Date().toLocaleTimeString()
      };
      updateLiveStatus(`Placed ${lastTrade.type} @ $${lastTrade.price}`);
    }

    if (data.profit !== undefined && lastTrade) {
      const profit = parseFloat(data.profit).toFixed(2);
      const outcome = profit >= 0 ? "Won" : "Lost";
      totalPnL += parseFloat(profit);
      updateUI("totalPnL", totalPnL.toFixed(2));
      updateUI("tradeCount", tradeCount);
      appendToResultsTable({ ...lastTrade, profit, outcome });
      updateLiveStatus(`Trade ${outcome} ($${profit})`);
      lastTrade = null;
    }
  };

  ws.onerror = (err) => console.error("WebSocket error:", err.message || err);
  ws.onclose = () => updateLiveStatus("Connection closed");
}

// === STRATEGY ===
function calculateZone(candles) {
  const highs = candles.map(c => parseFloat(c.high));
  const lows = candles.map(c => parseFloat(c.low));
  return { top: Math.max(...highs), bottom: Math.min(...lows) };
}

function calculateATR(candles, period) {
  const trs = [];
  for (let i = 1; i < candles.length; i++) {
    const c = candles[i], p = candles[i - 1];
    const tr = Math.max(
      c.high - c.low,
      Math.abs(c.high - p.close),
      Math.abs(c.low - p.close)
    );
    trs.push(tr);
  }
  return trs.slice(-period).reduce((a, b) => a + b, 0) / period;
}

function movingAverage(candles, period) {
  const closes = candles.slice(-period).map(c => parseFloat(c.close));
  return closes.reduce((a, b) => a + b, 0) / closes.length;
}

function processLogic(price) {
  if (!zone || candles.length < MA_PERIOD) return;

  const ma = movingAverage(candles, MA_PERIOD);

  if (price >= zone.bottom && price <= zone.top) {
    retestCount++;
    updateLiveStatus("Retesting price zone");
  }

  if (price > zone.top + atr && price > ma) {
    tradeDirection = "CALL";
    updateLiveStatus("CALL signal 🔼");
  }

  if (price < zone.bottom - atr && price < ma) {
    tradeDirection = "PUT";
    updateLiveStatus("PUT signal 🔽");
  }

  if (
    tradeDirection &&
    tradeCount < MAX_TRADES_PER_DAY &&
    totalPnL > -stopLoss &&
    totalPnL < takeProfit
  ) {
    placeTrade(tradeDirection, lotSize);
    tradeCount++;
    retestCount = 0;
    tradeDirection = null;
  }
}

function placeTrade(type, amount) {
  ws.send(JSON.stringify({
    buy: 1,
    price: amount,
    parameters: {
      amount,
      basis: "stake",
      contract_type: type,
      currency: "USD",
      duration: 5,
      duration_unit: "t",
      symbol: selectedSymbol
    }
  }));
}

// === UI HELPERS ===
function updateUI(id, value) {
  const el = document.getElementById(id);
  if (el) el.textContent = value;
}

function updateStatus(label, color = "bg-slate-700") {
  statusEl.textContent = label;
  statusEl.className = `text-xs px-3 py-1 rounded-full font-semibold ${color}`;
}

function updateLiveStatus(message) {
  const el = document.getElementById("liveStatus");
  if (el) el.textContent = message;
}

function disableForm(disabled) {
  formEl.querySelectorAll("input, select").forEach(i => i.disabled = disabled);
  startBtn.disabled = disabled;
  stopBtn.disabled = !disabled;
}

function appendToResultsTable(trade) {
  const row = `
    <tr class="border-t border-slate-700 hover:bg-slate-700/50">
      <td class="px-4 py-2">${tradeCount}</td>
      <td class="px-4 py-2">${trade.time}</td>
      <td class="px-4 py-2">${trade.type}</td>
      <td class="px-4 py-2">${trade.price}</td>
      <td class="px-4 py-2">${trade.profit}</td>
      <td class="px-4 py-2">${trade.outcome === "Won" ? "✅" : "❌"} ${trade.outcome}</td>
    </tr>`;
  document.getElementById("resultsTableBody").insertAdjacentHTML("afterbegin", row);
}

function logTradeToLaravel(trade) {
  fetch("https://yourdomain.com/api/log-trade", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      contract_type: trade.type,
      entry_price: trade.price,
      profit: trade.profit,
      result: trade.outcome,
      executed_at: new Date().toISOString()
    })
  }).then(res => res.json()).then(console.log);
}

// === INIT ===
document.addEventListener("DOMContentLoaded", () => {
  formEl = document.getElementById("botForm");
  startBtn = document.getElementById("startBtn");
  stopBtn = document.getElementById("stopBtn");
  statusEl = document.getElementById("statusBadge");

  formEl.addEventListener("submit", function (e) {
    e.preventDefault();
    const lotSize = document.getElementById("lotSize").value || 1.0;
    const stopLoss = document.getElementById("stopLoss").value;
    const takeProfit = document.getElementById("takeProfit").value;

    if (!stopLoss || !takeProfit) {
      alert("Please fill in Stop Loss and Take Profit.");
      return;
    }

    initBot({ lotSize, stopLoss, takeProfit });
  });

  stopBtn.addEventListener("click", stopBot);
  disableForm(false);
  updateStatus("Idle", "bg-slate-700");

  });