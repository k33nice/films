<?php

/**
 * Class ControllerInfo
 */
class ControllerInfo extends Controller {
    function __construct()
    {
        $this->view = new View();
        $this->modelInfo = new ModelInfo();
    }

    /**
     *
     */
    function actionIndex()
    {
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];

            //Получаем информацию о фильме по его идентификатору который получили из невидимого инпута
            $data = $this->modelInfo->getInfo($id);
            $name = $data[0]['name'];
            $year = $data[0]['year'];
            $format = $data[0]['format'];

            //Превращяем массив с актерами в строку разделяя имя и фамилию пробелом, а отдельных актеров запятыми
            $starName = '';
            foreach($data as $stars) {
                $starName .= $stars['actor_name'] . ' ' . $stars['surname'] . ', ';
            }
            $starName = rtrim($starName, ', ');

            //Отправляем массив с информацией о фильме на страницу
            $data = array('name' => $name, 'year' => $year, 'format' => $format, 'starName' => $starName);
            $this->view->generate('InfoView.php', $data);
        }
    }


}