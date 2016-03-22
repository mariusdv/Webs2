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

            $rows[] = new Product($val['Id'], $val['Name'], $val['DescriptionLong'], $val['DescriptionShort'], $val['Price'], $val['ImgUrl'], $val['Subcategories_Id'], $val['Active'], $val['Stockcount']);
        }
        return $rows;
    }

    /** Get all products from the database. Returns products as an array of Product models. **/
    public function getAllEntrees()
    {
        $rows = array();
        $res = Database::query("SELECT * FROM `items` WHERE `Active` = TRUE");

        foreach ($res as $val) {
            $rows[] = new Product($val['Id'], $val['Name'], $val['DescriptionLong'], $val['DescriptionShort'], $val['Price'], $val['ImgUrl'], $val['Subcategories_Id'], $val['Active'], $val['Stockcount']);
        }
        return $rows;
    }

    // TODO
    /** Get all products from the database filtered by a given category. Returns products as an array of Product models. **/
    public function getEntrees($cat, $isSub)
    {
        $res = false;
        if ($cat == "All")
            $cat = "%";
        $rows = array();

        if ($isSub) {
            $id = Database::query_safe("SELECT * FROM `subcategories` WHERE `Name` LIKE ?", array($cat));
            $id = $id[0]['Id'];
            $res = Database::query_safe("SELECT * FROM `items` WHERE `Subcategories_Id` LIKE ? AND `Active` = TRUE", array($id));
        } else {
            $id = Database::query_safe("SELECT * FROM `categories` WHERE `Name` LIKE ?", array($cat));
            $id = $id[0]['Id'];
            $catres = Database::query_safe("SELECT * FROM `subcategories` WHERE `Categories_Id` LIKE ? ", array($id));
            foreach ($catres as $val) {
                $res2 = Database::query_safe("SELECT * FROM `items` WHERE `Subcategories_Id` LIKE ? AND `Active` = TRUE", array($val['Id']));
                foreach ($res2 as $val2) {
                    $res[] = $val2;
                }
            }
        }
        if (!$res) {
            apologize("Zoekcriteria heeft geen resultaten geretourneerd . ");
        } else {
            foreach ($res as $val) {
                $rows[] = new Product($val['Id'], $val['Name'], $val['DescriptionLong'], $val['DescriptionShort'], $val['Price'], $val['ImgUrl'], $val['Subcategories_Id'], $val['Active'], $val['Stockcount']);
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

        $foldId = 0;
        foreach ($res as $val) {
            $id = $val['Id'];
            $res2 = Database::query_safe("SELECT * FROM `subcategories` WHERE `Categories_Id` LIKE ?", array($id));
            $subcategories = array();
            if (!$res2) {
            } else {
                foreach ($res2 as $val2) {
                    $subcategories[] = $val2['Name'];
                }
            }
            $rows[] = new Category($val['Name'], $subcategories, $foldId);
            $foldId++;
        }

        return $rows;
    }

    /** FUNCTION NOT FINISHED, NEEDS TO BE IMPLEMENTED */
    public
    function IsInStock($stockcount)
    {
        if ($stockcount > 0)
            return true;

        return false;
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
            return (new Product($res['Id'], $res['Name'], $res['DescriptionLong'], $res['DescriptionShort'], $res['Price'], $res['ImgUrl'], $res['Subcategories_Id'], $res['Active'], $res['Stockcount']));
        }
    }
}