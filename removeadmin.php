<?php

$link = mysqli_connect('localhost:3306', 'root', '', 'roocket');

if (!$link) {
    echo 'could not connect : ' . mysqli_connect_error();
    exit;
}


$id = $_GET['id'];

$query = "UPDATE users SET admin = 0 WHERE id = '$id'";
$result = mysqli_query($link, $query);

if (!$result) {
    echo 'error : ' . mysqli_error($link);
} else {
    echo "ادمین بودن کاربر لغو شد.";
    header("Refresh:0; url=listusers.php"); 
}

?>
