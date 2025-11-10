<?php
include "../includes/newdb.php";

if (!empty($_POST["txtTitle"]) && !empty($_POST["txtRating"])) {

    $txtTitle = $_POST["txtTitle"];
    $txtRating = $_POST["txtRating"];

    try {
        $sql = mysqli_prepare($con, "INSERT INTO movielist (movieTitle, movieRating) VALUES (?, ?)");
        mysqli_stmt_bind_param($sql, "ss", $txtTitle, $txtRating);
        mysqli_stmt_execute($sql);
    } catch (mysqli_sql_exception $ex) {
        echo $ex;
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lauren's Website</title>
    <link rel="stylesheet" href="/css/base.css">
    <style>
        table, th, td {
            border: 1px solid;
            table-layout: fixed;
            width: 90%;
        }
    </style>
</head>
<body>
<?php include "../includes/header.php"; ?>

<div id="three-column">
    <?php include "../includes/nav.php"; ?>
    <main>
        <h2>Add New Movie</h2>

        <form method="post">
            <table>
                <tr>
                    <th>Movie Title</th>
                    <th>Movie Rating</th>
                </tr>
                <tr>
                    <td>
                        <label for="txtTitle" class="visually-hidden">Movie Title</label>
                        <input type="text" id="txtTitle" name="txtTitle" required>
                    </td>
                    <td>
                        <label for="txtRating" class="visually-hidden">Movie Rating</label>
                        <input type="text" id="txtRating" name="txtRating" required>
                    </td>
                </tr>
            </table>
            <p><input type="submit" value="Add Movie"></p>
        </form>

    </main>
</div>

<?php include "../includes/footer.php"; ?>
</body>
</html>
