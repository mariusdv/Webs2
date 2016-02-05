<?php

/**
 * Created by PhpStorm.
 * User: Marius
 * Date: 3-2-2016
 * Time: 21:10
 */
class TimeSheetController
{
    public $ts;

    public function __construct()
    {
        $this->ts = new TimeSheet();
    }

    public function Run()
    {
        $this->CheckInsert();

        $rows = $this->ts->getEntrees();
        $totals = $this->ts->getTotals();
        $totalMarius = $totals["Marius"];
        $totalPatrick = $totals["Patrick"];

        // depricated. gebruik database
        $rows[] = new TimeSheetRow("03/02/2016", "Marius", "OO php leren", 0.5);
        $rows[] = new TimeSheetRow("03/02/2016", "Marius", "IDE opzetten met MySQL & Apache", 1);
        $rows[] = new TimeSheetRow("03/02/2016", "Marius", "Opzetten Structuur", 2.5);
        $rows[] = new TimeSheetRow("03/02/2016", "Marius", ".htaccess mooi maken", 1);
        $rows[] = new TimeSheetRow("03/02/2016", "Marius", "Smarty geimplementeerd", 0.5);
        $rows[] = new TimeSheetRow("03/02/2016", "Patrick", "Bezig geweest met Expression Blend 3 om een begin te maken aan de website layout (en installatie etc)", 1);
        $rows[] = new TimeSheetRow("04/02/2016", "Marius", "Database model gemaakt en geimplementeerd", 3);
        $rows[] = new TimeSheetRow("04/02/2016", "Patrick", "Database model gemaakt en geimplementeerd", 3);
        $rows[] = new TimeSheetRow("04/02/2016", "Patrick", "Veel research gedaan naar veel Bootstrap mogelijkheden. Timesheet pagina aangepast om een gevoel te krijgen voor IDE en Bootstrap research toe te passen.", 2);
        $rows[] = new TimeSheetRow("04/02/2016", "Marius", "Database Klasse (PDO)", 2);
        $rows[] = new TimeSheetRow("05/02/2016", "Patrick", "Datum parsing + insert method voor timesheet gemaakt.", 2);
        $rows[] = new TimeSheetRow("05/02/2016", "Marius", "Datum parsing + uitleg gegeven (aan Patrick).", 2);
        $rows[] = new TimeSheetRow("05/02/2016", "Patrick", "Draggable panels gemaakt + layout improvements", 1.5);


        render("timesheet.php", ["title" => "Time Sheet", "rows" => $rows, "Marius" => $totalMarius, "Patrick" => $totalPatrick]);
    }

    public function CheckInsert()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!Empty($_POST["name"]) && !Empty($_POST["task"]) && !Empty($_POST["hours"])) {
                $this->ts->submitEntree($_POST["name"], $_POST["task"], $_POST["hours"]);
            }
        }
    }
}