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
        render("cart.php", ["title" => "Mijn Winkelmandje",
            "message" => $this->message]);
    }

}
