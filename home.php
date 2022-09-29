<!-- Submitted Separately due to its length -->
<!-- Made by Bharat Nema -->
<!-- 16010120089 -->

<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>AUDIOS - Audiobook Store</title>
    <script
            src="https://kit.fontawesome.com/5949287aaa.js"
            crossorigin="anonymous"
    ></script>
    <link rel="icon" type="image/x-icon" href="img/favicon.png">
    <link rel="stylesheet" href="css/main.css">
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
<!--                    <li><a href="home.php"><i class="fa-solid fa-house" style="padding-right: 5px"></i> HOME</a> </li>-->
                    <li><a href="browse.php"><i class="fa-solid fa-magnifying-glass" style="padding-right: 5px"></i>BROWSE </a> </li>

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

        <div class="row">
            <div class="col-2">
                <br><br><br><br><br><br><br>
                <h1>Listen to audiobooks,<br>at <i>affordable</i> costs!</h1>
                <p>Audiobooks are a great way to spend your free time in a fun way while also gaining tremendous amounts of knowledge, information and entertainment.
                </p>
                <br>
                <?php
                    include_once "fetchProduct.php";
                    if (isset($_SESSION['username'])) {
                        echo '<a href="recommend.php?next=0" ><button class="recommendButton" id="click:next">RECOMMEND ME A BOOK <i class="fa-brands fa-gratipay"></i></button></a>';
                    } else {
                        echo '<a href="browse.php" class="btn" style="letter-spacing: 3px">BROWSE NOW <i class="fa-solid fa-arrow-right-long"></i></a>';
                    }
                ?>
            </div>
            <div class="col-2">
                <img src="img/headerimg.png">
            </div>
        </div>
    </div>
</div>

<!-- Spacer -->
<div>
    <br><br><br>
</div>


<!-- featured audiobooks -->
<div class="books">
    <div class="small-container">
        <h2 class="title">FEATURED BOOKS</h2>
        <div class="row">
            <div class="col-3">
                <?php
                    include_once 'fetchProduct.php';
                    $row = selectMaxLikes(0);
                ?>

                <a href='product.php?bookID=<?php echo $row['audioID'];?>&next=0'><img src="<?php echo $row['thumbnail']; ?>" alt=""></a>
                <div class="info">
                    <div class="infotext">
                        <h4><?php echo $row['bookName']; ?></h4>
                        <p>by <?php echo $row['author']; ?></p>
                    </div>
                    <div class="listenbutton" style="margin: auto 0 16px auto;padding-right: 10px" >
                        <button id="demo:one" class="btn2"><img src="img/ear.png" width="25px" height="25px"></button>
                        <script>
                            let button1 = document.getElementById('demo:one');
                            let audio1 = new Audio("<?php echo $row['filepath']?>");

                            button1.onclick = function() {
                                buttonDisabler();
                                audio1.play();
                                setInterval("stopAudio(audio1)",10000);
                                button1.disabled = "true";
                            }
                        </script>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <?php
                include_once 'fetchProduct.php';
                $row = selectMaxLikes(1);
                ?>

                <a href='product.php?bookID=<?php echo $row['audioID'];?>&next=0'><img src="<?php echo $row['thumbnail']; ?>" alt=""></a>
                <div class="info">
                    <div class="infotext">
                        <h4><?php echo $row['bookName']; ?></h4>
                        <p>by <?php echo $row['author']; ?></p>
                    </div>
                    <div class="listenbutton" style="margin: auto 0 16px auto;padding-right: 10px">
                        <button id="demo:two" class="btn2"><img src="img/ear.png" width="25px" height="25px"></button>
                        <script>
                            let button2 = document.getElementById('demo:two');
                            let audio2 = new Audio("<?php echo $row['filepath']?>");

                            button2.onclick = function() {
                                buttonDisabler();
                                audio2.play();
                                setInterval("stopAudio(audio2)",10000);
                            }
                        </script>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <?php
                include_once 'fetchProduct.php';
                $row = selectMaxLikes(2);
                ?>

                <a href='product.php?bookID=<?php echo $row['audioID'];?>&next=0'><img src="<?php echo $row['thumbnail']; ?>" alt=""></a>
                <div class="info">
                    <div class="infotext">
                        <h4><?php echo $row['bookName']; ?></h4>
                        <p>by <?php echo $row['author']; ?></p>
                    </div>
                    <div class="listenbutton" style="margin: auto 0 16px auto;padding-right: 10px">
                        <button id="demo:three" class="btn2"><img src="img/ear.png" width="25px" height="25px"></button>
                        <script>
                            let button3 = document.getElementById('demo:three');
                            let audio3 = new Audio("<?php echo $row['filepath']?>");

                            button3.onclick = function() {
                                buttonDisabler()
                                audio3.play();
                                setInterval("stopAudio(audio3)",10000);
                            }
                        </script>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <?php
                include_once 'fetchProduct.php';
                $row = selectMaxLikes(3);
                ?>

                <a href='product.php?bookID=<?php echo $row['audioID'];?>&next=0'><img src="<?php echo $row['thumbnail']; ?>" alt=""></a>
                <div class="info">
                    <div class="infotext">
                        <h4><?php echo $row['bookName']; ?></h4>
                        <p>by <?php echo $row['author']; ?></p>
                    </div>
                    <div class="listenbutton" style="margin: auto 0 16px auto;padding-right: 10px">
                        <button id="demo:four" class="btn2" ><img src="img/ear.png" width="25px" height="25px"></button>
                        <script>
                            let button4 = document.getElementById('demo:four');
                            let audio4 = new Audio("<?php echo $row['filepath']?>");

                            button4.onclick = function() {
                                buttonDisabler()
                                audio4.play();
                                setInterval("stopAudio(audio4)",10000);
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function stopAudio(buttonAudio){
        buttonAudio.pause();
        buttonAudio.currentTime = 0;
        buttonEnabler();
    }

    function buttonDisabler(){
        button1.disabled = true;
        button1.style.background = "black";
        button2.disabled = true;
        button2.style.background = "black";
        button3.disabled = true;
        button3.style.background = "black";
        button4.disabled = true;
        button4.style.background = "black";
    }

    function buttonEnabler(){
        button1.disabled = false;
        button1.style.background = "linear-gradient(90deg,darkcyan,#02CCC0)";
        button2.disabled = false;
        button2.style.background = "linear-gradient(90deg,darkcyan,#02CCC0)";
        button3.disabled = false;
        button3.style.background = "linear-gradient(90deg,darkcyan,#02CCC0)";
        button4.disabled = false;
        button4.style.background = "linear-gradient(90deg,darkcyan,#02CCC0)";
    }
</script>
<!-- Spacer -->
<div>
    <br><br><br><br>
</div>

<!-- reason to choose audios -->
<div class="container">
    <div class="row">
        <div class="col-2">
            <img src="img/header2img.png">
        </div>
        <div class="col-2">
            <small>WHY CHOOSE US?</small>
            <h1>We have something for everyone!</h1>
            <p>Choose your favourite from our vast library of audiobooks, we guarantee we have something you would enjoy!</p>
        </div>
    </div>
</div>

<!-- Spacer -->
<div>
    <br><br><br><br><br><br>
</div>

<div class="footer">
    <div class="container">
        <div class="row">
            <div class="footer-col-1">
                <div class="footerSmaller">
                    <small>MADE BY</small>
                </div>
                <p> <b>Bharat Nema</b> | 16010120089</p>
            </div>
            <div class="footer-col-2">
                <small>WEB PROGRAMMING LAB</small>
            </div>
        </div>
    </div>
</div>

</body>
</html>
