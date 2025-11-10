<?php
include "../includes/newdb.php";

if (!empty($_POST["txtTitle"]) && !empty($_POST["txtRating"])) {
    $txtTitle = $_POST["txtTitle"];
    $txtRating = $_POST["txtRating"];
    $txtID = $_POST["txtID"];

    try {
        // Fixed SQL: removed extra comma
        $sql = mysqli_prepare($con, "UPDATE movielist SET movieTitle = ?, movieRating = ? WHERE movieID = ?");
        mysqli_stmt_bind_param($sql, "ssi", $txtTitle, $txtRating, $txtID);
        mysqli_stmt_execute($sql);

        header("Location:index.php");
    } catch (mysqli_sql_exception $ex) {
        echo $ex;
    }
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = mysqli_prepare($con, "SELECT * FROM movielist WHERE movieID = ?");
    mysqli_stmt_bind_param($sql, "i", $id);
    mysqli_stmt_execute($sql);
    $result = mysqli_stmt_get_result($sql);
    $row = mysqli_fetch_array($result);

    $txtTitle = $row["movieTitle"];
    $txtRating = $row["movieRating"];
} else {
    header("Location:index.php");
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
    <script type="text/javascript">
        function DeleteMovie(title,id){
            if(confirm("Are you sure you want to DELETE " + title + "?")){
                document.location.href = 'delete.php?id=' + id;
            }
        }
    </script>
    <link rel="stylesheet" href="/css/base.css">
    <link rel="stylesheet" href="./css/grid.css">
    <style>
        .grid-container {
            margin-top: 50px;
            display: grid;
            grid-template-areas:
                'header header'
                'MovieTitle TitleInput'
                'MovieRating RatingInput'
                'footer footer';
            padding: 0;
        }

        .grid-header { grid-area: header; text-align: center; }
        .movie-title { grid-area: MovieTitle; }
        .title-input { grid-area: TitleInput; }
        .movie-rating { grid-area: MovieRating; }
        .rating-input { grid-area: RatingInput; }
        .grid-footer { grid-area: footer; }
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
                    <h3>Update Movie</h3>
                </div>

                <div class="movie-title">
                    <label for="txtTitle">Movie Title</label>
                </div>
                <div class="title-input">
                    <input type="text" name="txtTitle" id="txtTitle" value="<?= $txtTitle ?>">
                </div>

                <div class="movie-rating">
                    <label for="txtRating">Movie Rating</label>
                </div>
                <div class="rating-input">
                    <input type="text" name="txtRating" id="txtRating" value="<?= $txtRating ?>">
                </div>

                <div class="grid-footer">
                    <input type="submit" value="Update Movie"/> | <input type="button" value="Delete Movie" onclick="DeleteMovie('<?= $txtTitle ?>', '<?= $id ?>')"/>
                </div>
            </div>
            <input type="hidden" name="txtID" value="<?= $id ?>">
        </form>
    </main>
</div>

<?php include "../includes/footer.php"; ?>
</body>
</html>


