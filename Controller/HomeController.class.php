<?php


class HomeController
{

    private function example()
    {
        // Voorbeeld hoe je shit rendered
        $err = new ErrorMessage();
        $err->message = "The redirecting and rendering en shit werkt!";
        $err->render();

        // Simpele versie voor error message pagina
        //apologize("The redirecting and rendering en shit werkt!");
    }

    public function run()
    {
        render("catalogue.php");
    }

}