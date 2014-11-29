<?php

/**
 * Class ControllerDelete
 */
class ControllerDelete extends Controller {

    function __construct()
    {
        $this->view = new View();
        $this->modelDelete = new ModelDelete();
        $this->model = new Model();
    }

    /**
     * Генерируем страничку из фильмов
     */
    function actionIndex($actionPage)
    {
        $filmsPerPage = 10;


        $getCount = $this->model->countFilms();
//        $getCount = $this->model->countFilms();
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
        $data = $this->modelDelete->getName($start, $filmsPerPage);
        $data = array(
                'data'       => $data,
                'actionPage' => $actionPage,
                'totalPages'  => $totalPages,
        );
        $this->view->generate('DeleteView.php', $data);
    }

    /**
     * @param $actionPage
     */
    function actionDelete($actionPage)
    {
        if (isset($_POST['submit'])) {
            $checkbox = $_POST['checkbox'];

            //Отправляем массив чекбоксов в метод, который удалит фильмы из базы.
            $this->modelDelete->delete($checkbox);

            //Получаем оставшиеся фильмы и генерируем страничку с ними.
            $this->actionIndex($actionPage);
        }
    }
}
