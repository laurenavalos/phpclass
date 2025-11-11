<?php
include "../includes/newdb.php";

if (!isset($_GET['id'])) {
    header("Location:viewcustomers.php");
    exit;
}

$id = $_GET['id'];

try {
    $sql = mysqli_prepare($con, "DELETE FROM customers WHERE customerID = ?");
    mysqli_stmt_bind_param($sql, "i", $id);
    mysqli_stmt_execute($sql);

    header("Location:viewcustomers.php");
} catch (mysqli_sql_exception $ex) {
    echo $ex;
}

