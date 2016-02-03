<?php


// requirements
require("classes.php");
require("constants.php");
require("functions.php");

// enable sessions
session_start();

$page = explode("/", $_SERVER["PHP_SELF"])[1];


if ($page != "index.php") {

    redirect("/");

}


//// require authentication for all pages except /login.php, /logout.php, and /register.php & php css file
//if (!in_array($page[3], ["login.php", "logout.php", "register.php", "index.php", "Error.php"]))
//{
//    if (empty($_SESSION["id"]))
//    {
//        redirect("login.php");
//    }
//
//}


?>
