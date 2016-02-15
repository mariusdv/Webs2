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

    public function __construct()
    {
        $this->catalogue = new Catalogue();
    }

    public function Run($filter)
    {
        $rows = $this->catalogue->getEntrees($filter);
        render("catalogue.php", ["title" => "$filter", "rows" => $rows]);
    }
}