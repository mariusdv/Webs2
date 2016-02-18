<?php

/**
 * Created by PhpStorm.
 * User: Marius
 * Date: 3-2-2016
 * Time: 14:23
 */
class Catalogue
{

    public function getSearchResults($criteria)
    {
        if (strrpos($criteria, "%") !== false
            || strrpos($criteria, "_") !== false
            || strrpos($criteria, "[") !== false
            || strrpos($criteria, "]") !== false
        ) {
            return "Geen geldige zoekstring.";
        }



        $rows = array();
        $val = "%" . $criteria . "%";

        $res = Database::query_safe("SELECT * FROM `items` WHERE `Name` LIKE ? AND `Active` = TRUE", array($val));

        foreach ($res as $val) {
            $rows[] = new Product($val['Id'], $val['Name'], $val['DescriptionLong'], $val['DescriptionShort'], $val['Price'], $val['ImgUrl'], $val['Subcategories_Name'], $val['Active']);
        }


        return $rows;
    }

    public function getEntrees($cat)
    {

        if($cat == "All")
            $cat = "%";

        $rows = array();

        $res = Database::query_safe("SELECT * FROM `items` WHERE `Subcategories_Name` LIKE ? AND `Active` = TRUE", array($cat));

        if (!$res) {
            apologize("Zoekcriteria heeft geen resultaten geretourneerd.");
        } else {
            foreach ($res as $val) {
                $rows[] = new Product($val['Id'], $val['Name'], $val['DescriptionLong'], $val['DescriptionShort'], $val['Price'], $val['ImgUrl'], $val['Subcategories_Name'], $val['Active']);
            }
        }

        return $rows;
    }

    public function getTitle($cat)
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

    public function getCategories()
    {
        $rows = array();

        $res = Database::query("SELECT * FROM `categories` ORDER BY 'Name' DESC");

        $Id = 0;
        foreach ($res as $val) {
            $name = $val['Name'];
            $res2 = Database::query_safe("SELECT * FROM `subcategories` WHERE `Categories_Name` LIKE ?", array($name));

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

    public function getItem($id)
    {
        $res = Database::query_safe("SELECT * FROM `items` WHERE `Id` = ? AND `Active` = TRUE", array($id));

        if ($res == null) {
            return false;
        } else {
            return (new Product($res['Id'], $res['Name'], $res['DescriptionLong'], $res['DescriptionShort'], $res['Price'], $res['ImgUrl'], $res['Subcategories_Name'], $res['Active']));
        }
    }
}