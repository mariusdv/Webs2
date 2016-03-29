<?php
/**
 * Created by PhpStorm.
 * User: patri
 * Date: 2/15/2016
 * Time: 3:15 PM
 */

class Product
{
    public $Id, $Name, $DescriptionLong, $DescriptionShort, $Price, $ImgUrl, $SubcategoryId, $Active, $Stockcount;

    public function  __construct($Id, $Name, $DescriptionLong, $DescriptionShort, $Price, $ImgUrl, $SubcategoryId, $Active, $Stockcount)
    {
        $this->Id = $Id;
        $this->Name = $Name;
        $this->DescriptionLong = $DescriptionLong;
        $this->DescriptionShort = $DescriptionShort;
        $this->Price = $Price;
        $this->ImgUrl = $ImgUrl;
        $this->SubcategoryId = $SubcategoryId;
        $this->Active = $Active;
        $this->Stockcount = $Stockcount;
    }

    public function IsInStock() {
        if ($this->Stockcount > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    public function IsPartOfWishlist() {
        $res = false;
        if (!Empty($_SESSION["user"])) {
            $username = strtolower(filter_var($_SESSION["user"]->email, FILTER_SANITIZE_EMAIL));

            $res = Database::query_safe("SELECT COUNT(*) FROM `wishlist` WHERE `Users_Email` = ? AND `Items_Id` = ?", array($username, $this->Id));
            if ($res != false) {
                return true;
            }
        }

        return $res;
    }

    public function getProductCategory() {
        $c = new Category(null, null, null);
        $res = $c->getSubcategory($this->SubcategoryId);
        return $res;
    }

}
