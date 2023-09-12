<!DOCTYPE html>
<html>
<head>
    <title>Car Rental Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
            background-color: white;
            border: 1px solid #ccc;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .delete-button {
            background-color: #ff4d4d; /* Red color code */
            border: none;
            color: white;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 4px;
            font-weight: bold;
        }

        .delete-button:hover {
            background-color: #ff1a1a; /* Darker red color code on hover */
        }

        .delete-button.hidden {
            display: none;
        }

        .action-column {
            text-align: center;
        }

        .back-button {
            background-color: #2196F3; /* Blue-500 color code */
            color: white; /* Text color */
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 4px;
            font-weight: bold;
            text-decoration: none;
        }

        .back-button:hover {
            background-color: #1c87c9;
        }
    </style>
</head> 
<body>
    <h1>Car Rental Data</h1>
    
    <table border="1">
        <tr>
            <th>Full Name</th>
            <th>Email</th>
            <th>Message</th>
            <th class="action-column">Action</th>
        </tr>
    
        <?php
        session_start();

        // Check if the user is logged in
        if (!isset($_SESSION['username'])) {
            header("Location: index.html"); // Redirect to the login page if not logged in
            exit();
        }
        $servername = "localhost";
        $username = "root"; 
        $password = "";
        $dbname = "carrental"; 
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT fullNames, email, message FROM client";

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // Output data in a table row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["fullNames"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["message"] . "</td>";
                echo "<td class='action-column'><button class='delete-button' onclick='deleteRow(this)'>Delete</button></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No data found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
    <a href="./index.html" class="back-button">BACK</a>
    <script>
        function deleteRow(button) {
            var row = button.parentNode.parentNode;
            var fullName = row.cells[0].textContent;

            var confirmDelete = confirm("Are you sure you want to delete " + fullName + "?");
            if (confirmDelete) {
                // Use fetch API to send a POST request to delete_row.php
                fetch('http://localhost/classWork/webTechnology/carRental/delete_row.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'full_name=' + fullName,
                })
                .then(response => response.text())
                .then(data => {
                    console.log(data); // Log the response from delete_row.php
                    row.parentNode.removeChild(row); // Remove row from table
                })
                .catch(error => console.error('Error:', error));
            }
        }
    </script>
</body>
</html>
