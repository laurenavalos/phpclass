<?php
session_start();

$MemberKey = sprintf('%04X%04X%04X%04X%04X%04X%04X%04X',
mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535),
mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535),
mt_rand(0, 65535), mt_rand(0, 65535));



$err="";
if(($_SESSION["roleID"]!=1)){
    //header("Location: index.php");
}

if(isset($_POST["btnsubmit"])){
    if(!empty($_POST["txtUsername"])) {
        $Username = $_POST["txtUsername"];
        if(strlen($Username) < 4) {
            $err = "Username must be at least 4 characters.";
        }
    }else{
        $err = "Username is required";
    }
    if(!empty($_POST["txtPassword"])) {
        $Password = $_POST["txtPassword"];
        if(strlen($Password) < 4) {
            $err = "Password must be at least 4 characters.";
        }
    }else{
        $err = "Password is required";
    }
    if(!empty($_POST["txtPassword2"])) {
        $Password2 = $_POST["txtPassword2"];
    }else{
        $Password2 = "";
    }
    if($Password != $Password2){
        $err = "Passwords do not match";
    }
    if(!empty($_POST["txtRole"])) {
        $Role = $_POST["txtRole"];
    }else{
        $err = "Role is required";
    }
    if(!empty($_POST["txtEmail"])) {
        $Email = $_POST["txtEmail"];
        if (!filter_var($Email, FILTER_VALIDATE_EMAIL) || strpos($Email, '.') === false || strpos($Email, '@') === false) {
            $err = "Email address is invalid.";
        }
    }else{
        $err = "Email is required";
    }
    if($err==""){
        include '../includes/newdb.php';
        $hashedPWD = md5($Password . $MemberKey);

        $roleSelection = "";
        $roleQuery = mysqli_query($con, "SELECT roleID, roleValue FROM role");
        while ($role = mysqli_fetch_assoc($roleQuery)) {
            $roleSelection .= "<option value='" . $role['roleID'] . "'>" . $role['roleValue'] . "</option>";
        }

        $sql = mysqli_prepare($con, "insert into memberLogin(memberName, memberEMail, memberPassword, roleID, memberKey) values(?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($sql, "sssis", $Username, $Email, $hashedPWD, $Role, $MemberKey);
        mysqli_stmt_execute($sql);

        $Username="";
        $Password="";
        $Password2="";
        $Email="";
        $err="Member added to Database";
    }

}

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lauren's Website</title>
    <link rel="stylesheet" href="/css/base.css">
    <style>
            .grid-header {grid-area: header}
            .item2 {grid-area: Username}
            .item3 {grid-area: UsernameInput}
            .item4 {grid-area: Password}
            .item5 {grid-area: PasswordInput}
            .item6 {grid-area: Password2}
            .item7 {grid-area: PasswordInput2}
            .item8 {grid-area: Role}
            .item9 {grid-area: RoleInput}
            .item10 {grid-area: Email}
            .item11 {grid-area: EmailInput}
            .item12 {grid-area: footer}

    .grid-container {
            margin-top: 50px;
            display: grid;
            grid-template-areas:
                'header header'
                'Username UsernameInput'
                'Password PasswordInput'
                'Password2 PasswordInput2'
                'Role RoleInput'
                'Email EmailInput'
                'footer footer';
            padding: 0;
        }
    div{
        border: 1px solid;
        text-align: center;
        padding: 10px;
        font-size: 20px;
    }
    #err{
      color: red;
        margin: 5px;
    }

    </style>
</head>
<body>
<?php
include "../includes/header.php";
?>
<div id = "three-column">
    <nav>
        <?php
        include "../includes/nav.php";
        ?>
    </nav>
    <main>
        <h3>Admin Page</h3>
        <h3 id="err"><?=$err?></h3>
        <form method="post">
            <div class="grid-container">
                <div class="item1"><h3>Add New Member</h3></div>
                <div class="item2">Username</div>
                <div class="item3"><input type="text" name="txtUsername" id="txtUsername" value="<?=$Username?>" size="60"/></div>
                <div class="item4">Password</div>
                <div class="item5"><input type="password" name="txtPassword" id="Password" value="<?=$Password?>" size="60"/></div>
                <div class="item6">ReType Password</div>
                <div class="item7"><input type="password" name="txtPassword2" id="Password2" value="<?=$Password2?>" size="60"/></div>
                <div class="item8">Role</div>
                <div class="item9">
                    <select name="txtRole" id="txtRole">
                        <option value="1">Admin</option>
                        <option value="2">Operator</option>
                        <option value="3">Member</option>
                    </select>
                </div>
                <div class="item10">Email</div>
                <div class="item11"><input type="text" name="txtEmail" id="txtEmail" value="<?=$Email?>" size="60"/></div>
                <div class="item12"><input type="submit" value="Create New User" name="btnsubmit"/></div>
            </div>
        </form>
    </main>
</div>
<?php
include "../includes/footer.php"
?>
</body>
</html>


