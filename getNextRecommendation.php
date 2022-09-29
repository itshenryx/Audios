<?php

function getNext($genre,$offset){
    require "connect.php";

    $sql = "SELECT audioID,bookName FROM audio WHERE ".$genre."=1 ORDER BY likes DESC LIMIT 1 OFFSET $offset";
    $result = mysqli_query($conn,$sql);
    $recommendedBook = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) == 1){
        return $recommendedBook['audioID'];
    }
    else {
        return -1;
    }
}