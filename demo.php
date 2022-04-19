<?php

include "app/database.php";
include "app/helper.php";


for ($i = 1; $i <= 100; $i++) {
    $title = "Title-$i";
    $desc = "
    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Unde, eaque. Totam, reprehenderit iure dignissimos illo veniam perspiciatis ea doloribus nemo nesciunt vero fugiat eligendi, ipsa inventore animi. Aliquam, recusandae aliquid!";

    $qry = "INSERT INTO news SET title = '$title', description = '$desc'";
    try {
        $flag = mysqli_query($conn, $qry);
    } catch (\Exception $err) {
        echo $err->getMessage();
    }
}
