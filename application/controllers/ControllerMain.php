<?php

/**
 * Class ControllerMain
 */
class ControllerMain extends Controller {

    function __construct()
    {
        $this->view = new View();
        $this->modelMain = new ModelMain();
    }


    /**
     * @param $actionPage
     */
    function actionIndex($actionPage)
    {
        $filmsPerPage = 10;


        $getCount = $this->modelMain->countFilms();
        $count = $getCount['COUNT(`id`)'];
        $totalPages = (integer)(($count-1)/$filmsPerPage + 1);
        $actionPage = (integer)$actionPage;
        if ($actionPage > $totalPages) {
            $actionPage = $totalPages;
        }
        if (empty($actionPage) OR $actionPage < 0 ) {
            $actionPage = 1;
        }
        $start = $actionPage*$filmsPerPage - $filmsPerPage;
        $data = $this->modelMain->getName($start, $filmsPerPage);
        $data = array(
                'data'       => $data,
                'actionPage' => $actionPage,
                'totalPages'  => $totalPages,
        );
        $this->view->generate('MainView.php', $data);
    }

    /**
     *
     */
    function actionSearch()
    {
        //Если поиск осуществлялся по названию фильма вызываем метод модели который найдет все совпадения строки
        // полученой из поля поиска со названиями фильмов в базе данных
        //далее отправляем масив найденых фильмов на страницу
        if (isset($_POST['submit'])) {
            $name = $_POST['search'];
            $search = $this->modelMain->searchName($name);
            $this->view->generate('MainView.php', $search);
        }
        //Если поиск осуществлялся по имени актера, то разделяем строку из запроса по пробелу и отправляем имя и фамилию
        //актера в метод который найдет актера по имени или по имени и фамилии и вернет нам масив фильмов в которых
        //снимался актер.
        if (isset($_POST['submit-actor'])) {
            $post = $_POST['search-actor'];
            list($name, $surname) = preg_split("/ /", $post);

            $searchActor = $this->modelMain->searchActor($name, $surname);
            $this->view->generate('MainView.php', $searchActor);
        }
    }
}