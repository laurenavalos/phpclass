<?php

if(isset($_GET["id"])) {
    $id = $_GET["id"];
    include "../includes/newdb.php";

    try {
        $sql = mysqli_prepare($con, "delete from movielist where movieID = ?");
        mysqli_stmt_bind_param($sql, "s", $id);
        mysqli_stmt_execute($sql);
    } catch (mysqli_sql_exception $ex) {
        echo $ex;
    }
}
header("Location: /movielist");