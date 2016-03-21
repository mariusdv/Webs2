<?php

/**
 * Created by PhpStorm.
 * User: Marius
 * Date: 3-2-2016
 * Time: 20:17
 */
class AdminController
{

    private $username = "admin";
    private $password = "admin";

    public $catalogue;
    public $cat;
    public $success = false;

    public function __construct()
    {
        $this->catalogue = new Catalogue();
    }


    public function run()
    {

        if (isset($_GET["p"])) {
            switch (strtolower($_GET["p"])) {
                case "logout":
                    $this->logout();
                    break;
                case "cat":
                    $this->cat();
                    break;
                default:
                    $this->guarrenteeAdmin("/");
                    render("admin/adminhome.php", ["title" => "Show - All"]);
                    break;
            }
            exit(0);
        }
        $this->guarrenteeAdmin("/");
        render("admin/adminhome.php", ["title" => "Show - All"]);
        exit(0);

    }


    public function cat()
    {
        $this->guarrenteeAdmin("/Admin/p=cat");
        if (!Empty($_GET["search"])) {

            $rows = $this->catalogue->getSearchResults($_GET["search"]);
            if (is_string($rows)) {
                apologize($rows);
                exit(1);
            }
            if (count($rows) == 0) {
                render("admin/products.php", ["title" => "Search - " . $_GET["search"], "cat" => $this->cat]);
                exit(0);
            }
            render("admin/products.php", ["title" => "Search - " . $_GET["search"], "rows" => $rows, "cat" => $this->cat]);
            exit(0);
        } else if (!Empty($_GET["product"])) {
            $id = $_GET["product"];
            if (!filter_var($id, FILTER_VALIDATE_INT) === false) {
                $product = $this->catalogue->getItem($id);
                if (!Empty($product)) {
                    $maincat = (new Category(null, null, null))->getMainCategory($product->Subcategory);
                    $_SESSION["breadcrumbTrial"]->add($maincat, "/admin/cat=$maincat");
                    $_SESSION["breadcrumbTrial"]->add("$product->Subcategory", "/admin/subcat=$product->Subcategory");
                    $_SESSION["breadcrumbTrial"]->add($product->Name, "/admin/product=$product->Id");
                    render("admin/product_details.php", ["product" => $product, "success" => $this->success, "stock" => $this->catalogue->IsInStock($product->Id), "categories" => $this->catalogue->getCategories()]);
                    exit(0);
                } else {
                    apologize("Could not find product " + $id);
                    exit(1);
                }
            }
        } else {
            if (Empty($_GET["cat"]) && Empty($_GET["subcat"])) {
                $this->cat = "All";
                $_SESSION["breadcrumbTrial"]->add("All", "/cat=#");

            }
            if (!Empty($_GET["cat"])) {
                $this->cat = $_GET["cat"];
                $rows = $this->catalogue->getEntrees($this->cat, false);
                $_SESSION["breadcrumbTrial"]->add("$this->cat", "/admin/cat=$this->cat");
                render("admin/products.php", ["title" => $this->catalogue->getTitle($this->cat), "success" => $this->success, "rows" => $rows, "cat" => $this->cat, "categories" => $this->catalogue->getCategories()]);
                exit(0);
            } else if (!Empty($_GET["subcat"])) {
                $this->cat = $_GET["subcat"];
                $rows = $this->catalogue->getEntrees($this->cat, true);
                $maincat = (new Category(null, null, null))->getMainCategory($this->cat);
                $_SESSION["breadcrumbTrial"]->add($maincat, "/admin/cat=$maincat");
                $_SESSION["breadcrumbTrial"]->add("$this->cat", "/admin/subcat=$this->cat");
                render("admin/products.php", ["title" => $this->catalogue->getTitle($this->cat), "success" => $this->success, "rows" => $rows, "cat" => $this->cat, "categories" => $this->catalogue->getCategories()]);
                exit(0);
            }
            $rows = $this->catalogue->getAllEntrees();
            render("admin/products.php", ["title" => $this->catalogue->getTitle($this->cat), "success" => $this->success,"rows" => $rows, "cat" => $this->cat, "categories" => $this->catalogue->getCategories()]);
            exit(0);
        }
    }

    public function guarrenteeAdmin($s)
    {
        if (!Empty($_SESSION["admin"])) {

            return true;
        } else {
            $_SESSION["Redirect"] = $s;
            $this->login();
            exit(1);
        }
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (!Empty($_POST["username"]) && !Empty($_POST["password"])) {
                // htmlspecialchar
                if ($_POST["password"] == $this->password && $_POST["username"] == $this->username) {

                    $_SESSION["user"] = null;
                    $_SESSION["admin"] = true;

                    if (!empty($_SESSION["Redirect"])) {
                        redirect($_SESSION["Redirect"]);
                        $_SESSION["Redirect"] = null;
                        exit(0);
                    }
                    redirect("/");
                    exit();
                }
                $this->loginError("gebruikersnaam/wachtwoord combinatie is niet geldig");

            }
            $this->loginError("Niet alle gegevens zijn ingevuld");
        } else {
            render("admin/adminLogin.php", ["title" => "Log in", "username" => ""]);
        }
    }

    public function logout()
    {
        $_SESSION["admin"] = null;
        redirect("/Admin");
    }

    private function loginError($err)
    {

        render("login.php", ["title" => "Log in", "error" => $err, "username" => htmlspecialchars($_POST["username"])]);
        exit();

    }


}