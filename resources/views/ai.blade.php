<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Binary AI Trade</title>
  <style>
    *, html, body{
        margin: 0;
        padiding: 0;
        box-sizing: border-box;
    }
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f8f8f8;
      color: #333;
    }

    header {
      background-color: #ffffff;
      padding: 20px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .nav-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
    }

    .nav-logo h1 {
      margin: 0;
      font-size: 24px;
    }

    .nav-controls {
      display: flex;
      align-items: center;
    }

    .nav-toggle {
      display: none;
      background: none;
      border: none;
      font-size: 24px;
      cursor: pointer;
    }

    nav {
      display: flex;
      gap: 15px;
      flex-wrap: wrap;
    }

    nav a {
      text-decoration: none;
      color: #333;
      font-weight: bold;
    }

    .main-content {
      /* flex-wrap: wrap;
      justify-content: space-between;
      align-items: flex-start; */
      /* gap: 30px; */
      /* padding: 30px 20px; */
      background-color: white;
      margin: 0 auto;
      width: 100%;
      /* max-width: 100%; */
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    

    .main-content-one{

      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      /* gap: 30px; */
      padding: 0 20px;
      background-color: white;
      margin: 40px auto;
      width: 90%;
      /* max-width: 1200px; */
      /* border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08); */
    }

    .main-content-two{
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        /* gap: 30px; */
        padding: 0 20px;
        background-color: white;
        margin: 40px auto;
        width: 90%;
        /* max-width: 1200px; */
        /* border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08); */
    }

    .promo-text {
      flex: 1 1 480px;
      /* background: linear-gradient(145deg, #fefefe, #f1f1f1); */
      background-color: #fff;
      padding: 30px;
      border-radius: 10px;
      /* box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08); */
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .promo-text h2 {
      font-size: 28px;
      margin-bottom: 15px;
      color: #333;
    }

    .promo-text .highlight {
      color: #e69800;
    }

    .promo-text .intro {
      font-size: 16px;
      font-weight: 500;
      margin-bottom: 30px;
      color: #555;
    }

    .feature {
      margin-bottom: 25px;
      padding-left: 10px;
      border-left: 4px solid #ffd000;
    }

    .feature h3 {
      margin-bottom: 8px;
      color: #444;
    }

    .feature p {
      color: #666;
      line-height: 1.5;
    }

    .form-container {
      flex: 1 1 480px;
      background-color: #fff;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      border-radius: 10px;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input[type="text"], input[type="email"], select {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    input[type="checkbox"] {
      margin-right: 10px;
    }

    button {
      background-color: #ffcc00;
      border: none;
      padding: 10px;
      font-weight: bold;
      cursor: pointer;
      width: 100%;
      border-radius: 4px;
    }


    .select2-results__option span {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    }

    .select2-selection__rendered {
        display: flex !important;
        align-items: center;
        gap: 0.5rem;
    }


    .select2-selection__rendered {
        display: flex !important;
        align-items: center;
        gap: 0.5rem;
    }

    .select2-selection__clear {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        z-index: 10;
    }

    

    @media screen and (max-width: 720px) { 
      .main-content-one{
        display: block;
      }

      .main-content-two{
        display: block !important;
      }

      .nav-controls {
        width: 90px;
        justify-content: flex-end;
      }

      nav {
        flex-direction: column;
        align-items: flex-start;
        width: 100%;
        display: none;
        margin-top: 10px;
      }

      .site-title {
        font-size: 12px !important;
      }

      nav.show {
        display: flex;
      }

      .nav-toggle {
        display: block;
      }
    }

   

    /* styling for binary */

    .trade-container {
    background: #21252b;
    padding: 20px;
    border-radius: 10px;
    width: 90%;
    max-width: 350px;
    margin: 1rem auto;
    box-shadow: 0 0 20px rgba(0,0,0,0.5);
    }

    .timer {
    font-size: 1.5rem;
    text-align: center;
    margin-bottom: 15px;
    }

    .asset-bar {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    }

    .asset-bar select,
    .asset-bar input {
    width: 48%;
    padding: 8px;
    border-radius: 4px;
    border: none;
    background: #2e333a;
    color: #fff;
    }

    .price {
    text-align: center;
    font-size: 2rem;
    margin-bottom: 15px;
    font-weight: bold;
    }

    .action-buttons {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    }

    .high, .low {
    width: 48%;
    padding: 10px;
    font-size: 1.1rem;
    border: none;
    border-radius: 6px;
    color: #fff;
    cursor: pointer;
    }

    .high {
    background: #28a745;
    }

    .low {
    background: #dc3545;
    }

    .info-line {
    display: flex;
    justify-content: space-between;
    font-size: 0.9rem;
    margin-bottom: 15px;
    }

    .investment-payouts {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    font-size: 0.9rem;
    }

    .investment-payouts label {
    display: block;
    margin-bottom: 4px;
    }

    .investment-payouts select {
    background: #2e333a;
    border: none;
    color: #fff;
    padding: 5px;
    border-radius: 4px;
    }

    .trade-btn {
    width: 100%;
    padding: 12px;
    font-size: 1.1rem;
    background: #ffc107;
    border: none;
    border-radius: 6px;
    color: #000;
    cursor: pointer;
    }

    /* evaluation */

    .container-evaluation {
      width: 100%;
      background-color: #0a0e27;
      margin: auto;
      padding: 2rem 1rem;
      color: white !important;
    }

    .section-title {
      text-align: center;
      font-size: 2rem;
      font-weight: 600;
      margin-bottom: 2.5rem;
    }

    .card-wrapper {
      display: flex;
      flex-wrap: wrap;
      gap: 2rem;
      justify-content: center;
    }

    .card {
      background-color: #1c203e;
      border-radius: 20px;
      padding: 2rem;
      max-width: 400px;
      flex: 1 1 300px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
      transition: transform 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .card h2 {
      text-align: center;
      margin: 0;
      font-size: 1.6rem;
      color: #fff;
    }

    .card h2::after {
      content: "";
      display: block;
      margin: 0.75rem auto 0;
      width: 60px;
      border-bottom: 2px solid #3f4860;
    }

    .card ul {
      list-style: none;
      padding: 0;
      margin: 1.5rem 0;
    }

    .card li {
      margin-bottom: 0.75rem;
      line-height: 1.6;
      font-size: 1rem;
    }

    .card button {
      padding: 0.75rem;
      background: #007bff;
      color: white;
      font-size: 1rem;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }

    .card button:hover {
      background: #005ecf;
    }

    @media (max-width: 768px) {
      .card-wrapper {
        flex-direction: column;
        align-items: center;
      }

      .card {
        width: 90%;
      }
    }


  </style>

  <!-- Select2 CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery and Select2 JS -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
<script src="https://s3.tradingview.com/tv.js"></script>

</head>
<body>

  <header>
    <div class="nav-container">
      <div class="nav-logo">
        <h1 class="site-title">BINARYAITRADE</h1>
      </div>
      <div class="nav-controls">
        <button class="nav-toggle" onclick="toggleNav()">☰</button>
      </div>
      <nav id="navbar">
        <a href="#">Home</a>
        <a href="#">About</a>
        <a href="#">Get Funded</a>
        <a href="#">Bot Trading</a>
        <a href="#">Monthly Challenge</a>
        <a href="#">Contact</a>
        <a href="#">Login</a>
        <a href="#">Register</a>
      </nav>
    </div>
  </header>
  
    <div class="main-content">
        <h1 style="text-align: center; color: #ffcc00; padding-top: 1rem; margin-bottom: -1rem;">BINARYAITRADE</h1>

        <div class="main-content-one">
            <div class="promo-text">
            <h2>Unlock Your Trading Potential with <span class="highlight">BINARYAITRADE</span></h2>
            <p class="intro">Every trade counts. Every trader matters. Discover next-gen tools, automation, and opportunity tailored for you.</p>

            <div class="feature">
                <h3>🚀 Proprietary Challenge Accounts</h3>
                <p>Prove your strategy with our challenge accounts. Hit your goals, manage risk, and get funded with real capital.</p>
            </div>

            <div class="feature">
                <h3>🤖 AI-Powered Trading Bots</h3>
                <p>Let our smart bots scan the markets 24/7. Precision and power at your fingertips—subscribe and automate your edge.</p>
            </div>

            <div class="feature">
                <h3>🏆 Monthly Demo Contests</h3>
                <p>Battle the best in our monthly leaderboard contest. Purchase your spot, trade your way up, and win real cash rewards!</p>
            </div>

            <div class="feature">
                <h3>⚡ 5-Minute Binary Options</h3>
                <p>Feeling confident? Choose Buy or Sell and get your result in just 5 minutes. Fast-paced, strategic, and packed with opportunity.</p>
            </div>
            </div>

            <div class="form-container">
                <!-- TradingView Widget END -->
                <h3>Start to trade now!</h3>
                <form>
                    <label for="firstname">Firstname</label>
                    <input type="text" id="firstname" name="firstname">

                    <label for="lastname">Lastname</label>
                    <input type="text" id="lastname" name="lastname">

                    <livewire:country />

                    <label for="email" style="margin-top: 1rem;">E-mail</label>
                    <input type="email" id="email" name="email">

                    <label>
                    <input type="checkbox" name="terms"> I accept the <a href="#">Terms and Conditions</a>
                    </label>

                    <button type="submit">OPEN AN ACCOUNT</button>
                </form>

                <!-- <div>
                    <h2 class="option-heading" style="text-align: center; padding-top: 1rem;">5 Minutes Binary Option</h2>
                    <div class="trade-container">
                        <div class="timer" id="timer">--:--:--</div>

                        <div class="asset-bar">
                            <select id="asset">
                                <option value="BTC">Bitcoin</option>
                            </select>
                            <input type="text" id="countdown" value="00:36" readonly />
                        </div>

                        <div class="price" id="price">103600</div>

                        <div class="action-buttons">
                            <button class="high">HIGH</button>
                            <button class="low">LOW</button>
                        </div>

                        <div class="info-line">
                            <span>Closing:</span>
                            <span id="closing-time">21 JUN 16:43:00</span>
                        </div>

                        <div class="investment-payouts">
                            <div>
                                <label>Investments:</label>
                                <select>
                                <option>$10</option>
                                </select>
                            </div>
                            <div>
                                <label>Payouts:</label>
                                <span>$17.60 (76%)</span>
                            </div>
                        </div>

                        <button class="trade-btn">TRADE</button>
                    </div>
                </div> -->
            </div>
        </div>

        <div><hr></div>
        
        <div class="main-content-two">
          <style>
            .tradingview-widget-container {
              width: 100%;
              max-width: 700px;
              padding: 1rem;
              box-sizing: border-box;
            }

            #tradingview_chart {
              width: 100%;
              height: 500px !important;
            }

            @media (max-width: 600px) {
              #tradingview_chart {
                min-height: 300px;
              }

              h2, label, select {
                display: block;
                width: 100%;
                font-size: 1rem;
                margin-bottom: 0.5rem;
              }

              select {
                padding: 0.4rem;
              }
            }
          </style>

          <div class="tradingview-widget-container">
            <h2>Live Market Chart</h2>

            <div id="tradingview_chart"></div>

          </div>

          <div style="max-with: 450px;">
              <h2 class="option-heading" style="text-align: center; padding-top: 1rem;">5 Minutes Binary Option</h2>
              <div class="trade-container">
                  <div class="timer" id="timer">--:--:--</div>

                  <div class="asset-bar">
                      <select class="asset" id="symbolSelect" onchange="updateChartSymbol()">
                          <option value="BINANCE:BTCUSDT">BTC/USDT</option>
                          <option value="BINANCE:ETHUSDT">ETH/USDT</option>
                          <option value="BINANCE:SOLUSDT">SOL/USDT</option>
                          <option value="BINANCE:XRPUSDT">XRP/USDT</option>
                      </select>
                      <input type="text" id="countdown" value="00:36" readonly />
                  </div>

                  <div class="price" id="price">103600</div>

                  <div class="action-buttons">
                      <button class="high">HIGH</button>
                      <button class="low">LOW</button>
                  </div>

                  <div class="info-line">
                      <span>Closing:</span>
                      <span id="closing-time">21 JUN 16:43:00</span>
                  </div>

                  <div class="investment-payouts">
                      <div>
                          <label>Investments:</label>
                          <select>
                          <option>$10</option>
                          </select>
                      </div>
                      <div>
                          <label>Payouts:</label>
                          <span>$17.60 (76%)</span>
                      </div>
                  </div>

                  <button class="trade-btn">TRADE</button>
              </div>
          </div>

        </div>


        <div class="container-evaluation">
          <div class="section-title">Choose Funding Programs</div>
          <div class="card-wrapper">

            <div class="card">
              <h2>Evaluation Program</h2>
              <ul>
                <li>✅ 2 Phase Challenge</li>
                <li>💰 Trade up to $200,000</li>
                <li>🚀 The best way to show us your skills</li>
              </ul>
              <button>Get Started</button>
            </div>

            <div class="card">
              <h2>Fast Funding</h2>
              <ul>
                <li>✅ 1 Phase Challenge</li>
                <li>💰 Trade up to $100,000</li>
                <li>⚡ One stage only challenge to get funded fast</li>
              </ul>
              <button>Start Now</button>
            </div>

          </div>

          <!-- <livewire:purchase-account /> -->
          <section style="max-width: 1000px; margin: auto; padding: 40px 20px; font-family: sans-serif;">
            <h2 style="font-size: 28px; margin-bottom: 15px; text-align: center;">AI-Powered Trading Assistant</h2>
            <div style="display: flex; flex-wrap: wrap; align-items: flex-start; justify-content: space-between;">
              <div style="flex: 1 1 300px; padding: 20px;">
                <img src="{{url('binary/ai.png')}}" alt="AI Trading Bot" style="width: 100%; height: auto; border-radius: 10px;">
              </div>
              <div style="flex: 1 1 300px; padding: 20px">
                <p style="font-size: 16px; line-height: 1.6; margin-top: -3rem; padding-top: 5rem;">
                  Meet your intelligent trading companion. This AI trading bot helps you analyze market trends, execute trades faster than ever, and minimize emotional decision-making. Powered by cutting-edge machine learning, it adapts to your strategy and stays ahead of market shifts.
                </p>
              </div>
            </div>
          </section>

        </div>

    </div>

    <!-- Footer -->
    <footer class="footer">
      <div class="footer-container">
        <div class="footer-section">
          <h2>BinaryAiTrade</h2>
          <p>Your gateway to financial freedom through currency, crypto, and futures trading. 
            From funding aspiring traders to building elite strategies, our prop firm model sets the standard.
          </p>
        </div>
        <div class="footer-section">
          <h3>Explore</h3>
          <ul>
            <li><a href="#">Options Trading</a></li>
            <li><a href="#">Crypto Bots</a></li>
            <li><a href="#">Monthly Challenge</a></li>
            <li><a href="#">BOT trading</a></li>
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
