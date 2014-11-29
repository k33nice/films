<?php

/**
 * Class View
 */
class View {

    function __construct()
    {
    }

    /**
     * @param $view
     * @param null $data
     */
    public function generate($view, $data = null)
    {
        if (is_array($data)) {
            extract($data);
        }
        include APPPATH . '/application/views/template.php';
    }

}