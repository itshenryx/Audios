<!-- Submitted Separately due to its length -->
<!-- Made by Bharat Nema -->
<!-- 16010120089 -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Browse</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/searchBar.css">
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
                <a href="home.php"><img src="img/headphone.png" width="230px" style="margin-left: -10px;margin-top:5px;"></a>

            </div>
            <nav>
                <ul>
                    <?php
                    session_start();

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
                    <?php
                    if (isset($_SESSION['username'])) {
                        echo '<li><button class="credits">'.$_SESSION['credits'].' <i class="fa-solid fa-copyright" style="color:white;"></i></button> </li>';
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>

<div class="topBar">
<!--    <form action="" class="searchBar">-->
<!--        <input type="search" name="search" pattern=".*\S.*" class="searchBarBar">-->
<!--        <button class="searchButton" type="submit" >-->
<!--            <span><i class="fa-solid fa-magnifying-glass"></i></span>-->
<!--        </button>-->
<!--    </form>-->
    <form action="browse.php" method="post">
        <input type="search" name="search" required>
        <i class="fa fa-search"></i>
    </form>

    <?php
    if (!isset($_GET['genre'])) {
        echo '<div class="genre">';
        echo '<a href="browse.php?genre=1&horror=1&fantasy=0&comedy=0&action=0&mystery=0"><span class="horror" style="margin-right:25px">#horror</span></a>';
        echo '<a href="browse.php?genre=1&horror=0&fantasy=1&comedy=0&action=0&mystery=0"><span class="fantasy" style="margin-right:25px">#fantasy</span></a>';
        echo '<a href="browse.php?genre=1&horror=0&fantasy=0&comedy=1&action=0&mystery=0"><span class="comedy" style="margin-right:25px">#comedy</span></a>';
        echo '<a href="browse.php?genre=1&horror=0&fantasy=0&comedy=0&action=1&mystery=0"><span class="action" style="margin-right:25px">#action</span></a>';
        echo '<a href="browse.php?genre=1&horror=0&fantasy=0&comedy=0&action=0&mystery=1"><span class="mystery">#mystery</span></a>';
        echo '</div>';
    } else {

        $genreArray = array();

        $genre = $_GET['genre'];

        $horror = $_GET['horror'];
        if ($horror == 1){
            array_push($genreArray,"horror");
        }

        $fantasy = $_GET['fantasy'];
        if ($fantasy == 1){
            array_push($genreArray,"fantasy");
        }

        $comedy = $_GET['comedy'];
        if ($comedy == 1){
            array_push($genreArray,"comedy");
        }

        $action = $_GET['action'];
        if ($action == 1){
            array_push($genreArray,"action");
        }

        $mystery = $_GET['mystery'];
        if ($mystery == 1){
            array_push($genreArray,"mystery");
        }

        if ($genre == 0){
            header("Location: browse.php");
        }

        $genreMinus = $genre - 1;
        $genrePlus = $genre + 1;

        echo '<div class="genre">';
        if ($horror==1){
            echo '<a href="browse.php?genre='.$genreMinus.'&horror=0&fantasy='.$fantasy.'&comedy='.$comedy.'&action='.$action.'&mystery='.$mystery.'"><span class="horrorSelected" style="margin-right:25px">#horror</span></a>';
        } else {
            echo '<a href="browse.php?genre='.$genrePlus.'&horror=1&fantasy='.$fantasy.'&comedy='.$comedy.'&action='.$action.'&mystery='.$mystery.'"><span class="horror" style="margin-right:25px">#horror</span></a>';
        }
        if ($fantasy==1){
            echo '<a href="browse.php?genre='.$genreMinus.'&horror='.$horror.'&fantasy=0&comedy='.$comedy.'&action='.$action.'&mystery='.$mystery.'"><span class="fantasySelected" style="margin-right:25px">#fantasy</span></a>';
        } else {
            echo '<a href="browse.php?genre='.$genrePlus.'&horror='.$horror.'&fantasy=1&comedy='.$comedy.'&action='.$action.'&mystery='.$mystery.'"><span class="fantasy" style="margin-right:25px">#fantasy</span></a>';
        }
        if ($comedy==1){
            echo '<a href="browse.php?genre='.$genreMinus.'&horror='.$horror.'&fantasy='.$fantasy.'&comedy=0&action='.$action.'&mystery='.$mystery.'"><span class="comedySelected" style="margin-right:25px">#comedy</span></a>';
        } else {
            echo '<a href="browse.php?genre='.$genrePlus.'&horror='.$horror.'&fantasy='.$fantasy.'&comedy=1&action='.$action.'&mystery='.$mystery.'"><span class="comedy" style="margin-right:25px">#comedy</span></a>';
        }
        if ($action==1){
            echo '<a href="browse.php?genre='.$genreMinus.'&horror='.$horror.'&fantasy='.$fantasy.'&comedy='.$comedy.'&action=0&mystery='.$mystery.'"><span class="actionSelected" style="margin-right:25px">#action</span></a>';
        } else {
            echo '<a href="browse.php?genre='.$genrePlus.'&horror='.$horror.'&fantasy='.$fantasy.'&comedy='.$comedy.'&action=1&mystery='.$mystery.'"><span class="action" style="margin-right:25px">#action</span></a>';
        }
        if ($mystery==1){
            echo '<a href="browse.php?genre='.$genreMinus.'&horror='.$horror.'&fantasy='.$fantasy.'&comedy='.$comedy.'&action='.$action.'&mystery=0"><span class="mysterySelected" style="margin-right:25px">#mystery</span></a>';
        } else {
            echo '<a href="browse.php?genre='.$genrePlus.'&horror='.$horror.'&fantasy='.$fantasy.'&comedy='.$comedy.'&action='.$action.'&mystery=1"><span class="mystery" style="margin-right:25px">#mystery</span></a>';
        }
        echo '</div>';
    }
    ?>
</div>

    <?php
    include_once 'fetchProduct.php';

    $counter = 0;

    if (isset($_GET['genre'])){

        $count = countBooks();
        $divCounter = $count['count'] / 4;
        $loop = $count['count']-1;


        echo '<div class="grid">';



        for ($x = 0; $x < $divCounter; $x++) {
            for ($y = 0; $y < 4; $y++) {
                if ($loop >= 0) {
                    $row = ascendingOrder($loop);
                    $flag = true;
                    $i = 0;
                    while($i < count($genreArray)){
                        $genreName = $genreArray[$i];
                        if (!($row[$genreName] == 1)){
                            $flag = false;
                            break;
                        }
                        $i++;
                    }
                    if ($flag) {
                        $counter++;
                        echo '<div class="col-browse">';
                        echo '<a href="product.php?bookID=' . $row['audioID'] . '&next=0"><img src="' . $row['thumbnail'] . '" alt=""></a>';
                        echo '<div class="info">';
                        echo '<div class="infotext">';
                        echo '<h4 draggable="true">' . $row['bookName'] . '</h4>';
                        echo '<p draggable="true">by ' . $row['author'] . '</p>';
                        echo '</div>';
                        if (isset($_SESSION['username'])) {
                            if (checkIfOwned($_SESSION['personID'], $row['audioID'])) {
                                echo '<div class="listenbutton" style="margin: auto 0 auto auto;padding-right: 10px;padding-bottom: 5px">';
                                echo '<a id="' . $row['audioID'] . '" href="inventory.php" class="btn2owned" style="margin-bottom: 13px; padding: 10px 25px ;"><i class="fa-solid fa-headphones"></i></a>';
                                echo '</div>';
                            } else {
                                echo '<div class="listenbutton" style="margin: auto 0 auto auto;padding-right: 10px;padding-bottom: 5px">';
                                echo '<a id="' . $row['audioID'] . '" href="product.php?bookID=' . $row['audioID'] . '&next=0" class="btn2" style="margin-bottom: 13px; padding: 10px 10px ;">' . $row['price'] . ' <i class="fa-solid fa-copyright"></i></a>';
                                echo '</div>';
                            }
                        } else {
                            echo '<div class="listenbutton" style="margin: auto 0 auto auto;padding-right: 10px;padding-bottom: 5px">';
                            echo '<a id="' . $row['audioID'] . '" href="product.php?bookID=' . $row['audioID'] . '&next=0" class="btn2" style="margin-bottom: 13px; padding: 10px 10px ;">' . $row['price'] . ' <i class="fa-solid fa-copyright"></i></a>';
                            echo '</div>';
                        }
                        echo '</div>';
                        echo '</div>';
                    }
                    $loop--;
                }
            }
        }
    } else if (isset($_POST['search'])){
        $keyword = $_POST['search'];

        $count = countBooks();
        $divCounter = $count['count'] / 4;
        $loop = $count['count']-1;

//        $mystring = "kanye";

//        if (strpos($mystring,$keyword)){
//            echo $keyword;
//        }
//        echo strpos($mystring,$keyword);
        echo '<div class="grid">';


        for ($x = 0; $x < $divCounter; $x++) {
//        echo '<div class="books">';
//        echo '<div class="small-container">';
//        echo '<div class="row">';
            for ($y = 0; $y < 4; $y++){
                if($loop >= 0){
                    $row = ascendingOrder($loop);
//                    echo $keyword;
//                    echo strtolower($row['bookName']);
                    if (strpos(strtolower($row['bookName']) ,strtolower($keyword)) > -1 || strpos(strtolower($row['author']) ,strtolower($keyword)) > -1) {
                        $counter++;
                        echo '<div class="col-browse">';
                        echo '<a href="product.php?bookID=' . $row['audioID'] . '&next=0"><img src="' . $row['thumbnail'] . '" alt=""></a>';
                        echo '<div class="info">';
                        echo '<div class="infotext">';
                        echo '<h4 draggable="true">' . $row['bookName'] . '</h4>';
                        echo '<p draggable="true">by ' . $row['author'] . '</p>';
                        echo '</div>';
                        if (isset($_SESSION['username'])) {
                            if (checkIfOwned($_SESSION['personID'], $row['audioID'])) {
                                echo '<div class="listenbutton" style="margin: auto 0 auto auto;padding-right: 10px;padding-bottom: 5px">';
                                echo '<a id="' . $row['audioID'] . '" href="inventory.php" class="btn2owned" style="margin-bottom: 13px; padding: 10px 25px ;"><i class="fa-solid fa-headphones"></i></a>';
                                echo '</div>';
                            } else {
                                echo '<div class="listenbutton" style="margin: auto 0 auto auto;padding-right: 10px;padding-bottom: 5px">';
                                echo '<a id="' . $row['audioID'] . '" href="product.php?bookID=' . $row['audioID'] . '&next=0" class="btn2" style="margin-bottom: 13px; padding: 10px 10px ;">' . $row['price'] . ' <i class="fa-solid fa-copyright"></i></a>';
                                echo '</div>';
                            }
                        } else {
                            echo '<div class="listenbutton" style="margin: auto 0 auto auto;padding-right: 10px;padding-bottom: 5px">';
                            echo '<a id="' . $row['audioID'] . '" href="product.php?bookID=' . $row['audioID'] . '&next=0" class="btn2" style="margin-bottom: 13px; padding: 10px 10px ;">' . $row['price'] . ' <i class="fa-solid fa-copyright"></i></a>';
                            echo '</div>';
                        }
                        echo '</div>';
                        echo '</div>';
                    }
                    $loop--;
                }
            }
        }
    } else {
        $count = countBooks();
        $divCounter = $count['count'] / 4;
        $loop = $count['count']-1;

        echo '<div class="grid">';
        for ($x = 0; $x < $divCounter; $x++) {
//        echo '<div class="books">';
//        echo '<div class="small-container">';
//        echo '<div class="row">';
            for ($y = 0; $y < 4; $y++){
                if($loop >= 0){
                    $counter++;

                    $row = ascendingOrder($loop);
                    echo '<div class="col-browse">';
                    echo '<a href="product.php?bookID='.$row['audioID'].'&next=0"><img src="'.$row['thumbnail'].'" alt=""></a>';
                    echo '<div class="info">';
                    echo '<div class="infotext">';
                    echo '<h4 draggable="true">'.$row['bookName'].'</h4>';
                    echo '<p draggable="true">by '.$row['author'].'</p>';
                    echo '</div>';
                    if (isset($_SESSION['username'])){
                        if (checkIfOwned($_SESSION['personID'],$row['audioID'])){
                            echo '<div class="listenbutton" style="margin: auto 0 auto auto;padding-right: 10px;padding-bottom: 5px">';
                            echo '<a id="'.$row['audioID'].'" href="inventory.php" class="btn2owned" style="margin-bottom: 13px; padding: 10px 25px ;"><i class="fa-solid fa-headphones"></i></a>';
                            echo '</div>';
                        } else {
                            echo '<div class="listenbutton" style="margin: auto 0 auto auto;padding-right: 10px;padding-bottom: 5px">';
                            echo '<a id="'.$row['audioID'].'" href="product.php?bookID='.$row['audioID'].'&next=0" class="btn2" style="margin-bottom: 13px; padding: 10px 10px ;">' . $row['price'] . ' <i class="fa-solid fa-copyright"></i></a>';
                            echo '</div>';
                        }
                    } else{
                        echo '<div class="listenbutton" style="margin: auto 0 auto auto;padding-right: 10px;padding-bottom: 5px">';
                        echo '<a id="'.$row['audioID'].'" href="product.php?bookID='.$row['audioID'].'&next=0" class="btn2" style="margin-bottom: 13px; padding: 10px 10px ;">' . $row['price'] . ' <i class="fa-solid fa-copyright"></i></a>';
                        echo '</div>';
                    }
                    echo '</div>';
                    echo '</div>';
                    $loop--;
                }
            }
        }
    }
    echo '</div>';

    if ($counter == 0){
        echo '<div class="emptyImg">';
        echo '<img class="emptyImg" src="img/empty.png">';
        echo '<p><i class="fa-solid fa-circle-exclamation"></i> No Books or Authors found</p>';
        echo '</div>';
    }
    ?>


</body>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</html>