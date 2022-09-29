<?php
session_start();
include "connect.php";

if (isset($_POST['uname']) && isset($_POST['psw'])
    && isset($_POST['email']) && isset($_POST['confirmpsw'])) {

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['psw']);

    $re_pass = validate($_POST['confirmpass']);
    $email = validate($_POST['email']);

//    $user_data = 'uname='. $uname. '&name='. $email;
//
//
//    if (empty($uname)) {
//        header("Location: index.php?error=User Name is required&$user_data");
//        exit();
//    }else if(empty($pass)){
//        header("Location: index.php?error=Password is required&$user_data");
//        exit();
//    }
//    else if(empty($re_pass)){
//        header("Location: index.php?error=Re Password is required&$user_data");
//        exit();
//    }
//
//    else if(empty($email)){
//        header("Location: index.php?error=Name is required&$user_data");
//        exit();
//    }
//
//    else if($pass !== $re_pass){
//        header("Location: index.php?error=The confirmation password  does not match&$user_data");
//        exit();
//    }
//
//    else{

        // hashing the password
        $pass = md5($pass);

        $sql = "SELECT * FROM person WHERE username='$uname' ";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            header("Location: index.php?error=This username is already taken");
            exit();
        }else {
            $sql2 = "INSERT INTO person(username, hashedPassword, email) VALUES('$uname', '$pass', '$email')";
            $result2 = mysqli_query($conn, $sql2);
            if ($result2) {
                header("Location: index.php?success=Your account has been created successfully");
                exit();
            }else {
                header("Location: index.php?error=An Unknown error occurred");
                exit();
            }
        }
//    }

}else{
    header("Location: index.php");
    exit();
}