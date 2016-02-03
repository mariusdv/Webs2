<?php

class ErrorMessage
{
    public $message = "ERROR MESSGAGE!!!";

    function render() {
        render("error_view.php" , ["title" => "ErrorMessage",
            "message" => $this->message ]);
    }

}
