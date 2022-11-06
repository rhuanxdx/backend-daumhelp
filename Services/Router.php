<?php

namespace Services;

/**
 * Class responsible for all API response methods
 **/
class Router
{
    /**
     * Method that starts the API routes service
     *
     * @param array $routes
     * 
     * @return void
     */
    public static function Init($routes)
    {
        $url = '/';
        $arrRoutes = array();
        $methods = array();
        $params = array();
        $currentController = 'ErrorController';
        $currentAction = 'NotFound';

        if (isset($_GET['url'])) $url .= $_GET['url'];
        foreach ($routes as $route) {
            $arrRoutes[$route["route_name"]] = $route["route_value"];
            $methods[$route["route_value"]] = $route["methods"];
        }

        $url = Self::CheckRoutes($url, $arrRoutes);
        $strUrl = "";
        if (!empty($url) && $url != '/') {

            $strUrl = $url;
            $url = explode('/', $url);

            $currentController = $url[0] . 'Controller';
            array_shift($url);

            $currentAction = 'index';
            if (isset($url[0]) && !empty($url[0])) {
                $currentAction = $url[0];
                array_shift($url);
            }
            if (count($url) > 0) {
                $params = $url;
            }
        }

        $currentController = ucfirst($currentController);

        $prefix = '\Controllers\\';
        if (
            !file_exists('Controllers/' . $currentController . '.php') ||
            !method_exists($prefix . $currentController, $currentAction)
        ) {
            $currentController = 'ErrorController';
            $currentAction = 'NotFound';
        }

        if ($strUrl and !\Server\Request::ValidateMethod($methods[$strUrl])) {
            $currentController = 'ErrorController';
            $currentAction = 'InvalidMethod';
        }
        $newController = $prefix . $currentController;

        $c = new $newController();

        call_user_func_array(array($c, $currentAction), $params);
    }
    /**
     * Method that checks if the current url is a valid route.
     * This method is only used by the class
     *
     * @param string $url
     * @param array $routes
     * 
     * @return mixed|bool
     */
    private static function CheckRoutes($url, $routes)
    {
        foreach ($routes as $route_name => $route_value) {
            $pattern = preg_replace('(\{[a-z0-9]{1,}\})', '([a-z0-9-]{1,})', $route_name);
            if (preg_match('#^(' . $pattern . ')*$#i', $url, $matches) === 1) {
                array_shift($matches);
                array_shift($matches);

                $itens = array();
                if (preg_match_all('(\{[a-z0-9]{1,}\})', $route_name, $m)) {
                    $itens = preg_replace('(\{|\})', '', $m[0]);
                }

                $arg = array();
                foreach ($matches as $key => $match) $arg[$itens[$key]] = $match;

                foreach ($arg as $argkey => $argvalue) $route_value = str_replace(':' . $argkey, $argvalue, $route_value);

                return $route_value;
            }
        }
        return false;
    }
}
