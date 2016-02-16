<?php

/**
 * Created by PhpStorm.
 * User: Marius
 * Date: 16-2-2016
 * Time: 21:55
 */
class Cart
{
    public function __construct()
    {
        if(empty($_SESSION["cart"]))
        {
            $_SESSION["cart"] = [];
        }
    }

    public function AddCart($id)
    {

        if (filter_var($id, FILTER_VALIDATE_INT) === false)
            return false;

        $c = count($_SESSION["cart"]);
        for($i = 0; $i < $c; $i++)
        {
            if(!empty($_SESSION["cart"][$i]))
            {
                if($_SESSION["cart"][$i]->Product == $id)
                {
                    $_SESSION["cart"][$i]->Quantity++;
                    return true;
                }
            }
        }
        $new = new CartEntry();
        $cat = new Catalogue();

        if($cat->getItem($id) !== false)
        {
            $new->Product = $id;
            $new->Quantity = 1;
            $_SESSION["cart"][] = $new;
            return true;
        }
        return false;

    }

    public function getCart()
    {
        echo "TODO";
        exit();
        return null;
    }
    public function ItemCount()
    {
        $c = count($_SESSION["cart"]);
        $total = 0;
        for($i = 0; $i < $c; $i++)
        {
            if(!empty($_SESSION["cart"][$i]))
            {
                $total += $_SESSION["cart"][$i]->Quantity;

            }
        }
        return $total;
    }

}