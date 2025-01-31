<?php
$link = mysqli_connect('localhost:3306', 'root', '', 'roocket');

if (!$link) {
    echo 'could not connect : ' . mysqli_connect_error();
    exit;
}


$namekarbar = $_POST['namekarbar'];
$password = $_POST['password'];
$esm = $_POST['esm'];
$famile = $_POST['famil'];


$query = "INSERT INTO users (namekarbar, password, esm, famil) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($link, $query);
mysqli_stmt_bind_param($stmt, "ssss", $namekarbar, $password, $esm, $famile);
$result = mysqli_stmt_execute($stmt);

if (!$result) {
    echo 'error : ' . mysqli_error($link);
} else {
    header("Location: listusers.php");
}

?>
