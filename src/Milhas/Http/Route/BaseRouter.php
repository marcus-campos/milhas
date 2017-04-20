<?php

namespace Milhas\Http\Route;


use Milhas\Http\Route\Router\Router;

class BaseRouter extends Router
{
    public function initRoutes()
    {
        $routes = include_once "../App/Routes.php";
        $this->setRoutes($routes);
    }
}