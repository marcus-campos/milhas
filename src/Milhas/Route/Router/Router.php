<?php

namespace Milhas\Route\Router;


use Milhas\Route\Request\Request;

abstract class Router
{
    private $routes;

    /**
     * Hecate constructor.
     */
    public function __construct()
    {
        $this->initRoutes();
        $this->run($this->getUrl());
    }

    abstract protected function initRoutes();

    /**
     * @param $url
     */
    protected function run($url)
    {
        $found = false;

        array_walk($this->routes, function ($route) use ($url, &$found) {
            if(($url == $route['route']) &&
               (strtoupper($_SERVER['REQUEST_METHOD']) == strtoupper($route['method'])))
            {
                if(isset($route['use'])) {
                    //Split $route['use'] and return one array with 'controller' and 'action'
                    $controllerAndAction = $this->controllerAndAction($route);


                    //Make class
                    $class = "App\\Controllers\\" . ucfirst($controllerAndAction['controller']);
                    $controller = new $class;

                    //Run action
                    $action = $controllerAndAction['action'];

                    if(strtoupper($_SERVER['HTTP_CONTENT_TYPE']) == strtoupper('application/json'))
                        $controller->$action(new Request());
                    else
                        $controller->$action();
                }
                else
                    $closure = $route['do'];

                //Changed found state
                $found = true;
            }
        });

        if($found == false)
            die('<pre><h1><b>Unexpected route. Route "'.$this->getUrl().'" could not be found.</b></h1></pre>');
    }

    /**
     * @param $route
     * @return array
     */
    protected function controllerAndAction($route)
    {
        $split = explode("@", $route['use']);

        $controller = $split[0];
        $action = $split[1];

        return [
            'controller' => $controller,
            'action' => $action
        ];
    }

    /**
     * @param array $routes
     */
    protected function setRoutes(array $routes)
    {
        $this->routes = $routes;
    }

    /**
     * @return mixed
     */
    protected function getUrl()
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
}