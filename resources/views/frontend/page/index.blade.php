@extends('layouts.frontend')
@section('title', 'BinaryAiTrade - HOME')
@section('meta')
    <meta name="description" content="Welcome to our AI-powered trading platform.">
    <meta name="keywords" content="AI, trading, bot, finance">
@endsection
@section('content')

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
                <h3>🏆 Monthly Contests</h3>
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
    
@endsection