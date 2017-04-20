<?php

namespace Milhas\Route;


use Milhas\Route\Router\Router;

class BaseRouter extends Router
{
    public function initRoutes()
    {
        $routes = include_once "../App/Routes.php";
        $this->setRoutes($routes);
    }
}