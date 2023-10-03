<?php

class Views
{
    function getView($controller, $view, $data = "")
    {
        $controller = get_class($controller);
        $controller = str_replace("Controller", "", $controller);
        if ($controller == "Home") {
            $view = "view/" . $view . ".php";
        } else {
            $view = "view/" . $controller . "/" . $view . ".php";
        }
        require_once($view);
    }
}
