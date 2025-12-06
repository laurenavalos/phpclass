<?php

session_start();

if (!empty($_POST["txtEmail"]) && !empty($_POST["txtPassword"])) {

    $Email = $_POST["txtEmail"];
    $passwd = $_POST["txtPassword"];

    include "../includes/newdb.php";
    $sql = mysqli_prepare($con, "Select memberPassword, memberKey, roleID, memberID from memberLogin where memberEmail = ?");
    mysqli_stmt_bind_param($sql, "s", $Email);
    mysqli_stmt_execute($sql);
    $result = mysqli_stmt_get_result($sql);
    $row = mysqli_fetch_array($result);

    if ($row != null) {
        $DBPass = $row["memberPassword"];
        $memberKey = $row["memberKey"];
        $passwd = md5($passwd . $memberKey);

        if ($passwd == $DBPass) {
            $_SESSION["roleID"] = $row["roleID"];
            $_SESSION["UID"] = $row["roleID"];
            if ($row["roleID"] == 1) {
                header("Location: admin.php");
            } else {
                header("Location: member.php");
            }
        } else {
            $msg = "Sorry wrong username OR password";
        }

    } else {
        $msg = "Sorry wrong username OR password";
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
    <title>Lauren's Website</title>
    <link rel="stylesheet" href="/css/base.css">
    <style>
        .item1 {grid-area: header}
        .item2 {grid-area: Username}
        .item3 {grid-area: UsernameInput}
        .item4 {grid-area: Password}
        .item5 {grid-area: PasswordInput}
        .item6 {grid-area: footer}

        .grid-container {
            margin-top: 50px;
            display: grid;
            grid-template-areas:
                'header header'
                'Username UsernameInput'
                'Password PasswordInput'
                'footer footer';
            padding: 0;
        }
        div{
            border: 1px solid;
            text-align: center;
            padding: 10px;
            font-size: 20px;
        }
    </style>
</head>
<body>
<?php
include "../includes/header.php";
?>
<div id="three-column">
    <?php
    include "../includes/nav.php";
    ?>
    <main>
        <h3 id="err"><?=$msg?></h3>

        <form method="post">
            <div class="grid-container">
                <div class="item1"><h3>User Login</h3></div>
                <div class="item2">Email Address</div>
                <div class="item3"><input type="text" name="txtEmail" id="txtEmail" size="60"/></div>
                <div class="item4">Password</div>
                <div class="item5"><input type="password" name="txtPassword" id="txtPassword" size="60"/></div>
                <div class="item6"><input type="submit" value="Login"/></div>
            </div>
        </form>
    </main>
</div>
<?php
include "../includes/footer.php";
?>
</body>
</html>
