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

        $ts = new TimeSheet();
        $rows = $ts->getEntrees();
        $totals = $ts->getTotals();
        $totalMarius = $totals["Marius"];
        $totalPatrick = $totals["Patrick"];

        // depricated. gebruik database
        $rows[] = new TimeSheetRow("03/02/2016", "Marius", "OO php leren", 0.5);
        $rows[] = new TimeSheetRow("03/02/2016", "Marius", "IDE opzetten met MySQL & Apache", 1);
        $rows[] = new TimeSheetRow("03/02/2016", "Marius", "Opzetten Structuur", 2.5);
        $rows[] = new TimeSheetRow("03/02/2016", "Marius", ".htaccess mooi maken", 1);
        $rows[] = new TimeSheetRow("03/02/2016", "Marius", "Smarty geimplementeerd", 0.5);
        $rows[] = new TimeSheetRow("04/02/2016", "Marius", "Database model gemaakt en geimplementeerd", 3);
        $rows[] = new TimeSheetRow("04/02/2016", "Patrick", "Database model gemaakt en geimplementeerd", 3);
        $rows[] = new TimeSheetRow("04/02/2016", "Marius", "Database Klasse (PDO)", 2);





        $rows[] = new TimeSheetRow("6/02/2016", "Marius", "Login gemaakt + begin van account recovery", 3);
        $rows[] = new TimeSheetRow("11/02/2016", "Marius", "account Recovery + Mailsysteem + Brute force afvanger + registreren", 4);
        render("timesheet.php", ["title" => "Time Sheet", "rows" => $rows, "Marius" => $totalMarius, "Patrick" => $totalPatrick]);
    }
}