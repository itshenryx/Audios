<?php
session_start();
include "connect.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data){
        $data = trim($data);
	    $data = stripslashes($data);
        return htmlspecialchars($data);
	}

    $uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);
    $nonHashedPass = $pass;

	if (empty($uname)) {
		header("Location: index.php?error=Username is required");
	    exit();
    }else if(empty($pass)){
        header("Location: index.php?error=Password is required");
        exit();
    }else{
        $pass = md5($pass);

        $sql = "SELECT * FROM person WHERE username='$uname' AND hashedPassword='$pass'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['username'] === $uname && $row['hashedPassword'] === $pass) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['personID'] = $row['personID'];
                $_SESSION['adminUser'] = $row['adminUser'];
                $_SESSION['credits'] = $row['credits'];

                include_once 'fetchProduct.php';
                $count = countOwnedBooks($_SESSION['personID']);
                $ownedBooks = $count['count'];
                $_SESSION['ownedBooks'] = $ownedBooks;

                if (isset($_POST['remember'])){
                    setcookie('usernameCookie',$uname,time()+86400);
                    setcookie('passwordCookie',$nonHashedPass,time()+86400);
                    header("Location: home.php");
                } else {
                    setcookie('usernameCookie',$uname,time()-86400);
                    setcookie('passwordCookie',$nonHashedPass,time()-86400);
                    header("Location: home.php");
                }
                exit();
            }else{
                header("Location: index.php?error=Incorrect username or password.");
                exit();
                }
        }else{
            header("Location: index.php?error=Incorrect username or password.");
            exit();
        }
    }
}else{
	header("Location: index.php");
	exit();
}
