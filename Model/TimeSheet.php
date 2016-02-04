<?php

/**
 * Created by PhpStorm.
 * User: Marius
 * Date: 4-2-2016
 * Time: 12:32
 */
class TimeSheet
{
    public function getEntrees()
    {
        $rows = array();

        $db = new Database();
        $db->query("SELECT * FROM `timesheet`");
        $res = $db->getRows();

        foreach($res as $val)
        {
            $rows[] = new TimeSheetRow($val['Date'], $val['Name'], $val['Task'], $val['Time']);
        }

        return $rows;
    }

    public function getTotals()
    {
        $rows = $this->getEntrees();

        $totalMarius = 0;
        $totalPatrick = 0;
        foreach ($rows as $value) {
            if ($value->Name == "Marius")
                $totalMarius += $value->Time;
            else
                $totalPatrick += $value->Time;
        }

        $tmp = array("Marius" => $totalMarius, "Patrick" => $totalPatrick);
        return $tmp;
    }
}