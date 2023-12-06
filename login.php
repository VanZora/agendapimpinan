<?php
session_start();

if (isset($_SESSION["login"])) {
  header("location:javascript://history.go(-1)");
  exit;
}

require 'function.php';
if (isset($_POST["login"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
  $pegawairesult = mysqli_query($conn, "SELECT * FROM pegawai WHERE username = '$username'");

  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION["user"] = $row['username'];
    $_SESSION["foto"] = $row['foto'];

    if (password_verify($password, $row["password"])) {

      $_SESSION["admint"] = true;

      header("Location: dataview/index.php");

      exit;
    }
  }
  else if (mysqli_num_rows($pegawairesult) == 1) {
    $row = mysqli_fetch_assoc($pegawairesult);
    $_SESSION["user"] = $row['username'];
    $_SESSION["foto"] = $row['foto'];

    if ($password == $row["password"]) {

      $_SESSION["pegawai"] = true;

      header("Location: pegawaiview/index.php");

      exit;
    }
  }
  $error = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="canonical" href="https://codepen.io/YinkaEnoch/pen/PxqrZV" />

  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>

  <style>
    body{
      background-color: #CFE5F1;
    }
    .main-content {
      width: 50%;
      border-radius: 20px;
      box-shadow: 0 5px 5px rgba(0, 0, 0, .4);
      margin: 5em auto;
      display: flex;
    }

    .company__info {
      background-color: #2088D1;
      border-top-left-radius: 20px;
      border-bottom-left-radius: 20px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      color: #fff;
    }

    .fa-android {
      font-size: 3em;
    }

    @media screen and (max-width: 640px) {
      .main-content {
        width: 90%;
      }

      .company__info {
        display: none;
      }

      .login_form {
        border-top-left-radius: 20px;
        border-bottom-left-radius: 20px;
      }
    }

    @media screen and (min-width: 642px) and (max-width:800px) {
      .main-content {
        width: 70%;
      }
    }

    .row>h2 {
      color: #2088D1;
    }

    .login_form {
      background-color: #fff;
      border-top-right-radius: 20px;
      border-bottom-right-radius: 20px;
      border-top: 1px solid #ccc;
      border-right: 1px solid #ccc;
    }

    form {
      padding: 0 2em;
    }

    .form__input {
      width: 100%;
      border: 0px solid transparent;
      border-radius: 0;
      border-bottom: 1px solid #aaa;
      padding: 1em .5em .5em;
      padding-left: 2em;
      outline: none;
      margin: 1.5em auto;
      transition: all .5s ease;
    }

    .form__input:focus {
      border-bottom-color: #2088D1;
      box-shadow: 0 0 5px rgba(0, 80, 80, .4);
      border-radius: 4px;
    }

    .btn {
      transition: all .5s ease;
      width: 70%;
      border-radius: 30px;
      color: #2088D1;
      font-weight: 600;
      background-color: #fff;
      border: 1px solid #2088D1;
      margin-top: 1.5em;
      margin-bottom: 1em;
    }

    .btn:hover,
    .btn:focus {
      background-color: #2088D1;
      color: #fff;
    }
  </style>



</head>

<body translate="no">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Yinka Enoch Adedokun">
    <title>Login Page</title>
  </head>

  <body>
    <br><br><br>
    <!-- Main Content -->
    <div class="container-fluid">
      <div class="row main-content bg-success text-center">
        <div class="col-md-4 text-center company__info">
          <span class="company__logo">
            <h2><img src="image/Logobjm.png" width="80%" alt=""></h2>
          </span>
          <h4 class="company_title">PENGELOLAAN AGENDA PIMPINAN</h4>
        </div>
        <div class="col-md-8 col-xs-12 col-sm-12 login_form ">
          <div class="container-fluid">
            <div class="row">
              <h2>Log In</h2>
            </div>
            <div class="row">
              <form control="" class="form-group" method="post">
                <div class="row">
                  <input type="text" name="username" id="username" class="form__input" placeholder="Username">
                </div>
                <div class="row">
                  <!-- <span class="fa fa-lock"></span> -->
                  <input type="password" name="password" id="password" class="form__input" placeholder="Password">
                </div>
                <?php if (isset($error)) : ?>
                  <p style="color: red;">Username / password salah</p>
                <?php endif; ?>
                <div class="row">

                </div>
                <div class="row">
                  <input type="submit" value="Masuk" class="btn" name="login">
                </div>
              </form>
            </div>
            <div class="row" hidden>
               <p>Tidak Punya Akun? <a href="registrasi.php">Registrasi</a></p>
            </div>
            
          </div>
        </div>
      </div>
    </div>

  </body>




</body>

</html>