<?php

/**
 * Class ControllerImport
 */
class ControllerImport extends Controller {

    function __construct()
    {
        $this->view = new View();
        $this->modelImport = new ModelImport();

    }

    /**
     *
     */
    function actionIndex()
    {
        $this->view->generate('ImportView.php');
    }



    /**
     *
     */
    function actionInsert()
    {
        if (isset($_POST['submit'])) {
            $handle = opendir('public/uploads/');
            while (false !== ($entry = readdir($handle))) {
                $content = file('public/uploads/' . $entry);

                $title = 'Title';
                $year = 'Release Year';
                $format = 'Format';

                //Формируем массив из блоков с информацией о фильме
                $act = implode($content);
                $blocks = explode('Title:', $act);

                foreach ($content as $line) { // читаем построчно

                    // разбиваем строку по первому совпадению ': ' и записываем в массив
                    $result = explode(': ', $line, 2);


                    switch ($result[0]) {
                        case $title:
                            $resultName = $result[1];
                            continue;
                        case $year:
                            $resultYear = $result[1];
                            continue;
                        case $format:
                            $resultFormat = $result[1];

                            //Отправляем название фильма, год выпуска и формат в метод модели который внесет их в базу
                            $this->modelImport->insertFilms($resultName, $resultYear, $resultFormat);

                            break;
                    }

                }

                //Получаем массив имен и идентификаторов фильмов
                $nameArr = $this->modelImport->getFilm();
                foreach ($blocks as $block) {

                    //Заменяем в каждом блоке с информацией о фильме, которая имеет вид
                    // ('Blazing SaddlesRelease Year: 1974Format: VHSStars: Mel Brooks, Clevon Little,
                    // Harvey Korman, Gene Wilder, Slim Pickens, Madeline Kahn')
                    // 'Release Year:', 'Format:', 'Stars:' на разделитель '/*/' - чтобы была извлечь имена актеров
                    // '/*/' такой разделитель врятли встретится в информации о фильме.
                    $replace = array('Release Year:', 'Format:', 'Stars:');



                    $block = str_replace($replace, "/*/", $block);
                    $result = explode('/*/ ', $block);
                    if (!empty($result[3])) {
                        $resultStars = $result[3];
                        for ($i = 0; $i < count($nameArr); $i++) {
                            $name = $nameArr[$i];
                            $name1 = $name['name'];
                            $name1 = (string)$name1;
                            $id1 = $name['id'];

                            if (strpos($block, $name1) === 1) {
                                $resultFilmId = $id1;
                                $arrStars = explode(', ', $resultStars);

                                foreach ($arrStars as $star) {

                                    //Разбиваем строку с именем и фамилией по первому пробелу
                                    $star = explode(' ', $star, 2);
                                    $resultName = $star[0];
                                    $resultSurname = $star[1];

                                    //Отправляем имя, фамилию и идентификатор фильма в метод модели который добавит их в базу
                                    $this->modelImport->insertActors($resultSurname, $resultName, $resultFilmId);
                                }

                            }
                        }
                    }
                }
            }
        }

        $this->view->generate('ImportView.php');

    }

    function actionA()
    {
        $a = array('a', 'b', 'c');
        $b = 'a'.$a;
        print_r($b);
    }
}
