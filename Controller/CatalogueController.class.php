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
        if (Empty($_GET["cat"])) {
            $this->cat = "%";
        } else {
            $this->cat = $_GET["cat"];
        }

        $rows = $this->catalogue->getEntrees($this->cat);
        render("catalogue.php", ["title" => $this->catalogue->getTitle($this->cat), "rows" => $rows]);
    }
}