<?php
include_once("Includes/config.php");

if(Empty($_GET["page"]) )
{
    (new HomeController())->Run();
}

$page = strtolower(htmlspecialchars($_GET["page"]));
switch ($page)
{
    // no parameters
    case "search":
        (new SearchController())->Run();
        break;
    case "account":
        (new AccountController())->Run();
        break;
    case "admin":
        (new AdminController())->Run();
        break;
    case "index.php":
        (new HomeController())->Run();
        break;
    case "timesheet":
        (new TimeSheetController())->Run();
        break;
    default:
        apologize("Sorry. Pagina bestaat niet");
        break;
}