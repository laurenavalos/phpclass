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
            padding: 5px;
        }
        th, td {
            text-align: left;
        }
        a {
            color: inherit;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
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
                $rs = mysqli_query($con, "SELECT * FROM customers");

                while ($row = mysqli_fetch_assoc($rs)) {
                    $link = "customerupdate.php?id=" . $row['customerID'];
                    echo "<tr>";
                    echo "<td><a href='$link'>" . $row['customerID'] . "</a></td>";
                    echo "<td><a href='$link'>" . $row['first'] . "</a></td>";
                    echo "<td><a href='$link'>" . $row['last'] . "</a></td>";
                    echo "<td><a href='$link'>" . $row['address'] . "</a></td>";
                    echo "<td><a href='$link'>" . $row['city'] . "</a></td>";
                    echo "<td><a href='$link'>" . $row['state'] . "</a></td>";
                    echo "<td><a href='$link'>" . $row['zip'] . "</a></td>";
                    echo "<td><a href='$link'>" . $row['phone'] . "</a></td>";
                    echo "<td><a href='$link'>" . $row['email'] . "</a></td>";
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
