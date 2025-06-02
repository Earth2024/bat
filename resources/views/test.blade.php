<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grid-Based Layout</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: white;
            display: grid;
            grid-template-rows: auto 1fr;
            grid-template-columns: 250px 1fr;
            grid-template-areas: 
                "sidebar navbar"
                "sidebar content";
            min-height: 100vh;
        }

        .sidebar {
            grid-area: sidebar;
            background-color: #1c1c1c;
            padding: 20px;
        }

        .navbar {
            grid-area: navbar;
            background-color: #333;
            padding: 15px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }

        .content {
            grid-area: content;
            padding: 20px;
        }

        nav ul {
            list-style: none;
            padding: 0;
        }

        nav ul li {
            margin-bottom: 10px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
        }

        .menu-toggle {
            display: none;
            cursor: pointer;
            font-size: 24px;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: white;
        }

        @media (max-width: 768px) {
            body {
                grid-template-rows: auto auto 1fr;
                grid-template-columns: 1fr;
                grid-template-areas: 
                    "navbar"
                    "sidebar"
                    "content";
            }

            .sidebar {
                position: absolute;
                width: 100%;
                left: -100%;
                transition: left 0.3s ease-in-out;
            }

            .sidebar.show {
                left: 0;
            }

            .menu-toggle {
                display: block;
            }
        }
    </style>
</head>
<body>

    <div class="navbar">
        <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
        Tesla SpaceX Trade
    </div>

    <aside class="sidebar" id="sidebar">
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Live Trade</a></li>
                <li><a href="#">Plans</a></li>
                <li><a href="#">Transactions</a></li>
                <li><a href="#">Fund Wallet</a></li>
                <li><a href="#">Place Withdrawal</a></li>
                <li><a href="#">Referrals</a></li>
                <li><a href="#">My Account</a></li>
            </ul>
        </nav>
    </aside>

    <section class="content">
        <h2>Welcome to Your Dashboard</h2>
        <p>Your account details and trading insights will be displayed here.</p>
    </section>

    <script>
        function toggleSidebar() {
            document.getElementById("sidebar").classList.toggle("show");
        }
    </script>

</body>
</html>
