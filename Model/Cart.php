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
        if (empty($_SESSION["cart"])) {
            $_SESSION["cart"] = [];
        }
    }

    public function AddCart($id)
    {

        if (filter_var($id, FILTER_VALIDATE_INT) === false)
            return false;

        $c = count($_SESSION["cart"]);
        for ($i = 0; $i < $c; $i++) {
            if (!empty($_SESSION["cart"][$i])) {
                if ($_SESSION["cart"][$i]->Product == $id) {
                    $_SESSION["cart"][$i]->Quantity++;
                    return true;
                }
            }
        }
        $new = new CartEntry();
        $cat = new Catalogue();

        if ($cat->getItem($id) !== false) {
            $new->Product = $id;
            $new->Quantity = 1;
            $_SESSION["cart"][] = $new;
            return true;
        }
        return false;

    }

    public function setObject($val)
    {
        $_SESSION["cart"] = $val;
    }

    public function cartObject()
    {
        return $_SESSION["cart"];
    }

    public function getCart()
    {
        $items = [];
        $cat = new Catalogue();
        $c = count($_SESSION["cart"]);
        for ($i = 0; $i < $c; $i++) {
            if (!empty($_SESSION["cart"][$i])) {
                if ($_SESSION["cart"][$i]->Quantity > 0) {
                    $new = new CartEntry();
                    $new->Quantity = $_SESSION["cart"][$i]->Quantity;
                    $new->Product = $cat->getItem($_SESSION["cart"][$i]->Product);
                    $items[] = $new;
                }
            }
        }

        return $items;
    }

    public function getTotal()
    {
        $c = $this->getCart();
        $len = count($c);
        $total = 0;
        for ($i = 0; $i < $len; $i++) {
            $total += ($c[$i]->Quantity * $c[$i]->Product->Price);
        }
        return $total;
    }

    public function ItemCount()
    {
        $c = count($_SESSION["cart"]);
        $total = 0;
        for ($i = 0; $i < $c; $i++) {
            if (!empty($_SESSION["cart"][$i])) {
                $total += $_SESSION["cart"][$i]->Quantity;

            }
        }
        return $total;
    }

    public function save($delivery, $payment)
    {


        if ($_SESSION["user"]->validateAddress($delivery) == true && $_SESSION["user"]->validateAddress($payment) == true) {


            $pdo = DATABASE::getPDO();
            $pdo->beginTransaction();
            $itemNR = null;

            // create order
            DATABASE::transaction_action_safe($pdo, "INSERT INTO `orders` (`Users_Email`, `deliveryaddress`, `paymentaddress`) VALUES (?, ?, ?)", array($_SESSION["user"]->email, $delivery, $payment));

            // get order ID
            $itemNR = $pdo->lastInsertId();

            // connect items to cart
            $vals = $this->getCart();

            foreach ($vals as $item) {
                $item->Quantity;
                $item->Product->Id;

                DATABASE::transaction_action_safe($pdo, "INSERT INTO `items_has_orders` (`Items_Id`, `Orders_Id`, `Quantity`, `Price`) VALUES (?, ?, ?, ?)", array($item->Product->Id, $itemNR, $item->Quantity, $item->Product->Price));
            }

            $pdo->commit();

            $_SESSION["cart"] = [];
            return true;
        }

        return false;
    }
}