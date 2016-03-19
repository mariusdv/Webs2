<?php

/**
 * Created by PhpStorm.
 * User: patrick
 * Date: 2/13/2016
 * Time: 11:19 PM
 */
class CatalogueController
{

    public $catalogue;
    public $cat;
    public $success = false;

    public function __construct()
    {
        $this->catalogue = new Catalogue();
    }

    public function run()
    {
        $_SESSION["breadcrumbTrial"]->add("Catalogue", "/catalogue");
        // if post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Add to cart
            if (!Empty($_POST["item"])) {
                $cart = new Cart();
                if (!$cart->AddCart($_POST["item"])) {
                    apologize("Artikel kan niet worden toegoegd aan winkelmandje.");
                    exit(1);
                }
                else {
                    $this->success = true;
                }

                // Stops F5 -> want to submit again
                header("HTTP/1.1 303 See Other");
                header("Location: http://" . $_SERVER['HTTP_HOST'] . $_SERVER[REQUEST_URI]);
                exit(0);
            }

        } else {
            if (!Empty($_GET["search"])) {
                $_SESSION["breadcrumbTrial"]->add("Search Results", "/");

                $rows = $this->catalogue->getSearchResults($_GET["search"]);
                if (is_string($rows)) {
                    apologize($rows);
                    exit(1);
                }
                if (count($rows) == 0) {
                    render("catalogue.php", ["title" => "Search - " . $_GET["search"], "cat" => $this->cat]);
                    exit(0);
                }
                render("catalogue.php", ["title" => "Search - " . $_GET["search"], "rows" => $rows, "cat" => $this->cat]);
                exit(0);
            } else if (!Empty($_GET["product"])) {
                $id = $_GET["product"];
                if (!filter_var($id, FILTER_VALIDATE_INT) === false) {
                    $product = $this->catalogue->getItem($id);
                    if (!Empty($product)) {
                        $maincat = (new Category(null, null, null))->getMainCategory($product->Subcategory);
                        $_SESSION["breadcrumbTrial"]->add($maincat, "/catalogue/cat=$maincat");
                        $_SESSION["breadcrumbTrial"]->add("$product->Subcategory", "/catalogue/subcat=$product->Subcategory");
                        $_SESSION["breadcrumbTrial"]->add($product->Name, "/catalogue/product=$product->Id");
                        render("product.php", ["product" => $product, "success" => $this->success, "stock" => $this->catalogue->IsInStock($product->Id), "categories" => $this->catalogue->getCategories()]);
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
                    $_SESSION["breadcrumbTrial"]->add("$this->cat", "/catalogue/cat=$this->cat");
                    render("catalogue.php", ["title" => $this->catalogue->getTitle($this->cat), "success" => $this->success,"rows" => $rows, "cat" => $this->cat, "categories" => $this->catalogue->getCategories()]);
                    exit(0);
                } else if (!Empty($_GET["subcat"])) {
                    $this->cat = $_GET["subcat"];
                    $rows = $this->catalogue->getEntrees($this->cat, true);
                    $maincat = (new Category(null, null, null))->getMainCategory($this->cat);
                    $_SESSION["breadcrumbTrial"]->add($maincat, "/catalogue/cat=$maincat");
                    $_SESSION["breadcrumbTrial"]->add("$this->cat", "/catalogue/subcat=$this->cat");
                    render("catalogue.php", ["title" => $this->catalogue->getTitle($this->cat), "success" => $this->success,"rows" => $rows, "cat" => $this->cat, "categories" => $this->catalogue->getCategories()]);
                    exit(0);
                }
                $rows = $this->catalogue->getAllEntrees();
                render("catalogue.php", ["title" => $this->catalogue->getTitle($this->cat), "success" => $this->success,"rows" => $rows, "cat" => $this->cat, "categories" => $this->catalogue->getCategories()]);
                exit(0);
            }

        }


    }
}