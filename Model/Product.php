<?php
/**
 * Created by PhpStorm.
 * User: patri
 * Date: 2/15/2016
 * Time: 3:15 PM
 */

class Product
{
    public $Id, $Name, $DescriptionLong, $DescriptionShort, $Price, $ImgUrl, $Subcategory, $Active;

    public function  __construct($Id, $Name, $DescriptionLong, $DescriptionShort, $Price, $ImgUrl, $Subcategory, $Active)
    {
        $this->Id = $Id;
        $this->Name = $Name;
        $this->DescriptionLong = $DescriptionLong;
        $this->DescriptionShort = $DescriptionShort;
        $this->Price = $Price;
        $this->ImgUrl = $ImgUrl;
        $this->Subcategory = $Subcategory;
        $this->Active = $Active;
    }

    //
}
