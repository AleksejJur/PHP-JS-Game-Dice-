<?php

session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Dice Game</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
    <div class="jumbotron jumbotron-fluid">
		<div class="container">
		<h1 class="display-3">Dice Game!</h1>
		<p class="lead">Simple dice game.</p>
		</div>
    </div>
    <div class="container">
    	<div class="row">
    		<h1>it wil be game</h1>
            <button class="btn btn-default"></button>
            <button class="btn btn-success"></button>
    	</div>
    </div> 