<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="css/Dashboard.css">
    <title>Dashboard</title>
    
    <style>
        .construction-notice {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: rgba(0, 0, 0, 0.8);
            color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            display: none; /* Initially hidden */
            z-index: 9999; /* Ensure it's above other content */
        }

        .construction-notice p {
            margin: 0;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="Section_top">
        <div class="tile" id="tile">
            <div class="content">
                <h1>𝕊𝕋𝕌𝔻𝔼ℕ𝕋 𝔸𝕋𝕋𝔼ℕ𝔻𝔸ℕℂ𝔼</h1>
                <div class="button-container">
                    <a href="Takeattendance.php" class="button-66">Take Attendance</a>
                    <a href="daytodayattendance.php" class="button-66">Day to Day Attendance</a>
                    <a href="Viewattendance.php" class="button-66">View Attendance</a>
                    <a href="export_a_excel.php" class="button-66">Convert to Excel</a>
                    <a href="Studentnewregister.php" class="button-66">Student New Registration</a>
                    <a href="Staffnewregister.php" class="button-66">Staff New Registration</a>
                    <a href="logout.php" class="button-66 logout-button">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <div class="construction-notice" id="construction-notice">
        <p>This site is under construction.</p>
    </div>

    <script src="js\tileEffect.js"></script>

    <script>
        // Display the construction notice after a delay
        window.addEventListener('load', () => {
            setTimeout(() => {
                document.getElementById('construction-notice').style.display = 'block';
            }, 3000); // 3 seconds delay
        });
    </script>

</body>
</html>
