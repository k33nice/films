<?php

/**
 * Class ControllerAdd
 */
class ControllerAdd extends Controller {
    function __construct()
    {
        $this->view = new View();
        $this->modelAdd = new ModelAdd();
        $this->model = new Model();
    }

    /**
     *
     */
    function actionIndex()
    {
        $this->view->generate('AddView.php');
    }

    /**
     * Добавление фильмов и актеров в базу данных
     */
    function actionAdd()
    {
        if (isset($_POST)) {
            $name = $_POST['name'];
            $year = $_POST['year'];
            $format = $_POST['format'];
            $actors = $_POST['actors'];

            //Создаем масив актеров разделением строки
            $actorsArr = explode(', ', $actors);

            //Отправляем данные о фильме в метод модель, которая добавит их в базу данных
            $data = $this->modelAdd->addFilms($name, $year, $format);

            //Поскольку актеры у нас хранятся в отдельной таблице и связаны ключем с таблицой фильмов
            //получаем id фильма
            $id = $this->model->getId();

            //отправляем масив актеров и id фильма в метод модели, который добавит их в базу
            $this->modelAdd->addActors($actorsArr, $id);
        }
        $this->view->generate('AddView.php', $data);
    }
}