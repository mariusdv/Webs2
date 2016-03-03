<?php

/**
 * Created by PhpStorm.
 * User: Marius
 * Date: 3-2-2016
 * Time: 14:23
 */
class Catalogue
{

    /** Get all products from the database filtered by a given search criteria. Returns products as an array of Product models. **/
    public function getSearchResults($criteria)
    {
        if (strrpos($criteria, "%") !== false
            || strrpos($criteria, "_") !== false
            || strrpos($criteria, "[") !== false
            || strrpos($criteria, "]") !== false
        ) {
            return "Invalid searchcriteria.";
        }
        $rows = array();
        $val = "%" . $criteria . "%";
        $res = Database::query_safe("SELECT * FROM `items` WHERE `Name` LIKE ? AND `Active` = TRUE", array($val));
        foreach ($res as $val) {
            $rows[] = new Product($val['Id'], $val['Name'], $val['DescriptionLong'], $val['DescriptionShort'], $val['Price'], $val['ImgUrl'], $val['Subcategories_Name'], $val['Active']);
        }
        return $rows;
    }

    /** Get all products from the database. Returns products as an array of Product models. **/
    public function getAllEntrees()
    {
        $rows = array();
        $res = Database::query("SELECT * FROM `items` WHERE `Active` = TRUE");

        foreach ($res as $val) {
            $rows[] = new Product($val['Id'], $val['Name'], $val['DescriptionLong'], $val['DescriptionShort'], $val['Price'], $val['ImgUrl'], $val['Subcategories_Name'], $val['Active']);
        }
        return $rows;
    }

    /** Get all products from the database filtered by a given category. Returns products as an array of Product models. **/
    public
    function getEntrees($cat, $isSub)
    {
        if ($cat == "All")
            $cat = " % ";
        $rows = array();
        if ($isSub)
            $res = Database::query_safe("SELECT * FROM `items` WHERE `Subcategories_Name` LIKE ? AND `Active` = TRUE", array($cat));
        else {
            $catres = Database::query_safe("SELECT * FROM `subcategories` WHERE `Categories_Name` LIKE ? ", array($cat));

            foreach ($catres as $val) {
                $res[] = Database::query_safe("SELECT * FROM `items` WHERE `Subcategories_Name` LIKE ? AND `Active` = TRUE", array($val['Name']));
            }
        }
        if (!$res) {
            apologize("Zoekcriteria heeft geen resultaten geretourneerd . ");
        } else {
            foreach ($res as $val) {
                $rows[] = new Product($val['Id'], $val['Name'], $val['DescriptionLong'], $val['DescriptionShort'], $val['Price'], $val['ImgUrl'], $val['Subcategories_Name'], $val['Active']);
            }
        }
        return $rows;
    }

    /** Returns a string containing a specific title. Parsed according to the given category. **/
    public
    function getTitle($cat)
    {
        $rows = $this->getCategories();
        foreach ($rows as $val) {
            if (in_array($cat, $val->SubCategories)) {
                $res = "$val->Category - $cat";
                return $res;
            }
        }
        return $cat;
    }

    /** Get all categories + subsequent subcategories from database and return as an array of Category models. **/
    public
    function getCategories()
    {
        $rows = array();
        $res = Database::query("SELECT * FROM `categories` ORDER BY 'Name' DESC");
        $Id = 0;
        foreach ($res as $val) {
            $name = $val['Name'];
            $res2 = Database::query_safe("SELECT * FROM `subcategories` WHERE `Categories_Name` LIKE ? ", array($name));
            $subcategories = array();
            if (!$res2) {
            } else {
                foreach ($res2 as $val2) {
                    $subcategories[] = $val2['Name'];
                }
            }
            $Id++;
            $rows[] = new Category($val['Name'], $subcategories, $Id);
        }

        return $rows;
    }

    /** FUNCTION NOT FINISHED, NEEDS TO BE IMPLEMENTED */
    public
    function IsInStock($id)
    {
        return true;
    }

    /** Get specific product from database by ID and return as single Product model.**/
    public
    function getItem($id)
    {
        $res = Database::query_safe("SELECT * FROM `items` WHERE `Id` = ? AND `Active` = TRUE", array($id));
        $res = $res[0];
        if ($res == null || $res === false) {
            return false;
        } else {
            return (new Product($res['Id'], $res['Name'], $res['DescriptionLong'], $res['DescriptionShort'], $res['Price'], $res['ImgUrl'], $res['Subcategories_Name'], $res['Active']));
        }
    }
}