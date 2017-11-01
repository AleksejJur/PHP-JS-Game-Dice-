<?php
 
//connect.php
 
//MySQL user account.
define('MYSQL_USER', 'root');
 
//MySQL password.
define('MYSQL_PASSWORD', '');
 
//The server that MySQL is located on.
define('MYSQL_HOST', 'localhost');
 
//The name of database.
define('MYSQL_DATABASE', 'dicegame');
 
/**
 * PDO options / configuration details.
 * I'm going to set the error mode to "Exceptions".
 * I'm also going to turn off emulated prepared statements.
 */

// pochitat pro exceptions i prepared statements
$pdoOptions = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
);
 
/**
 * Connect to MySQL and instantiate the PDO object.
 */
$pdo = new PDO(
    "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DATABASE, //DSN
    MYSQL_USER, //Username
    MYSQL_PASSWORD, //Password
    $pdoOptions //Options
);
 
//The PDO object can now be used to query MySQL.