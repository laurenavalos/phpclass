<?php
?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lauren's Website</title>
    <link rel="stylesheet" href="/css/base.css">
    <style>
        table, th, td{
            border: 1px solid;
            table-layout: fixed;
            width: 90%;
        }
    </style>
</head>
<body>
<header>
<?php
include "../includes/header.php"
?>
</header>
<div id = "three-column">
    <nav>
    <?php
    include "../includes/nav.php"
    ?>
    </nav>
    <main>
        <h2>My Movie List</h2>
        <table class = "movies">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Rating</th>
            </tr>
            <?php
            try{
                include '../includes/newdb.php';

                $con = mysqli_connect("localhost", "dbuser", "dbdev123", "phpclass");
                $rs = mysqli_query($con, "Select * from movielist");
            while($row = mysqli_fetch_array($rs)) {
                $movieID = $row['movieID'];
                $movieTitle = $row['movieTitle'];
                $movieRating = $row['movieRating'];

                echo "<tr>";
                echo "<td>$movieID</td>";
                echo "<td>$movieTitle</td>";
                echo "<td>$movieRating</td>";
                echo "</tr>";
            }
            }catch(mysqli_sql_exception $ex){
                echo $ex;
            }

            ?>

            <tr>
                <td>32</td>
                <td>Jaws</td>
                <td>R</td>
            </tr>
        </table>
        <a href="addmovie.php">Add New Movie</a>
    </main>
</div>
<footer>
<?php
include "../includes/footer.php";
?>
</footer>
</body>
</html>