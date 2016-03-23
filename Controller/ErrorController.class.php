<?php

class ErrorController
{

    public function render() {
        render("error_view.php" , ["title" => "Oops!",
            "link" => $this->message ]);
        exit(2);
    }

}
