<?php

/**
 * Created by PhpStorm.
 * User: Marius
 * Date: 3-2-2016
 * Time: 19:19
 */
class Database
{

    private $conn, $result;

    public function  __construct()
    {
        $this->conn = new mysqli('localhost', 'root', '', 'php06');
        if ($this->conn->connect_errno != 0) //er gaat iets fout ...
        {
            die("Probleem bij het leggen van connectie of selecteren van database");
        }

    }

    public function Query()
    {
        // SQL statement
        $sql = func_get_arg(0);

        // parameters, if any
        $parameters = array_slice(func_get_args(), 1);


        $count = count($parameters);
        $stmt = $this->conn->prepare($sql);

        $a_params[] = & $param_type;

        if($count != 0)
        {
            // set array to references
            for($i = 0; $i < $count; $i++) {
                /* with call_user_func_array, array params must be passed by reference */
                $ref_params[] = & $parameters[$i];
            }

            call_user_func_array(array($stmt, "bind_param"), array_merge(array($type), $params));

        }

        $stmt->execute();


    }

    public function GetRow()
    {

    }

}