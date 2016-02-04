<?php

/**
 * Created by PhpStorm.
 * User: Marius
 * Date: 3-2-2016
 * Time: 21:10
 */
class TimeSheetController
{
    public function Run()
    {
        // COMMENT
        $rows = array();
        $rows[] = new TimeSheetRow("03/02/2016", "Marius", "OO php leren", 0.5);
        $rows[] = new TimeSheetRow("03/02/2016", "Marius", "IDE opzetten met MySQL & Apache", 1);
        $rows[] = new TimeSheetRow("03/02/2016", "Marius", "Opzetten Structuur", 2.5);
        $rows[] = new TimeSheetRow("03/02/2016", "Marius", ".htaccess mooi maken", 1);
        $rows[] = new TimeSheetRow("03/02/2016", "Marius", "Smarty geimplementeerd", 0.5);
        $rows[] = new TimeSheetRow("03/02/2016", "Patrick", "Bezig geweest met Expression Blend 3 om een begin te maken aan de website layout (en installatie etc)", 1);
        $rows[] = new TimeSheetRow("04/02/2016", "Marius", "Database model gemaakt en geimplementeerd", 3);
        $rows[] = new TimeSheetRow("04/02/2016", "Patrick", "Database model gemaakt en geimplementeerd", 3);
        $rows[] = new TimeSheetRow("04/02/2016", "Patrick", "Veel research gedaan naar veel Bootstrap mogelijkheden. Timesheet pagina aangepast om een gevoel te krijgen voor IDE en Bootstrap research toe te passen.", 2);


        $totalMarius = 0;
        $totalPatrick = 0;
        foreach ($rows as $value) {
            if ($value->Name == "Marius")
                $totalMarius += $value->Time;
            else
                $totalPatrick += $value->Time;
        }
        render("timesheet.php", ["title" => "Time Sheet", "rows" => $rows, "Marius" => $totalMarius, "Patrick" => $totalPatrick]);
    }
}