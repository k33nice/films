<?php

/**
 * Class Controller404
 */
class Controller404 extends Controller {

    function __construct()
    {
    }

    /**
     *
     */
    public function actionIndex()
    {
        $view = new View();
        $view->generate('404.php');
    }

}