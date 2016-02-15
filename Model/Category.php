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

    public function  __construct($Category, $Subcategories)
    {
        $this->Category = $Category;
        $this->SubCategories = $Subcategories;
    }

}