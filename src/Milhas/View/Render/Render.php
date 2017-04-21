<?php

namespace Milhas\View\Render;


abstract class Render
{
    protected $view;

    /**
     * Render constructor.
     */
    public function __construct()
    {
        $this->view = new \stdClass();
    }

    /**
     * @param $action
     * @param array $params
     * @return mixed
     */
    protected function render($action, array $params = [])
    {
        //Set params to view
        if($params != null && count($params) > 0)
            $this->compact($params);

        //Search if has double bars
        $pos = strpos($action, '//');

        //Check if has double bars
        if($pos !== true)
            $action = str_replace(".","//", $action); //Replace . to //

        //Include view
        include_once rootPath("App/Views/".$action.".phtml");
    }

    private function compact(array $params)
    {
        //Foreach params
        foreach ($params as $key => $value)
            $this->view->$key = $value; //Set param
    }
}