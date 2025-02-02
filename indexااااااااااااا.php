
// اتصال به دیتابیس news_system
//$link = mysqli_connect('localhost:3306', 'root', '', 'news_system');

//if (!$link) {
//    echo 'Could not connect: ' . mysqli_connect_error();
//    exit;
//}

// اضافه کردن ستون category به جدول news
//$SQL = "ALTER TABLE news ADD author VARCHAR(255) NOT NULL AFTER title;";
//
//if (mysqli_query($link, $SQL)) {//
 //   echo 'ستون category با موفقیت به جدول news اضافه شد.';
//} else {//
 //   echo 'خطا: ' . mysqli_error($link);
//}

//mysqli_close($link);
//





// اتصال به دیتابیس news_system
//$link = mysqli_connect('localhost:3306', 'root', '', 'news_system');

//if (!$link) {
//    echo 'Could not connect: ' . mysqli_connect_error();
//    exit;
//}

// اضافه کردن ستون confirm به جدول news
//$SQL = "ALTER TABLE news ADD confirm TINYINT(1) NOT NULL DEFAULT 0 CHECK (confirm IN (0, 1));";

//if (mysqli_query($link, $SQL)) {
 //   echo 'ستون confirm با موفقیت به جدول news اضافه شد.';
//} else {
 //   echo 'خطا: ' . mysqli_error($link);
//}

//mysqli_close($link);


<?php
// اتصال به دیتابیس news_system
$link = mysqli_connect('localhost:3306', 'root', '', 'news_system');

if (!$link) {
    echo 'Could not connect: ' . mysqli_connect_error();
    exit;
}


// اضافه کردن ستون تایم به جدول news
$SQL_time = "ALTER TABLE news ADD تایم TIMESTAMP DEFAULT CURRENT_TIMESTAMP;";

if (mysqli_query($link, $SQL_time)) {
    echo 'ستون تایم با موفقیت به جدول news اضافه شد.';
} else {
    echo 'خطا در اضافه کردن ستون تایم: ' . mysqli_error($link);
}

mysqli_close($link);
?>