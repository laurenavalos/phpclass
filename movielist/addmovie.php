<?php
include "../includes/newdb.php";

if (!empty($_POST["txtTitle"]) && !empty($_POST["txtRating"])) {

    $txtTitle = $_POST["txtTitle"];
    $txtRating = $_POST["txtRating"];

    try {
        $sql = mysqli_prepare($con, "INSERT INTO movielist (movieTitle, movieRating) VALUES (?, ?)");

        mysqli_stmt_bind_param($sql, "ss", $txtTitle, $txtRating);

    } catch (mysqli_sql_exception $ex) {
        echo $ex;
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

        .grid-header {
            grid-area: header;text-align: center;
        }

        .movie-title {
            grid-area: MovieTitle;
        }

        .title-input {
            grid-area: TitleInput;
        }

        .movie-rating {
            grid-area: MovieRating;
        }

        .rating-input {
            grid-area: RatingInput;
        }

        .grid-footer {
            grid-area: footer;
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
        <form method="post">
            <div class="grid-container">
                <div class="grid-header">
                    <h3>Add new movie</h3>
                </div>
                <div class="movie-title">
                    <label for="txtTitle">Movie Title</label>
                </div>
                <div class="title-input">
                    <input type="text" name="txtTitle" id="txtTitle" required>
                </div>

                <div class="movie-rating">
                    <label for="txtRating">Movie Rating</label>
                </div>
                <div class="rating-input">
                    <input type="text" name="txtRating" id="txtRating" required>
                </div>

                <div class="grid-footer">
                    <input type="submit" value="Add Movie">
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
