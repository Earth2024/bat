<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>7DollarRise - Earn $2 Daily with Referrals</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #3498db;  /* Trust Blue */
            --secondary: #2ecc71; /* Growth Green */
            --accent: #f39c12;   /* Reward Orange */
            --dark: #2c3e50;     /* Dark Blue */
            --light: #ecf0f1;    /* Light Gray */
            --danger: #e74c3c;   /* Alert Red */
        }
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f7fa;
            color: var(--dark);
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 20px 0;
            text-align: center;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .logo {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .tagline {
            font-size: 1.2rem;
            opacity: 0.9;
        }
        .card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            margin: 20px 0;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        .btn {
            display: inline-block;
            padding: 12px 25px;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s;
        }
        .btn:hover {
            background: #e67e22;
            transform: translateY(-2px);
        }
        .btn-primary {
            background: var(--primary);
        }
        .btn-primary:hover {
            background: #2980b9;
        }
        .features {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .feature {
            flex: 1;
            min-width: 250px;
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            background: white;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 15px;
        }
        .how-it-works {
            margin: 40px 0;
        }
        .step {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding: 15px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        .step-number {
            background: var(--accent);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            margin-right: 20px;
        }
        footer {
            text-align: center;
            padding: 20px;
            background: var(--dark);
            color: white;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">7DollarRise</div>
            <div class="tagline">Earn $2 Daily by Inviting Just 7 Friends!</div>
        </div>
    </header>

    <div class="container">
        <div class="card text-center">
            <h2>🚀 Start Earning Today!</h2>
            <p>Register for just <strong>$7</strong>, invite <strong>7 friends</strong>, and unlock <strong>$2 daily USDT rewards</strong>!</p>
            <a href="#register" class="btn btn-primary">Join Now</a>
        </div>

        <div class="features">
            <div class="feature">
                <div class="feature-icon">💰</div>
                <h3>Low Entry</h3>
                <p>Only $7 to start earning daily rewards.</p>
            </div>
            <div class="feature">
                <div class="feature-icon">👥</div>
                <h3>Referral Power</h3>
                <p>Invite 7 friends to unlock $2/day.</p>
            </div>
            <div class="feature">
                <div class="feature-icon">⏱</div>
                <h3>Fast Payouts</h3>
                <p>Withdraw your USDT anytime.</p>
            </div>
        </div>

        <div class="how-it-works">
            <h2>How It Works</h2>
            <div class="step">
                <div class="step-number">1</div>
                <div>
                    <h3>Sign Up & Pay $7</h3>
                    <p>Register and complete your $7 payment to activate your account.</p>
                </div>
            </div>
            <div class="step">
                <div class="step-number">2</div>
                <div>
                    <h3>Invite 7 Friends</h3>
                    <p>Share your referral link and get 7 people to join under you.</p>
                </div>
            </div>
            <div class="step">
                <div class="step-number">3</div>
                <div>
                    <h3>Unlock $2 Daily</h3>
                    <p>Once your team is complete, you earn $2 in USDT every day!</p>
                </div>
            </div>
        </div>

        <div class="card" id="register">
            <h2>Ready to Join?</h2>
            <form>
                <input type="text" placeholder="Your Name" required style="width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px;">
                <input type="email" placeholder="Email Address" required style="width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px;">
                <input type="password" placeholder="Create Password" required style="width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px;">
                <button type="submit" class="btn">Register & Pay $7</button>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 7DollarRise. All rights reserved.</p>
    </footer>
</body>
</html>