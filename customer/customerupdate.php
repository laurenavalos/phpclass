<?php
include "../includes/newdb.php";

if (!empty($_POST["txtFirst"]) && !empty($_POST["txtLast"])) {
    $txtFirst   = $_POST["txtFirst"];
    $txtLast    = $_POST["txtLast"];
    $txtAddress = $_POST["txtAddress"];
    $txtCity    = $_POST["txtCity"];
    $txtState   = $_POST["txtState"];
    $txtZip     = $_POST["txtZip"];
    $txtPhone   = $_POST["txtPhone"];
    $txtEmail   = $_POST["txtEmail"];
    $customerID = $_POST["txtID"];

    try {
        $sql = mysqli_prepare($con, "UPDATE customers SET first=?, last=?, address=?, city=?, state=?, zip=?, phone=?, email=? WHERE customerID=?");
        mysqli_stmt_bind_param($sql, "ssssssssi", $txtFirst, $txtLast, $txtAddress, $txtCity, $txtState, $txtZip, $txtPhone, $txtEmail, $customerID);
        mysqli_stmt_execute($sql);

        header("Location:viewcustomers.php");
        exit;
    } catch (mysqli_sql_exception $ex) {
        echo $ex;
    }
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = mysqli_prepare($con, "SELECT * FROM customers WHERE customerID=?");
    mysqli_stmt_bind_param($sql, "i", $id);
    mysqli_stmt_execute($sql);
    $result = mysqli_stmt_get_result($sql);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        echo "Customer not found.";
        exit;
    }

    $txtFirst   = $row["first"];
    $txtLast    = $row["last"];
    $txtAddress = $row["address"];
    $txtCity    = $row["city"];
    $txtState   = $row["state"];
    $txtZip     = $row["zip"];
    $txtPhone   = $row["phone"];
    $txtEmail   = $row["email"];
} else {
    header("Location:viewcustomers.php");
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Customer</title>
    <link rel="stylesheet" href="/css/base.css">
    <style>
        .grid-container {
            margin-top: 50px;
            display: grid;
            grid-template-areas:
                'header header'
                'FirstLabel FirstInput'
                'LastLabel LastInput'
                'AddressLabel AddressInput'
                'CityLabel CityInput'
                'StateLabel StateInput'
                'ZipLabel ZipInput'
                'PhoneLabel PhoneInput'
                'EmailLabel EmailInput'
                'footer footer';
            gap: 5px;
        }

        .grid-header { grid-area: header; text-align: center; }
        .first-label { grid-area: FirstLabel; }
        .first-input { grid-area: FirstInput; }
        .last-label { grid-area: LastLabel; }
        .last-input { grid-area: LastInput; }
        .address-label { grid-area: AddressLabel; }
        .address-input { grid-area: AddressInput; }
        .city-label { grid-area: CityLabel; }
        .city-input { grid-area: CityInput; }
        .state-label { grid-area: StateLabel; }
        .state-input { grid-area: StateInput; }
        .zip-label { grid-area: ZipLabel; }
        .zip-input { grid-area: ZipInput; }
        .phone-label { grid-area: PhoneLabel; }
        .phone-input { grid-area: PhoneInput; }
        .email-label { grid-area: EmailLabel; }
        .email-input { grid-area: EmailInput; }
        .grid-footer { grid-area: footer; text-align: center; margin-top: 10px; }
    </style>
    <script type="text/javascript">

        function DeleteCustomer(id) {
            if (confirm("Are you sure you want to DELETE this customer?")) {
                window.location.href = 'deletecustomer.php?id=' + id;
            }
        }
    </script>
</head>
<body>
<?php include "../includes/header.php"; ?>
<div id="three-column">
    <?php include "../includes/nav.php"; ?>
    <main>
        <form method="post">
            <div class="grid-container">
                <div class="grid-header"><h3>Update Customer</h3></div>

                <div class="first-label"><label for="txtFirst">First Name</label></div>
                <div class="first-input"><input type="text" name="txtFirst" id="txtFirst" value="<?= htmlspecialchars($txtFirst) ?>"></div>

                <div class="last-label"><label for="txtLast">Last Name</label></div>
                <div class="last-input"><input type="text" name="txtLast" id="txtLast" value="<?= htmlspecialchars($txtLast) ?>"></div>

                <div class="address-label"><label for="txtAddress">Address</label></div>
                <div class="address-input"><input type="text" name="txtAddress" id="txtAddress" value="<?= htmlspecialchars($txtAddress) ?>"></div>

                <div class="city-label"><label for="txtCity">City</label></div>
                <div class="city-input"><input type="text" name="txtCity" id="txtCity" value="<?= htmlspecialchars($txtCity) ?>"></div>

                <div class="state-label"><label for="txtState">State</label></div>
                <div class="state-input"><input type="text" name="txtState" id="txtState" value="<?= htmlspecialchars($txtState) ?>"></div>

                <div class="zip-label"><label for="txtZip">Zip</label></div>
                <div class="zip-input"><input type="text" name="txtZip" id="txtZip" value="<?= htmlspecialchars($txtZip) ?>"></div>

                <div class="phone-label"><label for="txtPhone">Phone</label></div>
                <div class="phone-input"><input type="text" name="txtPhone" id="txtPhone" value="<?= htmlspecialchars($txtPhone) ?>"></div>

                <div class="email-label"><label for="txtEmail">Email</label></div>
                <div class="email-input"><input type="email" name="txtEmail" id="txtEmail" value="<?= htmlspecialchars($txtEmail) ?>"></div>

                <div class="grid-footer">
                    <input type="submit" value="Update Customer"/>
                    <br><br>
                    <!-- Delete Button -->
                    <input type="button" value="Delete Customer" onclick="DeleteCustomer('<?= $id ?>')">
                </div>
            </div>
            <input type="hidden" name="txtID" value="<?= $id ?>">
        </form>
    </main>
</div>
<?php include "../includes/footer.php"; ?>
</body>
</html>
