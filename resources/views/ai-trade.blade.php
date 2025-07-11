<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>DirectFundedTrader</title>
  <style>
    body {
      margin: 0;
      background-color: #1a1a2e;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: white;
    }
    .header {
      background-color: #0f3460;
      text-align: center;
      padding: 20px 10px;
    }
    .header h1 {
      margin: 0;
      font-size: 2rem;
    }
    .container {
      display: flex;
      justify-content: center;
      gap: 20px;
      padding: 40px;
      flex-wrap: wrap;
    }
    .card {
      background-color: #2e2e4d;
      border-radius: 10px;
      padding: 20px;
      width: 280px;
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0,0,0,0.3);
    }
    .card h2 {
      margin-top: 0;
      color: #00adb5;
    }
    .card p {
      margin: 6px 0;
    }
  </style>
</head>
<body>
  <!-- <div class="header">
    <h1 style="text-align: center;">How the evaluation process works</h1>
  </div>
   -->
  <div>
    <h1 style="text-align: center; padding: 8px;">How the evaluation process works</h1>
    <p style="text-align: center; padding: 8px; font-size: 17px;">
      If you want to trade with our company’s capital, all you’ve got to do is pass a simple 2-Phase Evaluation. 
      Just hit our realistic Profit Targets to show off your skills. At BinaryAiTrader, we’re all about finding
      talented traders—so we’ve laid out a few easy Trading Objectives to help guide you.
    </p>
  </div>
  <div class="container">
    <div class="card">
      <h2>Phase 1</h2>
      <p>Profit Target: 8%</p>
      <p>Trading Period: Unlimited</p>
      <p>Leverage: 1:100</p>
      <p>Minimum Trading Days: 5</p>
      <p>Max Daily Loss: 5%</p>
      <p>Max Overall Loss: 10%</p>
      <p>Hold over weekend: Allowed</p>
      <p>Registration Fee: Not specified</p>
    </div>
    <div class="card">
      <h2>Phase 2</h2>
      <p>Profit Target: 5%</p>
      <p>Trading Period: Unlimited</p>
      <p>Leverage: 1:100</p>
      <p>Minimum Trading Days: 5</p>
      <p>Max Daily Loss: 5%</p>
      <p>Max Overall Loss: 10%</p>
      <p>Hold over weekend: Allowed</p>
    </div>
    <div class="card">
      <h2>Funded</h2>
      <p>Profit Split: 80/20</p>
      <p>Trading Period: Unlimited</p>
      <p>Leverage: 1:100</p>
      <p>Max Daily Loss: 5%</p>
      <p>Max Overall Loss: 10%</p>
      <p>Refund Registration Fee: 150%</p>
    </div>
  </div>

  <!-- Footer -->
<footer class="footer">
  <div class="footer-container">
    <div class="footer-section">
      <h2>TradeSmarter</h2>
      <p>Your gateway to financial freedom through currency, crypto, and futures trading. Partnered with leading prop firms worldwide.</p>
    </div>
    <div class="footer-section">
      <h3>Explore</h3>
      <ul>
        <li><a href="#">Options Trading</a></li>
        <li><a href="#">Crypto Bots</a></li>
        <li><a href="#">Monthly Challenge</a></li>
        <li><a href="#">Forex Insights</a></li>
      </ul>
    </div>
    <div class="footer-section">
      <h3>Subscribe</h3>
      <p>Stay updated on market trends and bot strategies. Get our free weekly digest.</p>
      <input type="email" id="email" placeholder="Your email" />
      <button onclick="subscribe()">Subscribe</button>
      <p id="msg"></p>
    </div>
  </div>
  <div class="footer-bottom">
    &copy; <span id="year"></span> TradeSmarter. Built for visionaries in trading.
  </div>
</footer>

<style>
  .footer {
    background: #111;
    color: #ddd;
    padding: 40px 20px;
    font-family: 'Segoe UI', sans-serif;
  }

  .footer-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
  }

  .footer-section {
    flex: 1 1 250px;
    margin: 10px;
  }

  .footer-section h2, .footer-section h3 {
    color: #00ffcc;
  }

  .footer-section ul {
    list-style: none;
    padding: 0;
  }

  .footer-section ul li a {
    color: #bbb;
    text-decoration: none;
  }

  .footer-section input {
    padding: 8px;
    width: 80%;
    margin-top: 10px;
    border: none;
    border-radius: 4px;
  }

  .footer-section button {
    padding: 8px 12px;
    margin-top: 10px;
    background-color: #00ffcc;
    border: none;
    color: #000;
    cursor: pointer;
    border-radius: 4px;
  }

  .footer-bottom {
    text-align: center;
    margin-top: 30px;
    font-size: 0.9rem;
    color: #666;
  }

  @media (max-width: 768px) {
    .footer-container {
      flex-direction: column;
      text-align: center;
    }

    .footer-section input {
      width: 100%;
    }
  }
</style>

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

</body>
</html>
