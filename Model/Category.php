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
    public $FoldId;
    public $Id;

    public function __construct($Category, $Subcategories, $FoldId, $Id)
    {
        $this->Category = $Category;
        $this->SubCategories = $Subcategories;
        $this->FoldId = $FoldId;
        $this->Id = $Id;
    }

    /** Get all categories + subsequent subcategories from database and return as an array of Category models. **/
    public function getMainCategory($subcat)
    {
        $res = Database::query_safe("SELECT * FROM `subcategories` WHERE `Name` = ?", array($subcat));
        if ($res != false) {
            $id = $res[0]['Categories_Id'];
        }

        $res = Database::query_safe("SELECT * FROM `categories` WHERE `Id` = ?", array($id));

        return $res[0]['Name'];
    }


    /** Get the name of a subcategory by Id. **/
    public function getSubcategory($id) {
        $res = Database::query_safe("SELECT * FROM `subcategories` WHERE `Id` = ?", array($id));
        return $res[0]['Name'];
    }

}