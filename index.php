<!-- Submitted Separately due to its length -->
<!-- Made by Bharat Nema -->
<!-- 16010120089 -->

<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login/Registration</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.png">
    <script
            src="https://kit.fontawesome.com/5949287aaa.js"
            crossorigin="anonymous"
    ></script>
<!--    <link rel="stylesheet" href="css/main.css">-->
    <link rel="stylesheet" href="css/access.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500&display=swap" rel="stylesheet">
</head>


<body>

<div class="navbar">
    <a href="home.php" style="margin:auto"><img src="img/headphone.png" width="230px" style="margin-left:auto;margin-top:5px;margin-right:auto;" align="center"></a>
</div>

<div>
    <br><br><br><br>
</div>

<?php if (isset($_GET['error'])) { ?>
<p class="error" id="phpErrors"><i class="fa-solid fa-circle-exclamation" style="margin-bottom: 2px; margin-right: 2px"></i>  <?php echo $_GET['error']; ?></p>
<?php } ?>

<?php if (isset($_GET['success'])) { ?>
    <p class="success" id="phpSuccess"><i class="fa-solid fa-circle-exclamation" style="margin-bottom: 2px; margin-right: 2px"></i>  <?php echo $_GET['success']; ?></p>
<?php } ?>

<!-- Javascript Error -->
<p class="error" id="usernameError1" style="display:none"><i class="fa-solid fa-circle-exclamation" style="margin-bottom: 2px; margin-right: 2px"></i> Username must contain at-least 6 characters.</p>
<p class="error" id="passwordError1" style="display:none"><i class="fa-solid fa-circle-exclamation" style="margin-bottom: 2px; margin-right: 2px"></i> Password must be at least 8 characters.</p>
<p class="error" id="passwordError2" style="display:none"><i class="fa-solid fa-circle-exclamation" style="margin-bottom: 2px; margin-right: 2px"></i> Password must contain at least one letter.</p>
<p class="error" id="passwordError3" style="display:none"><i class="fa-solid fa-circle-exclamation" style="margin-bottom: 2px; margin-right: 2px"></i> Password must contain at least one digit.</p>
<p class="error" id="passwordError4" style="display:none"><i class="fa-solid fa-circle-exclamation" style="margin-bottom: 2px; margin-right: 2px"></i> Both passwords must be the same.</p>
<p class="error" id="emailError1" style="display:none"><i class="fa-solid fa-circle-exclamation" style="margin-bottom: 2px; margin-right: 2px"></i> Please enter a proper email.</p>


<!--Sign in-->
<div id="sign_in">
    <form action="login.php" method="post">
        <div id="field">
            <label><i class="fas fa-user"></i></label>
            <input type="text" name="uname" placeholder="Username" value="<?php if(isset($_COOKIE['usernameCookie'])){ echo $_COOKIE['usernameCookie'];} ?>" required />
        </div>

        <div id="field">
            <label><i class="fas fa-lock"></i></label>
            <input type="password" name="password" placeholder="Password" value="<?php if(isset($_COOKIE['passwordCookie'])){ echo $_COOKIE['passwordCookie'];} ?>" required />
        </div>

        <div id="field">
            <input type="submit" value="Login" />
        </div>

        <div class="rememberMeDiv">
            <label class="rememberMe" id="rememberLabel">
                <input type="checkbox" class="rememberMe" id="remember" name="remember" style="opacity: 0;max-width: 0"/>Remember me
            </label>
        </div>

        <script>
            let rememberMe = document.getElementById('remember');
            let rememberLabel = document.getElementById('rememberLabel')

            rememberMe.addEventListener('change', e => {
                if(e.target.checked === true) {
                    rememberLabel.style.background = "#f8fff3";
                    rememberLabel.style.color = "#71c138"
                }
                if(e.target.checked === false) {
                    rememberLabel.style.background = "#fff3f5";
                    rememberLabel.style.color = "#c13851";
                }
            });

        </script>
    </form>

    <p>
        Not a member?
        <button onclick="signUp()"><a>Sign up now</a></button>
        <i class="fas fa-arrow-right"></i>
    </p>

</div>

<!-- Sign Up -->
<div id="sign_up">
<form action="register.php" method="post">

    <div id="field">
        <label><i class="fas fa-user"></i></label>
        <input type="text" placeholder="Username" id="uname" name="uname" required />
    </div>

    <div id="field">
        <label><i class="fas fa-envelope-open"></i></label>
        <input type="email" placeholder="Email Address" id="email" name="email" required />
    </div>

    <div id="field">
        <label><i class="fas fa-lock"></i></label>
        <input type="password" placeholder="Password" id="psw" name="psw" required />
    </div>

    <div id="field">
        <label><i class="fas fa-lock"></i></label>
        <input type="password" placeholder="Confirm Password" id="confirmpsw" name="confirmpsw" required />
    </div>

    <div id="field">
        <input type="submit" value="Register" id="click:register" />
    </div>

</form>

        <p>
            Already a member?
            <button onclick="signIn()"><a>Sign in now</a></button>
            <i class="fas fa-arrow-right"></i>
        </p>
    </div>

    <!-- Spacer -->

<script>
  let registerButton = document.getElementById('click:register');
  registerButton.onclick = () => {
      // event.preventDefault();

      if (!validateUsername() && !validateEmail() && !validatePassword()){
          return;
      }
  }

  function validateUsername() {
      var u = document.getElementById('uname').value,
          errors = [];
      if (u.length < 6) {
        document.getElementById('usernameError1').style.display = "revert";
        errors.push("Username must contain at-least 6 characters.");
      }
      if (errors.length > 0) {
          // alert(errors.join("\n"));
          return false;
      }
      return true;
  }

  function validatePassword() {
      var p = document.getElementById('psw').value,
          errors = [],
          p2 = document.getElementById('confirmpsw').value;
      if (p.length < 8) {
        document.getElementById('passwordError1').style.display = "revert";
        errors.push("Your password must be at least 8 characters");
      }
      if (p.search(/[a-z]/i) < 0) {
        document.getElementById('passwordError2').style.display = "revert";
        errors.push("Your password must contain at least one letter.");
      }
      if (p.search(/[0-9]/) < 0) {
        document.getElementById('passwordError3').style.display = "revert";
        errors.push("Your password must contain at least one digit.");
      }
      if (p != p2) {
        document.getElementById('passwordError4').style.display = "revert";
        errors.push("Both passwords must be the same.");
      }
      if (errors.length > 0) {
          // alert(errors.join("\n"));
          return false;
      }
      return true;
  }

  function validateEmail() {
      var e = document.getElementById('email').value,
        errors = [];
      if (e.length === 0) {
        document.getElementById('emailError1').style.display = "revert";
        errors.push("Your Email cannot be empty.");
      }
      if (e.search(/\S+@\S+\.\S+/)) {
        document.getElementById('emailError1').style.display = "revert";
        errors.push("Please enter a proper email.");
      }
      if (errors.length > 0) {
          // alert(errors.join("\n"));
          return false;
      }
      return true;
  }
</script>
<script>
let x = document.getElementById("sign_in");
let y = document.getElementById("sign_up");

function signIn() {
  y.style.display = "none";
  x.style.display = "revert";
  document.getElementById('usernameError1').style.display = "none";
  document.getElementById('passwordError1').style.display = "none";
  document.getElementById('passwordError2').style.display = "none";
  document.getElementById('passwordError3').style.display = "none";
  document.getElementById('passwordError4').style.display = "none";
  document.getElementById('emailError1').style.display = "none";
  document.getElementById('phpSuccess').style.display = "none";
}

function signUp() {
  x.style.display = "none";
  y.style.display = "revert";
  document.getElementById('phpErrors').style.display = "none";
  document.getElementById('phpSuccess').style.display = "none";
}
</script>
</body>
    </html>
