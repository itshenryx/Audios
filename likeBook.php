<?php
require "connect.php";

$bookID = $_GET['bookID'];
$personID = $_GET['personID'];

$sql = "UPDATE ownedbooks SET likes = '1' WHERE personID='$personID' AND audioID='$bookID'";
$result = mysqli_query($conn, $sql);

$sqlGenre = "SELECT * FROM audio WHERE audioID='$bookID'";
$resultGenre = mysqli_query($conn, $sqlGenre);
$book = mysqli_fetch_assoc($resultGenre);
if ($book['horror'] == 1){
    $sql2 = "UPDATE person SET horror = horror + 1 WHERE personID ='$personID'";
    $result2 = mysqli_query($conn, $sql2);
}
if ($book['fantasy'] == 1){
    $sql2 = "UPDATE person SET fantasy = fantasy + 1 WHERE personID ='$personID'";
    $result2 = mysqli_query($conn, $sql2);
}
if ($book['comedy'] == 1){
    $sql2 = "UPDATE person SET comedy = comedy + 1 WHERE personID ='$personID'";
    $result2 = mysqli_query($conn, $sql2);
}
if ($book['action'] == 1){
    $sql2 = "UPDATE person SET action = action + 1 WHERE personID ='$personID'";
    $result2 = mysqli_query($conn, $sql2);
}
if ($book['mystery'] == 1){
    $sql2 = "UPDATE person SET mystery = mystery + 1 WHERE personID ='$personID'";
    $result2 = mysqli_query($conn, $sql2);
}

$sql3 = "UPDATE audio SET likes = likes + 1 WHERE audioID = '$bookID'";
$result3 = mysqli_query($conn, $sql3);

header("Location: inventory.php");