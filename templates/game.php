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
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  </head>
  <body>
    <div class="jumbotron jumbotron-fluid">
		  <div class="container">
    		<h1 class="display-3">Dice Game!</h1>
    		<p class="lead">Simple dice game.</p>
        <p class="lead">
          
          <!-- INSERT COOCKIES -->
        </p>
        <div class="col text-right"><a class="btn btn-danger" href="logout.php">Logout</a></div>
		  </div>
    </div>

    <div class="container">
    	<div class="row">
        <div class="col-sm-5"></div>
        <div class="col-sm-5">
          <br>
          <button class="btn btn-default" id="start" type="submit">Game Start</button>
          <button class="btn btn-success" id="roll" type="submit" disabled>Roll Dice</button> 
        </div>
      </div>
      <div class="text-center col" id="win_result"></div>
    </div> 
    <div class="container">

   <div class="row text-center mt-3">
        <div class="col-md-4"><img class="img " id="result_1" src="../images/dice1.png"> </div>
        <div class="col-md-4"><img class="img " id="result_2" src="../images/dice2.png"> </div>
        <div class="col-md-4"><img class="img " id="result_3" src="../images/dice3.png"> </div>
   </div>

   <div id="roll_result" class="col text-center">
   </div>

</div>
<script>
  // start = document.getElementById('start');
// roll = document.getElementById('roll');
result_1 = document.getElementById('result_1');
result_2 = document.getElementById('result_2');
result_3 = document.getElementById('result_3');
win = 0; // default win value = 0
match_results = []; //  winnings array


document.getElementById('start').addEventListener("click", function () { // start game button
    $('#roll_result').html(''); // clear previous results
    roll.disabled = false; // unlock button roll
    click_count = 4; //click counter
    win = 0;
    roll.innerHTML = 'Roll(' + click_count + ')'; // show clicks after unclock
    match_results = []; // winnings result clear on each game start
});

document.getElementById('roll').addEventListener("click", function () { // listening for roll button clicks
    result_1 = (Math.floor(Math.random() * 6) + 1);
    result_2 = (Math.floor(Math.random() * 6) + 1);
    result_3 = (Math.floor(Math.random() * 6) + 1);


    $("#result_1").attr("src", "../images/dice" + result_1 + ".png"); // picture change
    $("#result_2").attr("src", "../images/dice" + result_2 + ".png");
    $("#result_3").attr("src", "../images/dice" + result_3 + ".png");

    match = [];
    roll = [];
    roll.push(result_1, result_2, result_3);
    match_results.push(roll);
    roll.forEach(function (element, index) {
        // Find if there is a duplicate or not
        if (roll.indexOf(element, index + 1) > -1) {

            // Find if the element is already in the result array or not
            if (match.indexOf(element) === -1) {
                match.push(element);
            }
        }

    });

     if (match.length > 0) { // if there are same numbers , count reward
        win = win + match[0] * 10;

        $('#roll_result').append('<div class="alert alert-success mt-2"><img class="img-fluid" src="../images/dice' + roll[0] + '.png"><img class="img-fluid" src="../images/dice' + roll[1] + '.png"><img class="img-fluid" src="../images/dice' + roll[2] + '.png"> </div>');

    } else {
        $('#roll_result').append('<div class="alert alert-danger mt-2"><img class="img-fluid" src="../images/dice' + roll[0] + '.png"><img class="img-fluid" src="../images/dice' + roll[1] + '.png"><img class="img-fluid" src="../images/dice' + roll[2] + '.png"> </div>');
    }


    click_count--; // on every click lower the value of  click counter by 1
    this.innerHTML = 'Roll(' + click_count + ')'; // show how many clicks left on button
    if (click_count <= 0 ) {  // when click count reach 0, give result to user and add data to DB
        roll.disabled = true;
        // add_game(); // ADD GAME NO CREATED 
        if (win != 0) {
            $('#roll_result').append('<div class="alert alert-success mt-2">You won ' + win / 100 + ' $</div>');
        } else {
            $('#roll_result').append('<div class="alert alert-danger mt-2">You didn\'t win!</div>');
        }

    }

     if (click_count > 4 || click_count < 0 || match_results.length > 4) {
        // if somehow we get click count < 0 or  > 4 ,
         // or match results array got bigger then  4 , winning will be 0 .
        win = 0;
        click_count = 0;
        roll.disabled = true;
     }

    });
</script>
<!-- <script src="../js/script.js"></script> -->
    