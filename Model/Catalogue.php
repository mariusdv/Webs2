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
        $pos = strrpos($criteria, "%");
        if ($pos !== false)
        {
            return "Geen geldige zoekstring.";
        }
        $rows = array();
        $val = "%" . $criteria . "%";

        $db = new Database();
        $db->query_safe("SELECT * FROM `items` WHERE `Name` LIKE ? AND `Active` = TRUE", array($val));
        $res = $db->getRows();

        if (!$res) {
            return "Zoekcriteria heeft geen resultaten geretourneerd.";
        } else {
            foreach ($res as $val) {
                $rows[] = new Product($val['Id'], $val['Name'], $val['DescriptionLong'], $val['DescriptionShort'], $val['Price'], $val['ImgUrl'], $val['Subcategories_Name'], $val['Active']);
            }
        }

        return $rows;
    }

    public function getEntrees($cat)
    {
        $rows = array();

        $db = new Database();
        $db->query_safe("SELECT * FROM `items` WHERE `Subcategories_Name` LIKE ? AND `Active` = TRUE", array($cat));
        $res = $db->getRows();

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

        $db = new Database();
        $db->query("SELECT * FROM `categories` ORDER BY 'Name' DESC");
        $res = $db->getRows();


        foreach ($res as $val) {
            $name = $val['Name'];

            $db2 = new Database();
            $db2->query_safe("SELECT * FROM `subcategories` WHERE `Categories_Name` LIKE ?", array($name));
            $res2 = $db2->getRows();

            $subcategories = array();

            if (!$res2) {
            } else {
                foreach ($res2 as $val2) {
                    $subcategories[] = $val2['Name'];
                }
            }
            $rows[] = new Category($val['Name'], $subcategories);
        }

        return $rows;
    }

    public function getItem($id)
    {
        $db = new Database();
        $db->query_safe("SELECT * FROM `items` WHERE `Id` = ? AND `Active` = TRUE", array($id));
        $res = $db->getRow();

        if ($res == null) {
            return false;
        } else {
            return (new Product($res['Id'], $res['Name'], $res['DescriptionLong'], $res['DescriptionShort'], $res['Price'], $res['ImgUrl'], $res['Subcategories_Name'], $res['Active']));
        }
    }
}