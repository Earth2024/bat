document.addEventListener("DOMContentLoaded", () => {
  const token = "tA2pyAlp6NYzHVc";
  let currentSymbol = "R_100";
  let lastTrade = {};
  let contractId = null;
  let chartData = [];
  let countdown = null;
  let tradeInProgress = false;
  let derivConnected = false;

  const ctx = document.getElementById("chartCanvas")?.getContext("2d");
  const chart = new Chart(ctx, {
    type: "line",
    data: {
      labels: [],
      datasets: [{
        label: "Price",
        data: [],
        borderColor: "blue",
        borderWidth: 0.5,
        tension: 0.3,
        pointRadius: 0,
        fill: false
      }]
    }
  });

  const ws = new WebSocket("wss://ws.derivws.com/websockets/v3?app_id=80174");
  window.ws = ws;

  const updateChart = (price) => {
    const now = new Date().toLocaleTimeString();
    if (chartData.length > 50) {
      chartData.shift();
      chart.data.labels.shift();
    }
    chartData.push(price);
    chart.data.labels.push(now);
    chart.data.datasets[0].data = chartData;
    chart.update();
  };

  const resetChart = () => {
    chartData = [];
    chart.data.labels = [];
    chart.data.datasets[0].data = [];
    chart.update();
  };

  const showToast = (msg) => {
    const toast = document.getElementById("toast");
    toast.textContent = msg;
    toast.classList.remove("hidden", "opacity-0");
    toast.classList.add("opacity-100");
    setTimeout(() => toast.classList.add("opacity-0"), 3000);
  };

  const startCountdown = (expiry) => {
    clearInterval(countdown);
    countdown = setInterval(() => {
      const now = Math.floor(Date.now() / 1000);
      const timeLeft = expiry - now;
      document.getElementById("countdown").textContent = timeLeft > 0
        ? `⏳ Time Left: ${timeLeft}s`
        : "⌛ 0:00";
      if (timeLeft <= 0) clearInterval(countdown);
    }, 1000);
  };

  const statusEl = document.getElementById("derivStatus");

  ws.onopen = () => {
    derivConnected = true;
    statusEl.textContent = "🟢 Connected";
    ws.send(JSON.stringify({ authorize: token }));
    ws.send(JSON.stringify({ ticks: currentSymbol }));
  };

  ws.onerror = (err) => {
    derivConnected = false;
    statusEl.textContent = "🔴 Connection error";
    showToast("❌ Connection failed.");
  };

  ws.onclose = () => {
    derivConnected = false;
    statusEl.textContent = "🔴 Disconnected";
    showToast("⚠️ Disconnected. Please reload or wait.");
  };

  ws.onmessage = (msg) => {
    const data = JSON.parse(msg.data);
    if (data.error) return showToast("❗ " + data.error.message);

    if (data.tick) {
      document.getElementById("price").textContent = "Price: " + data.tick.quote;
      updateChart(data.tick.quote);
    }

    if (data.buy) {
      contractId = data.buy.contract_id;
      if (window.Livewire) {
        Livewire.dispatch("createTrade", {
          contract_id: contractId,
          amount: lastTrade.amount,
          contractType: lastTrade.contractType
        });
      }
      document.getElementById("result").textContent = "💵 Result: Waiting...";
      ws.send(JSON.stringify({
        proposal_open_contract: 1,
        contract_id: contractId,
        subscribe: 1
      }));
    }

    if (data.proposal_open_contract) {
      const poc = data.proposal_open_contract;
      if (poc.date_expiry) startCountdown(poc.date_expiry);

      if (["won", "lost"].includes(poc.status)) {
        const profit = parseFloat(poc.profit);
        const resultText = poc.status === "won"
          ? `🎉 You WON! Profit: $${(((profit.toFixed(2) * 100) / parseFloat(86)) * 0.76).toFixed(2)}`
          : `😞 You LOST. -$${parseFloat(0).toFixed(2)}`;

        document.getElementById("result").textContent = resultText;
        showToast(resultText);

        if (window.Livewire) {
          Livewire.dispatch("finalizeTrade", {
            contractId,
            status: poc.status,
            profit
          });
        }

        document.getElementById("tradeBtn").disabled = false;
        tradeInProgress = false;
        clearInterval(countdown);
      }
    }
  };

  document.getElementById("tradeForm").addEventListener("submit", async (e) => {
    e.preventDefault();

    if (!derivConnected) {
      showToast("⚠️ Can't trade: not connected.");
      return;
    }

    if (tradeInProgress) {
      showToast("⏳ Wait until the current trade finishes.");
      return;
    }

    const form = new FormData(e.target);
    const selectedSymbol = form.get("symbol") || "R_100";
    currentSymbol = selectedSymbol;

    document.getElementById("tradeBtn").disabled = true;
    tradeInProgress = true;

    try {
      const res = await fetch("/user/option/place-trade", {
        method: "POST",
        headers: {
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
          Accept: "application/json"
        },
        body: form
      });

      const result = await res.json();
      if (!res.ok) throw result;

      lastTrade = result.trade;

      ws.send(JSON.stringify({ forget_all: "ticks" }));
      ws.send(JSON.stringify({ ticks: currentSymbol }));
      resetChart();

      const trade = {
        buy: 1,
        price: result.trade.amount,
        parameters: {
          amount: result.trade.amount,
          basis: "stake",
          contract_type: result.trade.contractType,
          currency: "USD",
          duration: 1,
          duration_unit: "m",
          symbol: currentSymbol
        }
      };

      ws.send(JSON.stringify(trade));
      showToast("✅ Trade placed!");
    } catch (err) {
      showToast(err.message || "❌ Insufficient funds. Please fund your wallet to continue");
      document.getElementById("tradeBtn").disabled = false;
      tradeInProgress = false;
    }
  });

  window.switchSymbol = function (symbol) {
    currentSymbol = symbol;
    resetChart();
    if (derivConnected) {
      ws.send(JSON.stringify({ forget_all: "ticks" }));
      ws.send(JSON.stringify({ ticks: symbol }));
    }
  };
});
