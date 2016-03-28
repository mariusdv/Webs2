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

        $added = null;
        if (!empty($_SESSION["add"])) {
            $added = true;
            $_SESSION["add"] = null;
        }


        $_SESSION["breadcrumbTrial"]->add("Catalogue", "/catalogue");
        // if post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Add to cart
            if (!Empty($_POST["item"])) {
                $cart = new Cart();
                if (!$cart->AddCart($_POST["item"])) {
                    apologize("Artikel kan niet worden toegoegd aan winkelmandje.");
                    exit(1);
                } else {
                    $_SESSION["add"] = true;
                }

                // Stops F5 -> want to submit again
                header("HTTP/1.1 303 See Other");
                header("Location: http://" . $_SERVER['HTTP_HOST'] . $_SERVER[REQUEST_URI]);
                exit(0);
            } // Add to wishlist
            else if (!Empty($_POST["id"])) {
                if (!Empty($_SESSION["user"])) {
                    (new User())->addToWishlist($_SESSION["user"]->email, $_POST["id"]);
                    // Stops F5 -> want to submit again
                    header("HTTP/1.1 303 See Other");
                    header("Location: http://" . $_SERVER['HTTP_HOST'] . $_SERVER[REQUEST_URI]);
                    exit(0);

                } else {
                    redirect('/account/action=login');
                }
            } else if (!Empty($_POST["index"]) || is_numeric($_POST["index"])) {
                if ((new ComparisonChart())->removeItem($_POST["index"])) {
                    $newLink = (new ComparisonChart())->getHref();
                    apologize('test');
                    // Stops F5 -> want to submit again
                    header("HTTP/1.1 303 See Other");
                    header("Location: http://" . $_SERVER['HTTP_HOST'] . $newLink);
                    exit(0);
                } else {

                    $newArray = explode(",", $_GET["comparison"]);
                    $newArray = (new ComparisonChart())->removeItemFromArray($_POST["index"], $newArray);
                    $newLink = (new ComparisonChart())->getHrefByArrayIds($newArray);

                    // Stops F5 -> want to submit again
                    header("HTTP/1.1 303 See Other");
                    header("Location: http://" . $_SERVER['HTTP_HOST'] . $newLink);
                    exit(1);
                }
            } else if (!Empty($_POST["comparisonId"])) {
                if ((new ComparisonChart())->addItem($_POST["comparisonId"])) {
                    // Stops F5 -> want to submit again
                    header("HTTP/1.1 303 See Other");
                    header("Location: http://" . $_SERVER['HTTP_HOST'] . $_SERVER[REQUEST_URI]);
                    exit(0);
                } else {
                    apologize("Error adding id " . $_POST["comparisonId"] . " to comparison.");
                    exit(1);
                }
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
                    render("catalogue.php", ["title" => "Search - " . $_GET["search"], "cat" => $this->cat, "added" => $added]);
                    exit(0);
                }
                render("catalogue.php", ["title" => "Search - " . $_GET["search"], "rows" => $rows, "cat" => $this->cat, "added" => $added]);
                exit(0);
            } else
                if (!Empty($_GET["comparison"])) {
                    $_SESSION["breadcrumbTrial"]->add("Comparison", "/comparison");
                    $items = (new ComparisonChart)->getItems(explode(",", $_GET["comparison"]));
                    if (!Empty($items)) {
                        render("comparison.php", ["title" => "Comparison", "items" => $items, "size" => 12 / count($items), "link" => "/catalogue/comparison=" . $_GET["comparison"], "added" => $added]);
                        exit(0);
                    } else {
                        apologize("No products to compare.");
                        exit (1);
                    }
                } else
                    if (!Empty($_GET["product"])) {
                        $id = $_GET["product"];
                        if (!filter_var($id, FILTER_VALIDATE_INT) === false) {
                            $product = $this->catalogue->getItem($id);
                            if (!Empty($product)) {
                                $maincat = (new Category(null, null, null))->getMainCategory($product->getProductCategory());
                                $_SESSION["breadcrumbTrial"]->add($maincat, "/catalogue/cat=" . rawurlencode($maincat));
                                $_SESSION["breadcrumbTrial"]->add($product->getProductCategory(), "/catalogue/subcat=" . rawurlencode($product->getProductCategory()));
                                $_SESSION["breadcrumbTrial"]->add($product->Name, "/catalogue/product=" . rawurlencode($product->Id));
                                render("product.php", ["product" => $product, "success" => $this->success, "stock" => $product->IsInStock(), "categories" => $this->catalogue->getCategories(), "added" => $added]);
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
                            $_SESSION["breadcrumbTrial"]->add("$this->cat", "/catalogue/cat=" . rawurlencode($this->cat));
                            render("catalogue.php", ["title" => $this->catalogue->getTitle($this->cat), "success" => $this->success, "rows" => $rows, "cat" => $this->cat, "categories" => $this->catalogue->getCategories(), "added" => $added]);
                            exit(0);
                        } else if (!Empty($_GET["subcat"])) {
                            $this->cat = $_GET["subcat"];
                            $rows = $this->catalogue->getEntrees($this->cat, true);
                            $maincat = (new Category(null, null, null))->getMainCategory($this->cat);
                            $_SESSION["breadcrumbTrial"]->add($maincat, "/catalogue/cat=" . rawurlencode($maincat));
                            $_SESSION["breadcrumbTrial"]->add("$this->cat", rawurlencode("/catalogue/subcat=" . rawurlencode($this->cat)));
                            render("catalogue.php", ["title" => $this->catalogue->getTitle($this->cat), "success" => $this->success, "rows" => $rows, "cat" => $this->cat, "categories" => $this->catalogue->getCategories(), "added" => $added]);
                            exit(0);
                        }
                        $rows = $this->catalogue->getAllEntrees();
                        render("catalogue.php", ["title" => $this->catalogue->getTitle($this->cat), "success" => $this->success, "rows" => $rows, "cat" => $this->cat, "categories" => $this->catalogue->getCategories(), "added" => $added]);
                        exit(0);
                    }
        }
    }
}