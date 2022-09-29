<?php
session_start();
require "connect.php";
require "getNextRecommendation.php";
require "fetchProduct.php";

$next = $_GET['next'];

$pg1 = $_GET['pg1'];
$pg2 = $_GET['pg2'];
$pg3 = $_GET['pg3'];
$pg4 = $_GET['pg4'];
$pg5 = $_GET['pg5'];

if(!isset($_SESSION['username'])){
    header("Location: browse.php");
}

$personID = $_SESSION['personID'];

$getUserSql = "SELECT * FROM person WHERE personID='$personID'";
$getUserResult = mysqli_query($conn,$getUserSql);
$row = mysqli_fetch_assoc($getUserResult);

$genreArray = array(
    "horror" => $row['horror'],
    "fantasy" => $row['fantasy'],
    "comedy" => $row['comedy'],
    "action" => $row['action'],
    "mystery" => $row['mystery']
    );

//Debuggers
//var_dump($genreArray);
//echo "<p></p>";

//Sort the array using the key values;
arsort($genreArray);
$genre1 = key($genreArray);
array_shift($genreArray);
$genre2 = key($genreArray);
array_shift($genreArray);
$genre3 = key($genreArray);

//..More debugging
//var_dump($genreArray);
//echo key($genreArray);

$visitedPages = array($pg1,$pg2,$pg3,$pg4,$pg5);

if ($next == 0){
    $genre = $genre1;
    $audioID = getNext($genre,0);

    $offset = 0;
    $pass = false;

    while(!$pass){
        if ($audioID == -1){
            $next++;
            header("Location recommend.php?next=$next&pg1=$pg1&pg2=$pg2&pg3=$pg3&pg4=$pg4&pg5=$pg5");
            $pass = true;
        }

        if(in_array("$audioID",$visitedPages)){
            $audioID = getNext($genre, $offset++);
        } else {
            if (checkIfOwned($_SESSION['personID'],$audioID) == 1){
                $audioID = getNext($genre, $offset++);
            } else {
//                array_push($visitedPages, $audioID);
                $pg1 = $audioID;
                $pass = true;
                header("Location: product.php?bookID=$audioID&next=1&pg1=$pg1&pg2=$pg2&pg3=$pg3&pg4=$pg4&pg5=$pg5");
            }
        }
    }

//    if (checkIfOwned($_SESSION['personID'],$audioID) == 1){
//        $next++;
//    } else {
//        $visitedPages[] = $audioID;
//        header("Location: product.php?bookID=$audioID&next=1");
//    }

}

if ($next == 1){
    $genre = $genre1;
    $audioID = getNext($genre,1);

    $offset = 1;
    $pass = false;

//    var_dump($visitedPages);
    while(!$pass){
        if ($audioID == -1){
            $next++;
            header("Location recommend.php?next=$next&pg1=$pg1&pg2=$pg2&pg3=$pg3&pg4=$pg4&pg5=$pg5");
            $pass = true;
        }

        if(in_array("$audioID",$visitedPages)){
            $audioID = getNext($genre, $offset++);
//            echo "in array $audioID";
        } else {
            if (checkIfOwned($_SESSION['personID'],$audioID) == 1){
                $audioID = getNext($genre, $offset++);
            } else {
//                array_push($visitedPages, $audioID);
//                array_push($visitedPages, $audioID);
                $pass = true;
                $pg2 = $audioID;
//                var_dump($visitedPages);
                header("Location: product.php?bookID=$audioID&next=2&pg1=$pg1&pg2=$pg2&pg3=$pg3&pg4=$pg4&pg5=$pg5");
//                header("Location: product.php?bookID=$audioID&next=2");
            }
        }
    }

//    if (checkIfOwned($_SESSION['personID'],$audioID) == 1){
//        $next++;
//    } else {
//        $visitedPages[] = $audioID;
//        header("Location: product.php?bookID=$audioID&next=2");
//    }
}

if ($next == 2){
//    array_shift($genreArray);
    $genre = $genre2;
    $audioID = getNext($genre,0);

    $offset = 0;
    $pass = false;

    while(!$pass){
        if ($audioID == -1){
            $next++;
            header("Location recommend.php?next=$next&pg1=$pg1&pg2=$pg2&pg3=$pg3&pg4=$pg4&pg5=$pg5");
            $pass = true;
        }

        if(in_array("$audioID",$visitedPages)){
            $audioID = getNext($genre, $offset++);
        } else {
            if (checkIfOwned($_SESSION['personID'],$audioID) == 1){
                $audioID = getNext($genre, $offset++);
            } else {
//                array_push($visitedPages, $audioID);
                $pass = true;
                $pg3 = $audioID;
                header("Location: product.php?bookID=$audioID&next=3&pg1=$pg1&pg2=$pg2&pg3=$pg3&pg4=$pg4&pg5=$pg5");
            }
        }
    }

//    if (checkIfOwned($_SESSION['personID'],$audioID) == 1){
//        $next++;
//    } else {
//        $visitedPages[] = $audioID;
//        header("Location: product.php?bookID=$audioID&next=3");
//    }
}

if ($next == 3){
//    array_shift($genreArray);
    $genre = $genre2;
//    var_dump($genreArray);
//    echo $genre;
    $audioID = getNext($genre,1);

    $offset = 1;
    $pass = false;

    while(!$pass) {
        if ($audioID == -1) {
            $next++;
            header("Location recommend.php?next=$next&pg1=$pg1&pg2=$pg2&pg3=$pg3&pg4=$pg4&pg5=$pg5");
            $pass = true;
        } else {
            if (in_array("$audioID", $visitedPages)) {
                $audioID = getNext($genre, $offset++);
            } else {
                if (checkIfOwned($_SESSION['personID'], $audioID) == 1) {
                    $audioID = getNext($genre, $offset++);
                } else {
//                array_push($visitedPages, $audioID);
                    $pass = true;
                    $pg4 = $audioID;
                    header("Location: product.php?bookID=$audioID&next=4&pg1=$pg1&pg2=$pg2&pg3=$pg3&pg4=$pg4&pg5=$pg5");
                }
            }
        }
    }

//    if (checkIfOwned($_SESSION['personID'],$audioID) == 1){
//        $next++;
//    } else {
//        $visitedPages[] = $audioID;
//        header("Location: product.php?bookID=$audioID&next=4");
//    }
}

if ($next == 4){
//    array_shift($genreArray);
//    array_shift($genreArray);
    $genre = $genre3;
    $audioID = getNext($genre,0);

    $offset = 0;
    $pass = false;

    while(!$pass){
        if ($audioID == -1){
            $next++;
            header("Location recommend.php?next=$next&pg1=$pg1&pg2=$pg2&pg3=$pg3&pg4=$pg4&pg5=$pg5");
            $pass = true;
        } else {
            if(in_array("$audioID",$visitedPages)){
                $audioID = getNext($genre, $offset++);
            } else {
                if (checkIfOwned($_SESSION['personID'],$audioID) == 1){
                    $audioID = getNext($genre, $offset++);
                } else {
//                array_push($visitedPages, $audioID);
                    $pass = true;
                    $pg5 = $audioID;
                    header("Location: product.php?bookID=$audioID&next=5&pg1=$pg1&pg2=$pg2&pg3=$pg3&pg4=$pg4&pg5=$pg5");
//                header("Location: product.php?bookID=$audioID&next=5");
                }
            }
        }
    }

//    if (checkIfOwned($_SESSION['personID'],$audioID) == 1){
//        $next++;
//    } else {
//        $visitedPages[] = $audioID;
//        header("Location: product.php?bookID=$audioID&next=5");
//    }
}

if ($next == 5){
//    array_shift($genreArray);
//    array_shift($genreArray);
    $genre = $genre3;
    $audioID = getNext($genre,1);

    $offset = 1;
    $pass = false;

    while(!$pass) {
        if ($audioID == -1) {
            $next++;
            $pass = true;
            header("Location: home.php");
        } else {
            if (in_array("$audioID", $visitedPages)) {
                $audioID = getNext($genre, $offset++);
            } else {
                if (checkIfOwned($_SESSION['personID'], $audioID) == 1) {
                    $audioID = getNext($genre, $offset++);
                } else {
//                array_push($visitedPages, $audioID);
                    $pass = true;
//                var_dump($visitedPages);
//                echo $audioID;
//                echo in_array("$audioID",$visitedPages);
                    header("Location: product.php?bookID=$audioID&next=6");
                }
            }
        }
    }
//    if (checkIfOwned($_SESSION['personID'],$audioID) == 1){
//        $next++;
//    } else {
//        $visitedPages[] = $audioID;
//        header("Location: product.php?bookID=$audioID&next=6");
//    }
}
//echo key($genreArray);