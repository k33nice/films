<?php

/**
 * Class Route
 */
class Route {

    function __construct()
    {

    }

    /**
     *
     */
    public static function start()
    {
        //назначение параметров по умолчанию
        $controllerName = 'Main';
        $actionName = 'Index';
        $actionPage = '';

        //преобразуем строку запроса в массив
        $routeArray = explode('/', $_SERVER['REQUEST_URI']);

        if (!empty($routeArray[1])) {
            $controllerName = ucfirst($routeArray[1]);
        }

        if (!empty($routeArray[2])) {
            $actionName = ucfirst($routeArray[2]);
        }

        if (!empty($routeArray[3])) {
            $actionPage = $routeArray[3];
        }

        // добавляем префиксы
        $modelName = 'Model' . $controllerName;
        $controllerName = 'Controller' . $controllerName;
        $actionName = 'action' . $actionName;

        if (file_exists(APPPATH . '/application/models/' . $modelName . '.php')) {
            include APPPATH . '/application/models/' . $modelName . '.php';
        }

        if (file_exists(APPPATH . '/application/controllers/' . $controllerName . '.php')) {
            include_once APPPATH . '/application/controllers/' . $controllerName . '.php';
        } else {
            header('Location: /404');
            exit;
        }

        $controller = new $controllerName();
        $controller->$actionName($actionPage);

    }

}
