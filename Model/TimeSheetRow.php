<?php

/**
 * Created by PhpStorm.
 * User: Marius
 * Date: 3-2-2016
 * Time: 21:21
 */
class TimeSheetRow
{
    public $Date,$Name,$Task,$Time;

    public function  __construct($Date,$Name,$Task,$Time)
    {
        $this->Date = $Date;
        $this->Name = $Name;
        $this->Task = $Task;
        $this->Time = $Time;
    }

    //
}
