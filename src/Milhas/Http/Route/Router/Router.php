<?php

namespace Milhas\Http\Route\Router;


use Milhas\Http\Request\Request;

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
            if($this->checkUrlAndMethod($url, $route))
                $found = $this->boot($route);
        });

        if($found == false)
            die('<pre><h1><b>Unexpected route. Route "'.$this->getUrl().'" could not be found.</b></h1></pre>');
    }

    /**
     * @param $route
     * @return bool
     */
    public function boot($route)
    {
        if(isset($route['use'])) {
            //Array with 'controller' and 'action'
            $controllerAndAction = $this->controllerAndAction($route);

            //Make class
            $controller = appMake("App\\Controllers\\" . ucfirst($controllerAndAction['controller']));

            //Get action
            $action = $controllerAndAction['action'];

            if(isset($_SERVER['HTTP_CONTENT_TYPE']) && strtoupper($_SERVER['HTTP_CONTENT_TYPE']) == strtoupper('application/json'))
                echo htmlspecialchars(($controller->$action(new Request())), ENT_QUOTES);
            else
                echo htmlspecialchars(($controller->$action()), ENT_QUOTES);
        }
        else
            $closure = $route['do'];

        //Changed found state
        return true;
    }

    /**
     * @param $url
     * @param $route
     * @return bool
     */
    public function checkUrlAndMethod($url, $route)
    {
        if(($url == $route['route']) &&
            (strtoupper($_SERVER['REQUEST_METHOD']) == strtoupper($route['method'])))
            return true;
        else
            return false;
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