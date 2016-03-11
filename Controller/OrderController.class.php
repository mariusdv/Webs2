<?php

class OrderController
{
    public $message = "Order";

    public function run()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $cart = new Cart();
            $cartArray = $cart->cartObject();
            $i = 0;
            foreach ($_POST as $key => $value) {

                if($value < 1)
                {
                    $cartArray = array_splice ( $cartArray , $i + 1, 1);
                }
                else
                {
                    $cartArray[$i]->Quantity = $value;
                    $i++;
                }
            }
            $cart->setObject($cartArray);

            header("HTTP/1.1 303 See Other");
            header("Location: http://" . $_SERVER['HTTP_HOST'] . $_SERVER[REQUEST_URI]);
            exit(0);
        }

        if (Empty($_GET["action"])) {
            $this->showCart();
        } else {
            switch (strtolower($_GET["action"])) {
                case "order":
                    $this->order();
                    break;
                default:
                    $this->showCart();
                    break;
            }
        }

    }

    public function showCart()
    {
        render("cart.php", ["title" => "Mijn Winkelmandje",
            "message" => $this->message]);
    }

    public function order()
    {

        guaranteeLogin("/Order/action=order");

        render("order.php", ["title" => "Mijn Winkelmandje2",
           "user" => $_SESSION["user"]]);

    }

}
