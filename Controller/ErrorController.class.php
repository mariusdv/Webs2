<?php

class ErrorController
{

    public function render() {
        $_SESSION["breadcrumbTrial"]->disable();
        render("error_view.php" , ["title" => "Oops!",
            "link" => $this->message ]);
        exit(2);
    }

}
