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

    public function __construct()
    {
        $this->catalogue = new Catalogue();
    }

    public function Run()
    {


        // if post
        //
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Add to cart
            if(!Empty($_POST["item"]))
            {
                $cart = new Cart();
                if(!$cart->AddCart($_POST["item"]))
                {
                    apologize("Artikel kan niet worden toegoegd aan winkelmandje.");
                    exit(1);
                }

            }

            // Stops F5 -> want to submit again
            header("HTTP/1.1 303 See Other");
            header("Location: http://" . $_SERVER['HTTP_HOST'] . $_SERVER[REQUEST_URI]);
            exit(0);
        }
        else
        {
            if (Empty($_GET["cat"])) {
                $this->cat = "%";
            } else {
                $this->cat = $_GET["cat"];
            }
            $rows = $this->catalogue->getEntrees($this->cat);
            render("catalogue.php", ["title" => $this->catalogue->getTitle($this->cat), "rows" => $rows, "cat" => $this->cat]);
        }


    }
}