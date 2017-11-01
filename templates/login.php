<?php

session_start();

require_once '../config.php';


// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["inputUsername"]))){
        $username_err = 'Please enter username.';
    } else{
        $username = trim($_POST["inputUsername"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST['inputPassword']))){
        $password_err = 'Please enter your password.';
    } else{
        $password = trim($_POST['inputPassword']);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT username, password FROM users WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(':username', $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["inputUsername"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $hashed_password = $row['password'];
                        if(password_verify($password, $hashed_password)){
                            /* Password is correct, so start a new session and
                            save the username to the session */
                            session_start();
                            $_SESSION['username'] = $username;      
                            header("location: ../templates/game.php");
                        } else {
                            // Display an error message if password is not valid
                            $password_err = 'The password you entered was not valid.';
                        }
                    }
                } else {
                    // Display an error message if username doesn't exist
                    $username_err = 'No account found with that username.';
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);
}

// setcookie("cookies", $_POST['inputUsername'], time() + (60*60*24*7), "/"); 
//     } else {
//         echo "Try again.";

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
      <form class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <h2 class="form-signin-heading">Please sign in</h2>
        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
        <label for="inputEmail" class="sr-only">Username</label>
        <input type="text" name="inputUsername" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
        <span class="help-block"><?php echo $username_err; ?></span>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="inputPassword" id="inputPassword" class="form-control" placeholder="Password" required>
        <span class="help-block"><?php echo $password_err; ?></span>
        <button type="submit" class="btn btn-primary btn-block" name="Login" value="Login">Lets play!</button>
      </form>
    </div> 