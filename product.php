<?php
include 'connect.php';

session_start();
include "fetchProduct.php";

//Disable while debugging -
error_reporting(0);

$bookID = $_GET['bookID'];
$next = $_GET['next'];
$personID = $_SESSION['personID'];
$sql = "SELECT * FROM audio WHERE audioID='$bookID'";
$sql2 = "SELECT * FROM ownedbooks WHERE personID='$personID' AND audioID='$bookID'";
$likesArray = countLikes($bookID);
$likes = $likesArray['count'];

$pg1 = $_GET['pg1'];
$pg2 = $_GET['pg2'];
$pg3 = $_GET['pg3'];
$pg4 = $_GET['pg4'];
$pg5 = $_GET['pg5'];

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$result2 = mysqli_query($conn, $sql2);
$numberOfRows = mysqli_num_rows($result2);
?>

<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php echo '<title>'.$row['bookName'].' - '.$row['author'].'</title>'; ?>
    <link rel="icon" type="image/x-icon" href="img/favicon.png">
    <script
        src="https://kit.fontawesome.com/5949287aaa.js"
        crossorigin="anonymous"
    ></script>
    <!--    <link rel="stylesheet" href="css/main.css">-->
<!--    <link rel="stylesheet" href="css/product.css"/>-->
    <link rel="stylesheet" href="css/product2.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@300&display=swap" rel="stylesheet">
</head>
<body>

<!-- top header -->
<div class="header">
    <div class="container">
        <div class="navbar">
            <div class="logo">
                <a href="home.php"><img src="img/headphone.png" width="230px" style="margin-left: -10px;margin-top:5px;"></a>
            </div>
            <nav>
                <ul>
                    <?php

                    if (isset($_SESSION['username'])) {
                        echo '<li><a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket" style="padding-right: 5px"></i> LOGOUT</a> </li>';
                    } else{
                        echo '<li><a href="index.php"><i class="fa-solid fa-arrow-right-to-bracket" style="padding-right: 5px"></i> LOGIN</a></li>';
                    }

                    if (isset($_SESSION['adminUser']) && $_SESSION['adminUser'] == 1) {
                        echo '<li><a href="home.php"><i class="fa-solid fa-gear" style="padding-right: 5px"></i> MANAGE</a> </li>';
                    }

                    if (isset($_SESSION['ownedBooks']) && $_SESSION['ownedBooks'] > 0) {
                        echo '<li><a href="inventory.php"><i class="fa-solid fa-headphones"></i> BOOKS</a> </li>';
                    }
                    ?>
                    <li><a href="browse.php"><i class="fa-solid fa-magnifying-glass" style="padding-right: 5px"></i>BROWSE </a> </li>
                    <?php
                    if (isset($_SESSION['username'])) {
                        echo '<li><button class="credits" draggable="true">'.$_SESSION['credits'].' <i class="fa-solid fa-copyright" style="color:white;"></i></button> </li>';
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
<!--<br><br>-->
<div class="box">
        <main class="container2">

            <!-- Left Column / Headphones Image -->
            <div class="left-column">
                <?php
                echo '<img src="'.$row['thumbnail'].'" alt="">';
                ?>
            </div>


            <!-- Right Column -->
            <div class="right-column">

                <!-- Product Description -->
                <div class="product-description">
                    <?php echo '<span><i class="fa-solid fa-pen-nib"></i> WRITTEN BY <b>'.$row['author'].'</b></span>'; ?>
                    <?php echo '<div class="flex-box"><h1>'.$row['bookName'].'</h1><span class="likes" DRAGGABLE="true">'.$likes.' <i class="fa-regular fa-heart"></i></span></div>'; ?>
                    <?php echo '<p>'.$row['about'].'</p>'; ?>
                </div>
                <div class="genre" draggable="true">
                    <?php
                        if($row['horror'] == 1){
                            echo '<a href="browse.php?genre=1&horror=1&fantasy=0&comedy=0&action=0&mystery=0"><span class="horror" style="margin-right:10px">#horror</span></a>';
                        }
                        if($row['fantasy'] == 1){
                            echo '<a href="browse.php?genre=1&horror=0&fantasy=1&comedy=0&action=0&mystery=0"><span class="fantasy" style="margin-right:10px">#fantasy</span></a>';
                        }
                        if($row['comedy'] == 1){
                            echo '<a href="browse.php?genre=1&horror=0&fantasy=0&comedy=1&action=0&mystery=0"><span class="comedy" style="margin-right:10px">#comedy</span></a>';
                        }
                        if($row['action'] == 1){
                            echo '<a href="browse.php?genre=1&horror=0&fantasy=0&comedy=0&action=1&mystery=0"><span class="action" style="margin-right:10px">#action</span></a>';
                        }
                        if($row['mystery'] == 1){
                            echo '<a href="browse.php?genre=1&horror=0&fantasy=0&comedy=0&action=0&mystery=1"><span class="mystery">#mystery</span></a>';
                        }
                    ?>
                </div>
                <!-- Product Pricing -->
                <div class="product-price">
                    <?php

                    if ($numberOfRows > 0) {
                        echo '<button class="owned" disabled><i class="fa-solid fa-circle-exclamation"></i>YOU ALREADY OWN THIS BOOK</i></button>';
                    }
                    else {
                        if (isset($_SESSION['username'])) {
                            if ($row['price'] < $_SESSION['credits']) {
                                echo '<span>' . $row['price'] . ' <i class="fa-solid fa-copyright" style="color:black;"></i> </span>';
                            } else {
                                echo '<span style="opacity: 0.5">' . $row['price'] . ' <i class="fa-solid fa-copyright" style="color:black;"></i> </span>';
                            }
                        } else {
                            echo '<span>' . $row['price'] . ' <i class="fa-solid fa-copyright" style="color:black;"></i> </span>';
                        }

                        if (isset($_SESSION['username'])) {
                            if ($row['price'] < $_SESSION['credits']) {
                                echo '<button class="btn" id="click:purchase">PURCHASE <i class="fa-solid fa-basket-shopping"></i></button>';
                                echo '<a href="buyBook.php?bookID=' . $bookID . '&price=' . $row['price'] . '" class="btnYes" id="click:yes" style="display: none; margin-right:20px; "><i class="fa-solid fa-check"></i></a>';
                                echo '<a class="btnNo" style="display: none;" id="click:no" ><i class="fa-solid fa-xmark"></i></a>';
                            } else {
                                echo '<button class="btn" disabled>PURCHASE <i class="fa-solid fa-basket-shopping"></i></button>';
                            }
                        } else {
                            echo '<button class="btn" disabled>PURCHASE <i class="fa-solid fa-basket-shopping"></i></button>';
                        }
                    }
                    ?>

                    <button id="demo:one" class="btn2"><img src="img/ear.png" width="100%" height="25px" style="margin-top: 4px "></button>
                    <script>
                        let button1 = document.getElementById('demo:one');
                        let audio1 = new Audio("<?php echo $row['filepath']?>");

                        button1.onclick = function() {
                            button1.disabled = true;
                            button1.style.background = "black";
                            audio1.play();
                            if (<?php echo $numberOfRows ?> > 0){
                                button1.disabled = "true";
                            }
                            else{
                                setInterval("stopAudio(audio1)",10000);
                                button1.disabled = "true";
                            }
                        }

                        function stopAudio(buttonAudio){
                            buttonAudio.pause();
                            buttonAudio.currentTime = 0;
                            buttonEnabler();
                        }

                        function buttonEnabler(){
                            button1.disabled = false;
                            button1.style.background = "linear-gradient(90deg,darkcyan,#02CCC0)";
                        }

                        let purchaseButton = document.getElementById("click:purchase");
                        let yesButton = document.getElementById("click:yes");
                        let noButton = document.getElementById("click:no");

                        purchaseButton.onclick = function () {
                            purchaseButton.style.display = "none";
                            yesButton.style.display = "revert";
                            noButton.style.display = "revert";
                        }

                        noButton.onclick = function () {
                            purchaseButton.style.display = "revert";
                            yesButton.style.display = "none";
                            noButton.style.display = "none";
                        }

                    </script>
                </div>
            </div>
        </main>
    </div>

    <div class="recommendButtonMid">
    <?php

    if ($next == 0){
        echo '<div class="recommendButtonDiv">';
        echo '<a href="recommend.php?next=0&pg1='.$pg1.'&pg2='.$pg2.'&pg3='.$pg3.'&pg4='.$pg4.'&pg5='.$pg5.'" ><button class="recommendButton" id="click:next">RECOMMEND ME A BOOK <i class="fa-brands fa-gratipay"></i></button></a>';
        echo '</div>';
    } else if ($next > 0 && $next < 6) {
        echo '<div class="recommendButtonDivNext">';
        echo '<a href="recommend.php?next='.$next.'&pg1='.$pg1.'&pg2='.$pg2.'&pg3='.$pg3.'&pg4='.$pg4.'&pg5='.$pg5.'" ><button class="recommendButton" id="click:next">NEXT BOOK <i class="fa-solid fa-circle-arrow-right"></i></button></a>';
        echo '</div>';
    } else if ($next == 6){

    }
    ?>
    </div>
</div>
<!--</div>-->

</body>
</html>
