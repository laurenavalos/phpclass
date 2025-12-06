<?php
include "../includes/newdb.php";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer List</title>
    <link rel="stylesheet" href="/css/base.css">
    <style>
        table, th, td {
            border: 1px solid;
            border-collapse: collapse;
            padding: 5px;
            width: 90%;
            table-layout: fixed;
        }
        th, td {
            text-align: left;
        }
        a {
            text-decoration: none;
            color: inherit;
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
                <th>City</th>
                <th>State</th>
                <th>Email</th>
                <th>Password (MD5)</th>
            </tr>
            <?php
            try {
                $result = mysqli_query($con, "SELECT * FROM customers");

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['customerID'] . "</td>";
                    echo "<td><a href='customerupdate.php?id=" . $row['customerID'] . "'>" . $row['first'] . "</a></td>";
                    echo "<td><a href='customerupdate.php?id=" . $row['customerID'] . "'>" . $row['last'] . "</a></td>";
                    echo "<td>" . $row['city'] . "</td>";
                    echo "<td>" . $row['state'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['password'] . "</td>";
                    echo "</tr>";
                }
            } catch (mysqli_sql_exception $ex) {
                echo $ex;
            }
            ?>
        </table>
        <p><a href="addcustomer.php">Add New Customer</a></p>
    </main>
</div>
<?php include "../includes/footer.php"; ?>
</body>
</html>
