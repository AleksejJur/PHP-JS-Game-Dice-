<?php

session_start();

require_once 'connect.php';


if (isset($_SESSION['username']) && $_SESSION['level'] > 0) {
    // user logged in
} else {
    // user is guest
    header("Location: login.php");
}
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Sign in</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/signin.css">

  </head>
  <body>
    <div class="jumbotron jumbotron-fluid">
		<div class="container">
		<h1 class="display-3">Dice Game!</h1>
		<p class="lead">Simple dice game.</p>
		</div>
    </div>
    <div class="container">
      <form class="form-signin" method="POST">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Username</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <button type="submit" class="btn btn-primary btn-block" name="Login" value="Login"><a href="../templates/game.php">Lets play!</a></button>
      </form>
    </div> 