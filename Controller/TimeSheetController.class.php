<?php

/**
 * Created by PhpStorm.
 * User: Marius
 * Date: 3-2-2016
 * Time: 21:10
 */
class TimeSheetController
{
    public function Run() {

        $rows = array();
        $rows[] = new TimeSheetRow("3/2/16", "Marius", "OO php leren", 0.5);
        $rows[] = new TimeSheetRow("3/2/16", "Marius", "IDE opzetten met MySQL & Apache", 1);
        $rows[] = new TimeSheetRow("3/2/16", "Marius", "Opzetten Structuur", 2.5);
        $rows[] = new TimeSheetRow("3/2/16", "Marius", ".htaccess mooi maken", 1);
        $rows[] = new TimeSheetRow("3/2/16", "Marius", "Smarty geimplementeerd", 0.5);

        $totalMarius = 0;
        $totalPatrick = 0;
        foreach ($rows as $value)
        {
            if($value->Name == "Marius")
                $totalMarius += $value->Time;
            else
                $totalPatrick += $value->Time;
        }
        render("timesheet.php" , ["title" => "Time Sheet", "rows" => $rows, "Marius" => $totalMarius, "Patrick" => $totalPatrick]);
    }
}