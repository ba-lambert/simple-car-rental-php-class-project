<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.html"); // Redirect to the login page if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <script src="dashboard.js"></script>
</head>
<body>
    <header class="dashboard-header">
        <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
        <a href="logout.php">Logout</a>
    </header>

    <section class="dashboard-content">
        <div class="widget">
            <h2>Number of Users</h2>
            <p id="user-count">Loading...</p>
        </div>

        <div class="widget">
            <h2>Number of Clients</h2>
            <p id="client-count">Loading...</p>
        </div>
    </section>
    <div class="widget">
    <iframe src="table.php" frameborder="0" width="100%" height="500px"></iframe>
</div>
</div>
    <script>
fetch('http://localhost/classWork/webTechnology/carRental/get_counts.php')
    .then(response => response.json())
    .then(data => {
        console.log(data); // Check the response in the console
        // Update the user count widget
        document.getElementById('user-count').textContent = data.userCount;
        // Update the client count widget
        document.getElementById('client-count').textContent = data.clientCount;
    })
    .catch(error => console.error('Error:', error));
</script>
</body>
</html>
