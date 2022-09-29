<?php
    include 'connect.php';
    session_start();

    $bookID = $_GET['bookID'];
    $personID = $_SESSION['personID'];
    $price = $_GET['price'];
    $credits = $_SESSION['credits'];
    $_SESSION['credits'] = $credits - $price;
    $finalPrice = $_SESSION['credits'];

    $sql = "INSERT INTO ownedbooks(personID, audioID) VALUES('$personID','$bookID')";
    $sql2 = "UPDATE person SET credits='$finalPrice' WHERE personID = '$personID'";

    $result = mysqli_query($conn, $sql);
    $result = mysqli_query($conn, $sql2);
    $_SESSION['ownedBooks'] = $_SESSION['ownedBooks'] + 1;

    header("Location: product.php?bookID=$bookID");