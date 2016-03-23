<?php

/*
 * Notes.
 *
 * Tabel: ip String, datetime DATE, isFinal Boolean
 *
 * Variable aan users:  RecoveryHash String(32) & recoveryDate -> datetime
 *
 * IsAdmin is niet nodig. er is maar 1 admin account.
 *
 * mijn PhpMyAdmin ff exporten & saven
 */
include_once("Includes/config.php");


if (Empty($_GET["page"])) {
    (new HomeController())->run();
}

$page = strtolower(htmlspecialchars($_GET["page"]));
$_SESSION["breadcrumbTrial"] = new BreadcrumbTrial();
$_SESSION["breadcrumbTrial"]->add("Home", "/");

switch ($page) {
    // no parameters
    case "account":
        (new AccountController())->run();
        break;
    case "admin":
        (new AdminController())->run();
        break;
    case "order":
        (new OrderController())->run();
        break;
    case "about":
        $_SESSION["breadcrumbTrial"]->add("About", "/about");
        render("about.php", ["title" => "About"]);
        break;
    case "index.php":
        if (isset($_SESSION["admin"]))
            (new AdminController())->run();
        else
            render("home.php", ["title" => "Home"]);
        break;
    case "timesheet":
        (new TimeSheetController())->run();
        break;
    case "catalogue":
        (new CatalogueController())->run();
        break;
    default:
        apologize("Sorry. Pagina bestaat niet");
        break;
}