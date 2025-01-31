<?php

$link = mysqli_connect('localhost:3306', 'root', '', 'roocket');

if (!$link) {
    echo 'could not connect : ' . mysqli_connect_error();
    exit;
}


$id = $_GET['id'];


$query = "DELETE FROM users WHERE id = '$id'";
$result = mysqli_query($link, $query);

if (!$result) {
    echo 'error : ' . mysqli_error($link);
} else {
    echo "کاربر با موفقیت حذف شد.";
    header("Refresh:0; url=listusers.php"); 
}

?>
