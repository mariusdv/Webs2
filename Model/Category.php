<?php

/**
 * Created by PhpStorm.
 * User: Marius
 * Date: 3-2-2016
 * Time: 20:12
 */
class Category
{
    public $Category;
    public $SubCategories;
    public $Id;

    public function __construct($Category, $Subcategories, $Id)
    {
        $this->Id = $Id;
        $this->Category = $Category;
        $this->SubCategories = $Subcategories;
    }

    /** Get all categories + subsequent subcategories from database and return as an array of Category models. **/
    public function getMainCategory($subcat)
    {
        $res = Database::query_safe("SELECT * FROM `subcategories` WHERE `Name` = ?", array($subcat));
        if ($res != false) {
            $res = $res[0]['Categories_Name'];
        }
        return $res;
    }

}