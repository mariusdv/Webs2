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
                    $subcategories[] = array($val2['Name'], rawurlencode($val2['Name']), $val2['Id']);
                }
            }
            $rows[] = new Category(array($val['Name'], rawurlencode($val['Name'])), $subcategories, $foldId, $val['Id']);
            $foldId++;
        }

        return $rows;
    }

    /** DEPRECATED */
    /** Returns true if given stockcount is above 0, else returns false. */
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


    /** Save product **/
    public
    function saveItem($product)
    {


        if ($product->Id == null) {

            // Insert
            $pdo = DATABASE::getPDO();
            $pdo->beginTransaction();
            DATABASE::transaction_action_safe($pdo,
                "INSERT INTO `items`
            (`Id`, `Subcategories_Id`, `Name`,
            `DescriptionLong`, `DescriptionShort`,
            `Price`, `ImgUrl`, `Active`, `Stockcount`)
            VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?)", array($product->SubcategoryId,
                    $product->Name,
                    $product->DescriptionLong,
                    $product->DescriptionShort,
                    $product->Price,
                    $product->ImgUrl,
                    $product->Active,
                    $product->Stockcount));
            $id = $pdo->lastInsertId();
            $pdo->commit();

            return $id;
        } else {

            // update
            if (DATABASE::query_safe("UPDATE `items`
            SET `Subcategories_Id` = ?,
            `Name` = ?,
            `DescriptionLong` = ?,
            `DescriptionShort` = ?,
            `Price` = ?,
            `ImgUrl` = ?,
            `Active` = ?,
            `Stockcount` = ?
            WHERE `Id` = ?",
                    array($product->SubcategoryId,
                        $product->Name,
                        $product->DescriptionLong,
                        $product->DescriptionShort,
                        $product->Price,
                        $product->ImgUrl,
                        $product->Active,
                        $product->Stockcount,
                        $product->Id)) === false
            ) {
                echo "QUERY ERROR Catalogue-saveItem";
                exit();
            }


        }
    }

    public function deleteItem($id)
    {
        if (DATABASE::query_safe("UPDATE `items`
            SET
            `Active` = ?,
            Subcategories_Id = null
            WHERE `Id` = ?",
                array(false, $id)) === false
        ) {
            echo "QUERY ERROR Catalogue-deleteItem";
            exit();
        }
    }

    public function newCat($name)
    {
        $name = trim($name);

        if (ctype_alpha(str_replace(' ', '', $name)) && !empty($name)) {
            if (DATABASE::query_safe("select count(*) as c from `categories` where `Name` like ? ", array($name))[0]["c"] == 0)
                DATABASE::query_safe("INSERT INTO `categories` (`Id`, `Name`) VALUES (NULL, ?)", array($name));
        } else {
            apologize("Name can only consist of spaces and alphabetical characters.");
        }
    }

    public function newSubCat($name, $parent)
    {
        $name = trim($name);

        if (ctype_alpha(str_replace(' ', '', $name)) && !empty($name)) {
            if (DATABASE::query_safe("select count(*) as c from `subcategories` where `Name` like ? and Categories_Id like ?", array($name, $parent))[0]["c"] == 0)
                DATABASE::query_safe("INSERT INTO `pokemart_nl_pokebas`.`subcategories` (`Id`, `Categories_Id`, `Name`) VALUES (NULL, ?, ?)", array($parent, $name));

        } else {
            apologize("Name can only consist of spaces and alphabetical characters.");
        }
    }

    public function deleteCat($id)
    {
        if (DATABASE::query_safe("DELETE FROM `categories` WHERE `Id` = ?", array($id)) === false) {
            apologize("There are still products or subcategories using this category");
        }
    }

    public function renameCat($id, $name)
    {
        $name = trim($name);

        if (ctype_alpha(str_replace(' ', '', $name)) && !empty($name)) {
            if (DATABASE::query_safe("select count(*) as c from `categories` where `Name` like ? ", array($name))[0]["c"] == 0)
                DATABASE::query_safe("UPDATE `categories` SET `Name` = ? WHERE `categories`.`Id` = ?", array($name, $id));
        } else {
            apologize("Name can only consist of spaces and alphabetical characters.");
        }
    }

    public function renameSubCat($name, $id)
    {
        $name = trim($name);

        if (ctype_alpha(str_replace(' ', '', $name)) && !empty($name)) {
            if (DATABASE::query_safe("select count(*) as c from `subcategories` where `Name` like ?", array($name))[0]["c"] == 0)
                DATABASE::query_safe("UPDATE `subcategories` SET `Name` = ? WHERE `Id` = ?", array($name, $id));
        } else {
            apologize("Name can only consist of spaces and alphabetical characters.");
        }
    }

    public function deleteSubCat($id)
    {
        if (DATABASE::query_safe("DELETE FROM `subcategories` WHERE `Id` = ?", array($id)) === false) {
            apologize("There are still products using this category");
        }
    }
}
