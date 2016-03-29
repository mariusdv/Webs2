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
        $_SESSION["breadcrumbTrial"]->disable();
        $this->guarrenteeAdmin("/");
        if (isset($_GET["p"])) {
            switch (strtolower($_GET["p"])) {
                case "logout":
                    $this->logout();
                    break;
                case "cat":
                    $this->cat();
                    break;
                case "category":
                    $this->catcrud();
                    break;
                case "orders":
                    $this->orders();
                    break;
                case "newp":
                    $this->product();
                    break;
                default:
                    $this->cat();
                    break;
            }
            exit(0);
        }
        $this->cat();
        exit(0);

    }


    public function orders()
    {
        $_SESSION["breadcrumbTrial"]->add("Orders", "/admin/p=orders");
        if(!empty($_GET["remove"]))
        {
            (new User())->removeOrder($_GET["remove"]);
        }
        $orders = (new User())->getOrders();
        render("admin/orders.php", ["orders" => $orders]);
        exit();
    }
    public function catcrud()
    {
        $_SESSION["breadcrumbTrial"]->add("Categories", "/admin/p=category");
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if(!empty($_POST["action"]))
            {
                switch(strtolower($_POST["action"]))
                {
                    case "newcat":
                        // new cat
                        $this->catalogue->newCat($_POST["name"]);
                        break;
                    case "renamecat":
                        $this->catalogue->renameCat($_POST["id"],$_POST["name"] );
                        break;
                    case "deletecat":
                        $this->catalogue->deleteCat($_POST["id"]);
                        break;
                    case "newsubcat":
                        $this->catalogue->newSubCat($_POST["name"], $_POST["parent"]);
                        break;
                    case "renamesubcat":
                        $this->catalogue->renameSubCat($_POST["name"], $_POST["id"]);
                        break;
                    case "deletesubcat":
                        $this->catalogue->deleteSubCat($_POST["id"]);
                        break;
                }
            }
            redirect("/Admin/p=category");
            exit();
        }
        render("admin/cat_overview.php", ["categories" => $this->catalogue->getCategories()]);
        exit();
    }
    public function product()
    {

        $this->guarrenteeAdmin("/");
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $_POST["Name"] = trim($_POST["Name"]);
            $_POST["DescriptionLong"] = trim($_POST["DescriptionLong"]);
            $_POST["DescriptionShort"] = trim($_POST["DescriptionShort"]);
            $_POST["Price"] = trim($_POST["Price"]);
            $_POST["SubcategoryId"] = trim($_POST["SubcategoryId"]);

            if (empty ($_POST["Name"])
                || empty ($_POST["DescriptionLong"])
                || empty ($_POST["DescriptionShort"])
                || empty($_POST["Price"])
                || empty ($_POST["SubcategoryId"])
            ) {
                apologize("Not everything is filled in");
            }

            //  check double price
            if (!is_numeric($_POST["Price"]) || $_POST["Price"] <= 0) {
                apologize("Price should be a non-negative number");
            }
            // add/update product
            $id = null;
            if (!empty($_POST["Id"])) {

                if ($this->catalogue->getItem($_POST["Id"]) === false)
                    apologize("Product does not exist");

                if (!empty($_FILES["image"]["name"])) {
                    $filename = (new fileUpload())->upload($_FILES["image"], $_POST["Id"]);
                } else {
                    $filename = $this->catalogue->getItem($_POST["Id"])->ImgUrl;
                }

                $prod = new Product($_POST["Id"], $_POST["Name"], $_POST["DescriptionLong"], $_POST["DescriptionShort"], $_POST["Price"], $filename, $_POST["SubcategoryId"], true, 9001);
                $this->catalogue->saveItem($prod);
                $id = $_POST["Id"];
            } else {
                if (!empty($_FILES["image"]["name"])) {

                    // create
                    $prod = new Product(null, $_POST["Name"], $_POST["DescriptionLong"], $_POST["DescriptionShort"], $_POST["Price"], "Resources/Images/no_image.png", $_POST["SubcategoryId"], true, 9001);

                    $id = $this->catalogue->saveItem($prod);
                    $prod->Id = $id;


                    // upload file with new ID
                    $filename = (new fileUpload())->upload($_FILES["image"], $id);

                    $prod->ImgUrl = $filename;

                    // save again (to change image url)
                    $this->catalogue->saveItem($prod);
                } else {
                    apologize("Not everything is filled in");
                    exit();
                }


            }

            // go to item
            redirect("/admin/p=cat/product=$id");
            exit(0);
        }
        else if(isset($_GET["remove"]))
        {
            if ($this->catalogue->getItem($_GET["remove"]) === false)
                apologize("Product does not exist");
            $this->catalogue->deleteItem($_GET["remove"]);

            $this->cat();
            exit(0);
        }
        render("admin/product_details.php", ["categories" => $this->catalogue->getCategories()]);
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
                    $maincat = (new Category(null, null, null))->getMainCategory($product->getProductCategory());
                    $_SESSION["breadcrumbTrial"]->add($maincat, "/admin/p=cat/cat=" . rawurlencode($maincat));
                    $_SESSION["breadcrumbTrial"]->add($product->getProductCategory(), "/admin/p=cat/subcat=" . rawurlencode($product->getProductCategory()));
                    $_SESSION["breadcrumbTrial"]->add($product->Name, "/admin/p=cat/product=" . rawurlencode($product->Id));
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
            render("admin/products.php", ["title" => $this->catalogue->getTitle($this->cat), "success" => $this->success, "rows" => $rows, "cat" => $this->cat, "categories" => $this->catalogue->getCategories()]);
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

        render("admin/adminLogin.php", ["title" => "Log in", "error" => $err, "username" => htmlspecialchars($_POST["username"])]);
        exit();

    }


}
