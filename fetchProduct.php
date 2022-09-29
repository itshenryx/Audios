<?php
//session_start();

function selectMax($order)
{
    require "connect.php";
    $sql = "SELECT * FROM audio ORDER BY price DESC LIMIT 1 OFFSET $order";;
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        return mysqli_fetch_assoc($result);
    }
    return 1;
}

function selectMaxLikes($order)
{
    require "connect.php";
    $sql = "SELECT * FROM audio ORDER BY likes DESC LIMIT 1 OFFSET $order";;
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        return mysqli_fetch_assoc($result);
    }
    return 1;
}

function ascendingOrder($order)
{
    require "connect.php";
    $sql = "SELECT * FROM audio ORDER BY bookName DESC LIMIT 1 OFFSET $order";;
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        return mysqli_fetch_assoc($result);
    }
    return 1;
}

function countBooks(){
    require "connect.php";
    $sql = "SELECT COUNT(audioID) AS count FROM audio";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        return mysqli_fetch_assoc($result);
    }

    return $result;
}

function fetchBook($increment)
{
    $id = 0;
    require "connect.php";
    $sql = "SELECT * FROM audio ORDER BY price DESC LIMIT 1 OFFSET $order";;
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        return mysqli_fetch_assoc($result);
    }
    return 1;
}

function countOwnedBooks($personID){
    require "connect.php";

    $sql = "SELECT COUNT(audioID) AS count FROM ownedbooks WHERE personID='$personID'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        return mysqli_fetch_assoc($result);
    }

    return $result;
}

function selectOwnedBooks($order,$personID)
{
    require "connect.php";

    $sql = "SELECT * FROM ownedbooks WHERE personID='$personID' ORDER BY transactionID DESC LIMIT 1 OFFSET $order";
    $result = mysqli_query($conn, $sql);
    $audioID = mysqli_fetch_assoc($result)['audioID'];

    $sql2 = "SELECT * FROM audio WHERE audioID='$audioID'";
    $result2 = mysqli_query($conn, $sql2);

    if (mysqli_num_rows($result) === 1) {
        return mysqli_fetch_assoc($result2);
    }
    return 1;
}

function checkIfLiked($order,$personID)
{
    require "connect.php";

    $sql = "SELECT * FROM ownedbooks WHERE personID='$personID' ORDER BY transactionID DESC LIMIT 1 OFFSET $order";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result)['likes'];
}

function countLikes($bookID){
    require "connect.php";
    $sql = "SELECT COUNT(audioID) AS count FROM ownedbooks WHERE audioID='$bookID' AND likes ='1'";
    $result = mysqli_query($conn, $sql);

    return mysqli_fetch_assoc($result);
}

function checkIfOwned($personID,$audioID){
    require "connect.php";
    $sql = "SELECT * FROM ownedbooks WHERE personID='$personID' and audioID='$audioID'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        return 1;
    }
    return 0;
}