<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Deriv Binary Interface</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 2rem;
    }
    #chartCanvas {
      width: 100%;
      height: 300px;
      margin-bottom: 2rem;
    }
    #countdown, #result {
      font-size: 1.2rem;
      margin-top: 1rem;
      font-weight: bold;
    }
    #result {
      color: green;
    }
    .toast {
      visibility: hidden;
      min-width: 200px;
      margin: auto;
      background-color: #333;
      color: #fff;
      text-align: center;
      border-radius: 8px;
      padding: 12px;
      position: fixed;
      z-index: 1;
      left: 50%;
      bottom: 30px;
      font-size: 1rem;
      transform: translateX(-50%);
      opacity: 0;
      transition: opacity 0.5s, bottom 0.5s;
    }
    .toast.show {
      visibility: visible;
      bottom: 60px;
      opacity: 1;
    }
  </style>
</head>
<body>
  <h1>📈 Binary Options</h1>

  <div id="price">Price: --</div>
  <canvas id="chartCanvas"></canvas>

  <form id="tradeForm">
    <input type="number" id="amount" placeholder="Amount" required />
    <select id="contract_type">
      <option value="CALL">Call</option>
      <option value="PUT">Put</option>
    </select>
    <button type="submit">Place Trade</button>
  </form>

  <div id="countdown">⏳ Time Left: --</div>
  <div id="result">💵 Result: --</div>
  <div id="toast" class="toast">Placeholder</div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const token = "tA2pyAlp6NYzHVc"; // replace with your actual demo token
    const ws = new WebSocket("wss://ws.derivws.com/websockets/v3?app_id=80174");

    let chartData = [];
    let currentContractId = null;
    let countdownInterval = null;

    const ctx = document.getElementById("chartCanvas").getContext("2d");
    const myChart = new Chart(ctx, {
      type: "line",
      data: {
        labels: [],
        datasets: [{
          label: 'Price',
          data: [],
          borderColor: 'blue',
          fill: false
        }]
      },
    });

    function updateChart(price) {
      const now = new Date().toLocaleTimeString();
      if (chartData.length > 50) {
        chartData.shift();
        myChart.data.labels.shift();
      }
      chartData.push(price);
      myChart.data.labels.push(now);
      myChart.data.datasets[0].data = chartData;
      myChart.update();
    }

    function showToast(message) {
      const toast = document.getElementById("toast");
      toast.textContent = message;
      toast.classList.add("show");
      setTimeout(() => toast.classList.remove("show"), 3000);
    }

    function startCountdown(expiryTime) {
      clearInterval(countdownInterval);
      countdownInterval = setInterval(() => {
        const now = Math.floor(Date.now() / 1000);
        const remaining = expiryTime - now;
        const countdown = document.getElementById("countdown");
        if (remaining > 0) {
          countdown.innerText = `⏳ Time Left: ${remaining}s`;
        } else {
          countdown.innerText = `⌛ Trade Expired`;
          clearInterval(countdownInterval);
        }
      }, 1000);
    }

    ws.onopen = () => {
      ws.send(JSON.stringify({ authorize: token }));
      ws.send(JSON.stringify({ ticks: "R_100" }));
    };

    ws.onmessage = (msg) => {
      const data = JSON.parse(msg.data);

      if (data.error) {
        showToast(`❗ ${data.error.message}`);
        console.error(data.error);
      }

      if (data.tick) {
        document.getElementById("price").innerText = "Price: " + data.tick.quote;
        updateChart(data.tick.quote);
      }

      if (data.buy) {
        currentContractId = data.buy.contract_id;
        showToast(`✅ Trade placed! ID: ${currentContractId}`);
        document.getElementById("result").innerText = "💵 Result: Waiting...";
        ws.send(JSON.stringify({
          proposal_open_contract: 1,
          contract_id: currentContractId,
          subscribe: 1
        }));
      }

      if (data.proposal_open_contract) {
        const poc = data.proposal_open_contract;

        if (poc.date_expiry) startCountdown(poc.date_expiry);

        if (poc.status === "won") {
          const message = `🎉 You WON! Profit: $${poc.profit}`;
          showToast(message);
          document.getElementById("result").innerText = `💵 Result: ${message}`;
        } else if (poc.status === "lost") {
          const message = `😞 You LOST. -$${poc.amount}`;
          showToast(message);
          document.getElementById("result").innerText = `💵 Result: ${message}`;
        }
      }
    };

    document.getElementById("tradeForm").addEventListener("submit", function (e) {
      e.preventDefault();
      const contract_type = document.getElementById("contract_type").value;
      const amount = document.getElementById("amount").value;

      const trade = {
        buy: 1,
        price: amount,
        parameters: {
          amount: amount,
          basis: "stake",
          contract_type: contract_type,
          currency: "USD",
          duration: 1,
          duration_unit: "m",
          symbol: "R_100"
        }
      };

      ws.send(JSON.stringify(trade));
    });
  </script>
</body>
</html>
