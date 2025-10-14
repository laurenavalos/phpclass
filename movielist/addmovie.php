<?php
    $errorMessage = "";
    if (!empty($_GET["txtTitle"]) && !empty($_GET["txtRating"])) {
        include "../includes/newdb.php";
        $con = getDBConnection();

        $txtTitle = $_GET["txtTitle"];
        $txtRating = $_GET["txtRating"];
        try{
            $query = "INSERT INTO movielist (MovieTitle, MovieRating) VALUES (?,?);";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "ss", $txtTitle, $txtRating);
            mysqli_stmt_execute($stmt);
            header("location: /movielist");
        }
        catch(mysqli_sql_exception $ex){
            //echo $ex;
            $errorMessage = $ex;
        }
    }

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lauren's Website</title>
    <link rel = "stylesheet" href = "/css/base.css">
    <link rel = "stylesheet" href = "./css/grid.css"
 </head>
<body>
<?php
include "../includes/header.php";
?>
<div id = "three-column">
    <?php
    include "../includes/nav.php";
    ?>
    <main>
        <form method = "get">
        <div class = "grid-container">
            <div class = "grid-header">
                <h3>Add new movie</h3>
            </div>
            <div class = "movie-title">
                <label for = "txtTitle">Movie Title</label>
            </div>
            <div class = "title-input">
                <input type = "text" name = "txtTitle" id = "txtTitle">
            </div>

            <div class = "movie-rating">
                <label for = "txtRating">Movie Rating</label>
            </div>
            <div class = "rating-input">
                <input type = "text" name = "txtRating" id = "txtRating">
            </div>
            <div class = "error <?php echo $errorMessage == "" ? "hidden" : "" ?>">
                <p><?=$errorMessage;?></p>
            </div>
            <div class = "grid-footer">
                <input type = "submit" value = "Add Movie">
            </div>
        </div>
        </form>
    </main>
</div>
<?php
include "../includes/footer.php";
?>
</body>
</html>
