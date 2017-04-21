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
            if($result = $this->checkUrlAndMethod($url, $route))
                $found = $this->boot($route, $result);
        });

        if($found == false)
            die('<pre><h1><b>Unexpected route. Route "'.$this->getUrl().'" could not be found.</b></h1></pre>');
    }

    /**
     * @param $route
     * @return bool
     */
    public function boot($route, $result)
    {
        unset($result['params'][0]);

        if(isset($route['use'])) {
            //Array with 'controller' and 'action'
            $controllerAndAction = $this->controllerAndAction($route);

            //Make class
            $controller = appMake("App\\Controllers\\" . ucfirst($controllerAndAction['controller']));

            //Get action
            $action = $controllerAndAction['action'];

            if(isset($_SERVER['HTTP_CONTENT_TYPE']) && strtoupper($_SERVER['HTTP_CONTENT_TYPE']) == strtoupper('application/json'))
                if($result['result'] > 0)
                    echo htmlspecialchars(($controller->$action(new Request(), $result['params'])), ENT_QUOTES);
                else
                    echo htmlspecialchars(($controller->$action(new Request())), ENT_QUOTES);
            else
                if($result['result'] > 0)
                    echo htmlspecialchars(($controller->$action($result['params'])), ENT_QUOTES);
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
     * @return array|bool
     */
    public function checkUrlAndMethod($url, $route)
    {
        $result = $this->checkUrl($route['route'], $url);

        if(($url == $route['route'] or  $result['result'] > 0) &&
            (strtoupper($_SERVER['REQUEST_METHOD']) == strtoupper($route['method'])))
            return $result;
        else
            return false;

    }

    /**
     * @param string $toFind
     * @param $subject
     * @return array
     */
    private function checkUrl(string $toFind, $subject)
    {
        preg_match_all('/\{([^\}]*)\}/', $toFind, $variables);
        $regex = str_replace('/', '\/', $toFind);
        foreach ($variables[1] as $k=>&$variable) {
            $as = explode(':', $variable);
            $replacement = $as[1] ?? '([a-zA-Z0-9\-\_\ ]+)';
            $regex = str_replace($variables[$k], $replacement, $regex);
        }
        $regex = preg_replace('/{([a-zA-Z]+)}/', '([a-zA-Z0-9]+)', $regex);
        $result = preg_match('/^'.$regex.'$/', $subject, $params);
        return compact('result', 'params');
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