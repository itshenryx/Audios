<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Books</title>
    <link rel="stylesheet" href="css/inventory.css">
    <script
        src="https://kit.fontawesome.com/5949287aaa.js"
        crossorigin="anonymous"
    ></script>
    <link rel="icon" type="image/x-icon" href="img/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500&display=swap" rel="stylesheet">
</head>
<body>

<!-- top header -->
<div class="header">
    <div class="container">
        <div class="navbar">
            <div class="logo">
                <img src="img/headphone.png" width="230px" style="margin-left: -10px;margin-top:5px;">

            </div>
            <nav>
                <ul>
                    <li><a href="home.php"><i class="fa-solid fa-house" style="padding-right: 5px"></i> HOME</a> </li>
                    <?php
                    session_start();

                    if (!isset($_SESSION['username'])){
                        header("Location: home.php");
                    }

                    if (isset($_SESSION['username'])) {
                        echo '<li><a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket" style="padding-right: 5px"></i> LOGOUT</a> </li>';
                    } else{
                        echo '<li><a href="index.php"><i class="fa-solid fa-arrow-right-to-bracket" style="padding-right: 5px"></i> LOGIN</a></li>';
                    }

                    if (isset($_SESSION['adminUser']) && $_SESSION['adminUser'] == 1) {
                        echo '<li><a href="home.php"><i class="fa-solid fa-gear" style="padding-right: 5px"></i> MANAGE</a> </li>';
                    }

                    ?>
                    <?php
                    if (isset($_SESSION['username'])) {
                        echo '<li><button class="credits">'.$_SESSION['credits'].' <i class="fa-solid fa-copyright" style="color:white;"></i></button> </li>';
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>

<!--    <h2 class="title" DRAGGABLE="true">OWNED BOOKS</h2>-->

    <!--  Static books  -->
<!--    <div class="grid">-->
<!--        <div class="grid2">-->
<!--            <div class="imageDiv">-->
<!--                <a href="product.php?bookID='.$row['audioID'].'"><img class="image" src="img/book1.png" alt=""></a>-->
<!--            </div>-->
<!--            <div>-->
<!--                <div class="infotext">-->
<!--                    <h4 draggable="true">'.$row['bookName'].'</h4>-->
<!--                    <p draggable="true">by '.$row['author'].'</p>-->
<!--                    <span>'.$row['duration'].'</span>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="">-->
<!--                <audio class="audioPlayer" controls controlsList="nodownload noplaybackrate">-->
<!--                    <source src="books/audio/Audio1.mp3" type="audio/mp3" />-->
<!--                </audio>-->
<!--                <div class="hwrap">-->
<!--                    <div class="hmove">-->
<!--                        <div class="hitem">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>-->
<!--                        <div class="hitem">Aliquam consequat varius consequat.</div>-->
<!--                        <div class="hitem">Fusce dapibus turpis vel nisi malesuada sollicitudin.</div>-->
<!--                        <div class="hitem">Pellentesque auctor molestie orci ut blandit.</div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div>-->
<!--                <a class="btnYes"><i class="fa-solid fa-thumbs-up"></i></a>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

    <div class="recommendButtonMid">
        <div class="recommendButtonDiv">
            <button class="recommendButton" id="click:next"><i class="fa-solid fa-book"></i> OWNED BOOKS</button>
        </div>
    </div>

    <?php
    include_once 'fetchProduct.php';

    $personID = $_SESSION['personID'];
    $count = countOwnedBooks($personID);
    $ownedBooks = $count['count'];
    $loop = $count['count']-1;

    if ($ownedBooks == 0){
        echo '<div class="emptyImg">';
        echo '<img class="emptyImg" src="img/empty.png">';
        echo '<p><i class="fa-solid fa-circle-exclamation"></i> No Books found</p>';
        echo '</div>';
    } else {
        echo '<div class="grid">';
        for ($x = 0; $x < $ownedBooks; $x++) {
//        echo '<div class="books">';
//        echo '<div class="small-container">';
//        echo '<div class="row">';
//        for ($y = 0; $y < 4; $y++){
//            if($loop >= 0){
            $row = selectOwnedBooks($loop, $personID);
            echo '<div class="grid2">';
            echo '<div class="imageDiv">';
            echo '<a href="product.php?bookID=' . $row['audioID'] . '&next=0"><img class="image" src="' . $row['thumbnail'] . '" alt=""></a>';
            echo '</div>';
            echo '<div>';
            echo '<div class="infotext">';
            echo '<h4 draggable="true">' . $row['bookName'] . '</h4>';
            echo '<p draggable="true">by ' . $row['author'] . '</p>';
            echo ' <span draggable="true">' . $row['duration'] . ' mins</span>';
            echo '</div>';
            echo '</div>';
            echo '<div>';
            echo '<div>';
            echo '<audio class="audioPlayer" controls controlsList="nodownload noplaybackrate">';
            echo '<source src="' . $row['filepath'] . '" type="audio/mp3" />';
            echo '</audio>';
            echo '<div class="hwrap">';
//                echo '<div class="hmove">';
//                $simpleText = $row['about'];
//                $text = explode(" ",$simpleText);
//                echo $text[4];
//                var_dump($simpleText);
//                for($y = 0; $y < sizeof($text); $y++){
//                    echo '<div class="hitem">'.$text[$y].'</div>';
//                }
            echo '<div class="hitem">' . $row['about'] . '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            if (checkIfLiked($loop, $personID) == 1) {
                echo '<div><a class="btnYes" href="dislikeBook.php?bookID=' . $row['audioID'] . '&personID=' . $personID . '" style="margin-top: 25px;outline: #71c138 auto;"><i class="fa-solid fa-thumbs-up"></i></a></div>';
            } else {
                echo '<div><a class="btnYes" href="likeBook.php?bookID=' . $row['audioID'] . '&personID=' . $personID . '" style="margin-top: 25px"><i class="fa-solid fa-thumbs-up"></i></a></div>';
            }
            echo '</div>';
            $loop--;
//            }
//        }
        }
        echo '</div>';
    }
    ?>

</body>
</html>
