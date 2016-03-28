<?php

/**
 * Created by PhpStorm.
 * User: Marius
 * Date: 16-2-2016
 * Time: 21:55
 */
class ComparisonChart
{
    public function __construct()
    {
        if (Empty($_SESSION["comparison"])) {
            $_SESSION["comparison"] = [];
        }
    }

    public function getHrefByArrayIds($array)
    {
        if (Empty($array))
            return "/catalogue";

        $link = "/catalogue/comparison=";
        $count = 0;
        foreach ($array as $item) {
            $count++;
            if ($count == 1)
                $link = $link . "$item";
            else
                $link = $link . ",$item";

        }
        return $link;
    }

    public function getHrefByArrayProducts($array)
    {
        if (Empty($array))
            return "/catalogue";

        $link = "/catalogue/comparison=";
        $count = 0;
        foreach ($array as $item) {
            $count++;
            if ($count == 1)
                $link = $link . "$item->Id";
            else
                $link = $link . ",$item->Id";

        }
        return $link;
    }

    /** Forms a reference to the comparison chart according to filled session array of Products. */
    public function getHref()
    {
        if (Empty($_SESSION["comparison"]))
            return "/catalogue";

        $link = "/catalogue/comparison=";
        $count = 0;
        foreach ($_SESSION["comparison"] as $item) {
            $count++;
            if ($count == 1)
                $link = $link . "$item->Id";
            else
                $link = $link . ",$item->Id";
        }
        return $link;
    }

    /** Adds an item to the session by fetching it by ID and then appending it to the array. */
    public function addItem($id)
    {

        if (filter_var($id, FILTER_VALIDATE_INT) === false)
            return false;

        $c = count($_SESSION["comparison"]);

        if ($c > 2) {
            return false;
        }

        $new = (new Catalogue())->getItem($id);
        if ($new !== false) {
            $_SESSION["comparison"][] = $new;
            return true;
        }
        return false;

    }

    public function removeItemFromArray($id, $array)
    {
        if (filter_var($id, FILTER_VALIDATE_INT) === false)
            return false;

        $c = count($array);
        for ($i = 0; $i < $c; $i++) {
            if (!Empty($array[$i])) {
                if ($array[$i] == $id) {
                    unset($array[$i]);
                    $res = array_values($array);
                    return $res;
                }
            }
        }
        return false;
    }

    /** Removes item from session array at given index of item. */
    public
    function removeItem($id)
    {
        if (filter_var($id, FILTER_VALIDATE_INT) === false)
            return false;

        if ($this->getHrefByArrayProducts($_SESSION["comparison"]) == $_SERVER[REQUEST_URI]) {
            $c = count($_SESSION["comparison"]);
            for ($i = 0; $i < $c; $i++) {
                if (!Empty($_SESSION["comparison"][$i])) {
                    if ($_SESSION["comparison"][$i]->Id == $id) {
                        unset($_SESSION["comparison"][$i]);
                        $_SESSION["comparison"] = array_values($_SESSION["comparison"]);
                        return true;
                    }
                }
            }
        }
        return false;
    }

    /** Return a list of Product models fetched with a list of Product IDs. */
    public
    function getItems($array)
    {
        $items = array();
        for ($i = 0; $i < 3; $i++) {
            if (!empty($array[$i])) {
                if (filter_var($array[$i], FILTER_VALIDATE_INT) === false)
                    return false;

                $new = (new Catalogue())->getItem($array[$i]);
                if ($new != false) {
                    $items[] = $new;
                }
            }
        }
        return $items;
    }

    /** Returns all Product models currently within the session. */
    public
    function getChart()
    {
        $items = [];
        $c = count($_SESSION["comparison"]);
        for ($i = 0; $i < $c; $i++) {
            if (!empty($_SESSION["comparison"][$i])) {
                $new = $_SESSION["comparison"][$i];
                $items[] = $new;
            }
        }
        return $items;
    }

    /** Returns the count of the session content. */
    public
    function ItemCount()
    {
        return count($_SESSION["comparison"]);
    }

}