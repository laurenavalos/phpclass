<?php
include "../includes/newdb.php";

if (!empty($_POST["first"]) && !empty($_POST["last"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["confirm"])) {

    $first = $_POST["first"];
    $last = $_POST["last"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $zip = $_POST["zip"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm = $_POST["confirm"];

    if ($password !== $confirm) {
        $error = "Passwords do not match!";
    } else {
        try {
            $con = mysqli_connect("localhost", "dbuser", "dbdev123", "customer");

            $sql = mysqli_prepare($con, "INSERT INTO customers (first, last, address, city, state, zip, phone, email, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($sql, "sssssssss", $first, $last, $address, $city, $state, $zip, $phone, $email, $password);
            mysqli_stmt_execute($sql);

            $success = "Customer added successfully!";
        } catch (mysqli_sql_exception $ex) {
            $error = $ex->getMessage();
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
    <link rel="stylesheet" href="/css/base.css">
</head>
<body>
<?php include "../includes/header.php"; ?>
<div id="three-column">
    <?php include "../includes/nav.php"; ?>
    <main>
        <form method="post">
            <h3>Add New Customer</h3>


            <label for="first">First Name</label>
            <input type="text" name="first" id="first" required>

            <label for="last">Last Name</label>
            <input type="text" name="last" id="last" required>

            <label for="address">Address</label>
            <input type="text" name="address" id="address" required>

            <label for="city">City</label>
            <input type="text" name="city" id="city" required>

            <label for="state">State</label>
            <input type="text" name="state" id="state" required>

            <label for="zip">Zip Code</label>
            <input type="text" name="zip" id="zip" pattern="\d{5}" title="Enter 5-digit ZIP" required>

            <label for="phone">Phone</label>
            <input type="tel" name="phone" id="phone" pattern="[0-9]{10}" title="Enter 10-digit phone number" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" minlength="6" required>

            <label for="confirm">Confirm Password</label>
            <input type="password" name="confirm" id="confirm" minlength="6" required>
        </form>
        <input type="submit" value="Add Customer">
        <form action="/customer/viewcustomers.php" method="get">
            <button type="submit">View All Customers</button>
        </form>
    </main>
</div>
<a href="/customer/viewcustomers.php">View All Customers</a>
<?php include "../includes/footer.php"; ?>
</body>
</html>
