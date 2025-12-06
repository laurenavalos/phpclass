<?php
include "../includes/newdb.php";

if (!empty($_POST["first"]) && !empty($_POST["last"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["confirm"])) {
    echo "<p>Form submitted.</p>";

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

    if ($password == $confirm) {
        echo "<p>Passwords match, running insert...</p>";

        $MemberKey = sprintf('%04X%04X%04X%04X%04X%04X%04X%04X',
            mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535),
            mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535),
            mt_rand(0, 65535), mt_rand(0, 65535));

        $hashedPassword = md5($password . $MemberKey);

        try {
            $sql = mysqli_prepare($con, "INSERT INTO customers (first, last, address, city, state, zip, phone, email, password)
                                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($sql, "sssssssss", $first, $last, $address, $city, $state, $zip, $phone, $email, $hashedPassword);
            mysqli_stmt_execute($sql);
            echo "<p>Insert executed. Rows affected: " . mysqli_stmt_affected_rows($sql) . "</p>";
        } catch (mysqli_sql_exception $ex) {
            echo $ex;
        }
    } else {
        echo "Passwords do not match!";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Customer</title>
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="./css/grid.css">
    <style>
        .grid-container {
            margin-top: 50px;
            display: grid;
            grid-template-areas:
                'header header'
                'FirstName FirstInput'
                'LastName LastInput'
                'Address AddressInput'
                'City CityInput'
                'State StateInput'
                'Zip ZipInput'
                'Phone PhoneInput'
                'Email EmailInput'
                'Password PasswordInput'
                'Confirm ConfirmInput'
                'footer footer';
            padding: 0;
        }

        .grid-header { grid-area: header; text-align: center; }

        .grid-footer { grid-area: footer; text-align: center; }

        .FirstName { grid-area: FirstName; }
        .FirstInput { grid-area: FirstInput; }

        .LastName { grid-area: LastName; }
        .LastInput { grid-area: LastInput; }

        .Address { grid-area: Address; }
        .AddressInput { grid-area: AddressInput; }

        .City { grid-area: City; }
        .CityInput { grid-area: CityInput; }

        .State { grid-area: State; }
        .StateInput { grid-area: StateInput; }

        .Zip { grid-area: Zip; }
        .ZipInput { grid-area: ZipInput; }

        .Phone { grid-area: Phone; }
        .PhoneInput { grid-area: PhoneInput; }

        .Email { grid-area: Email; }
        .EmailInput { grid-area: EmailInput; }

        .Password { grid-area: Password; }
        .PasswordInput { grid-area: PasswordInput; }

        .Confirm { grid-area: Confirm; }
        .ConfirmInput { grid-area: ConfirmInput; }
    </style>
</head>
<body>
<?php include "../includes/header.php"; ?>
<div id="three-column">
    <?php include "../includes/nav.php"; ?>
    <main>
        <form method="post">
            <div class="grid-container">
                <div class="grid-header">
                    <h3>Add New Customer</h3>
                </div>

                <div class="FirstName">
                    <label for="first">First Name</label>
                </div>
                <div class="FirstInput">
                    <input type="text" name="first" id="first" required>
                </div>

                <div class="LastName">
                    <label for="last">Last Name</label>
                </div>
                <div class="LastInput">
                    <input type="text" name="last" id="last" required>
                </div>

                <div class="Address">
                    <label for="address">Address</label>
                </div>
                <div class="AddressInput">
                    <input type="text" name="address" id="address">
                </div>

                <div class="City">
                    <label for="city">City</label>
                </div>
                <div class="CityInput">
                    <input type="text" name="city" id="city">
                </div>

                <div class="State">
                    <label for="state">State</label>
                </div>
                <div class="StateInput">
                    <input type="text" name="state" id="state">
                </div>

                <div class="Zip">
                    <label for="zip">Zip Code</label>
                </div>
                <div class="ZipInput">
                    <input type="text" name="zip" id="zip">
                </div>

                <div class="Phone">
                    <label for="phone">Phone</label>
                </div>
                <div class="PhoneInput">
                    <input type="text" name="phone" id="phone">
                </div>

                <div class="Email">
                    <label for="email">Email</label>
                </div>
                <div class="EmailInput">
                    <input type="text" name="email" id="email" required>
                </div>

                <div class="Password">
                    <label for="password">Password</label>
                </div>
                <div class="PasswordInput">
                    <input type="text" name="password" id="password" required>
                </div>

                <div class="Confirm">
                    <label for="confirm">Confirm Password</label>
                </div>
                <div class="ConfirmInput">
                    <input type="text" name="confirm" id="confirm" required>
                </div>

                <div class="grid-footer">
                    <input type="submit" value="Add Customer">
                    <input type="button" value="View All Customers" onclick="document.location.href='/customer/viewcustomers.php'">
                </div>
            </div>
        </form>
    </main>
</div>
<?php include "../includes/footer.php"; ?>
</body>
</html>

