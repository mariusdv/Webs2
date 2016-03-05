<?php

/**
 * Created by PhpStorm.
 * User: patri
 * Date: 3/4/2016
 * Time: 3:03 PM
 */
class BreadcrumbTrial
{
    private $breadcrumbs = array();

    public function add($label, $link)
    {
        $this->breadcrumbs[] = array($label, $link);
    }

    public function toArray()
    {
        return $this->breadcrumbs;
    }

    public function disable() {
        $this->breadcrumbs = null;
    }
}