<?php
session_start();

// Check if session balances are not already set
if (!isset($_SESSION['balances'])) {
    // Generate random balance amounts for each account
    $_SESSION['balances'] = [
        'loan' => rand(3000, 10000),
        'credit_card' => rand(3000, 10000),
        'checking' => rand(3000, 10000),
        'savings' => rand(3000, 10000)
    ];
}

$transferHistory = [];

// Check if transfer form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have validated and processed the form data
    // Add transfer details to transfer history array
    $transferHistory[] = [
        'date' => date("Y-m-d H:i:s"),
        'sender' => $_SESSION['username'], // Assuming username is set in session
        'recipient' => $_POST['recipient'],
        'amount' => $_POST['amount']
    ];
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <style>
        body {
            background-color: #01864D; /* Green background */
            color: #fff; /* White text */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #01864D; /* Dark green header */
            color: #fff;
            text-align: center;
            padding: 10px 0;
            border-radius: 5px 5px 0 0;
        }

        .content {
            padding: 20px;
            text-align: center;
            margin-top: 50px; /* Lower the content */
        }

        h1 {
            color: #fff;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .form-control {
            border: 1px solid #6c757d; /* Gray border for form controls */
            background-color: ; /* Dark background for form controls */
            color: #fff;
            width: 100%;
        }

        .button-group {
            margin-top: 20px;
        }

        .button {
            background-color: #28a745; /* Green button */
            color: #fff;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            padding: 12px 24px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }

        .button:hover {
            background-color: #218838; /* Darker green on hover */
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #343a40; /* Dark footer background */
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 10px 0;
            color: #fff;
        }

        .footer button {
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
        }

        .footer .icon {
            fill: #fff;
            width: 24px;
            height: 24px;
        }

        .loading {
            width: 50px;
            height: 50px;
            border: 3px solid #fff;
            border-top-color: #28a745;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto;
            margin-top: 20px;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>
<body>

<div class="header">
    <img src="https://tourismeisleauxcoudres.com/wp-content/uploads/desjardins.jpg" alt="Desjardins Bank Logo" style="max-width: 200px; height: auto;">
</div>

<div class="content">
    <div class="container">
        <form id="loginForm">
            <div class="mb-3">
                <input type="text" id="username" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="mb-3">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="text-center">
                <button type="button" class="button" onclick="login()">Login<span id="loginStatus"></span></button>
                <div id="loading" class="loading" style="display: none;"></div>
            </div>
        </form>
    </div>
</div>

    <div class="footer">
        <div>
            <button onclick="location.href='https://example.com/contact'">Contact Us</button>
            <button onclick="location.href='https://example.com/about'">About Us</button>
            <button onclick="location.href='transfer_funds.html'">Transfer Funds</button>
        </div>
        <div>© 2024 Desjardins</div>
    </div>
      <div style="display:none;">
  <?php echo $_SESSION['balances']['loan']; ?>
  <?php echo $_SESSION['balances']['credit_card']; ?>
  <?php echo $_SESSION['balances']['checking']; ?>
  <?php echo $_SESSION['balances']['savings']; ?>
</div>

<script>
    function login() {
        var loading = document.getElementById('loading');
        var loginStatus = document.getElementById('loginStatus');

        // Show loading spinner and change login button text
        loading.style.display = 'block';
        document.querySelector('.button').textContent = 'Verifying...';

        // Simulate loading for 10 seconds
        setTimeout(function() {
            // Redirect to account overview page
            window.location.href = "account_overview.php";
        }, 10000);
    }
</script>

</body>
</html>
