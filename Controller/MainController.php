<?php

include_once("Includes/config.php");

class MainController
{

    private function Example()
    {
        // Voorbeeld hoe je shit rendered
        $err = new ErrorMessage();
        $err->message = "The redirecting and rendering en shit werkt!";
        $err->render();

        // Simpele versie voor error message pagina
        //apologize("The redirecting and rendering en shit werkt!");
    }

    function Run()
    {
        $this->Example();
    }

}