<?php
include "../includes/newdb.php";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer List</title>
    <link rel="stylesheet" href="/css/base.css">
    <style>
        table, th, td {
            border: 1px solid;
            table-layout: fixed;
            width: 90%;
        }
    </style>
</head>
<body>
<?php include "../includes/header.php"; ?>

<div id="three-column">
    <?php include "../includes/nav.php"; ?>
    <main>
        <h2>Customer List</h2>

        <table>
            <tr>
                <th>ID</th>
                <th>First</th>
                <th>Last</th>
                <th>Address</th>
                <th>City</th>
                <th>State</th>
                <th>Zip</th>
                <th>Phone</th>
                <th>Email</th>
            </tr>

            <?php
            try {
                $con = mysqli_connect("localhost", "dbuser", "dbdev123", "customer");
                $result = mysqli_query($con, "SELECT * FROM customers");

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['first']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['last']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['city']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['state']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['zip']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "</tr>";
                }
            } catch (mysqli_sql_exception $ex) {
                echo $ex;
            }
            ?>
        </table>
        <a href="/customer/viewcustomers.php">View All Customers</a>
        <p><a href="addcustomer.php">Add New Customer</a></p>
    </main>
</div>

<?php include "../includes/footer.php"; ?>
</body>
</html>
