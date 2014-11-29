<?php

/**
 * Class ModelAdd
 */
class ModelAdd extends Model {

    function __construct()
    {
        //Соединяемся с базой
        $pdo = new MySQL();
        $this->pdo = $pdo->connect();
        $this->view = new View();
    }

    /**
     * @param $name
     * @param $year
     * @param $format
     * @return mixed
     */
    public function addFilms($name, $year, $format)
    {

        try {
            $query = 'INSERT INTO `films` (`name`, `year`, `format`) VALUES (:name, :year, :format);';

            $stm = $this->pdo->prepare($query);
            $stm->bindValue(':name', $name);
            $stm->bindValue(':year', $year);
            $stm->bindValue(':format', $format);

            $stm->execute();
            return $stm;
        } catch (PDOException $e) {
            $this->view->generate('AddView.php');
            die();
        }
    }


    /**
     * @param $actorsArr
     * @return mixed
     */
    public function addActors($actorsArr, $id)
    {
        foreach ($actorsArr as $actor) {
            //Получаем отдельно имя и фамилию для каждого актера.
            $actor = explode(' ', $actor, 2);
            $actorName = $actor[0];
            if (!empty($actor[1])) {
                $actorSurname = $actor[1];

                $actorQuery = 'INSERT INTO `actors` (`name`, `surname`, `film_id`) VALUES (:actorName, :actorSurname, :filmId);';
                $stm = $this->pdo->prepare($actorQuery);
                $stm->bindValue(':actorName', $actorName);
                $stm->bindValue(':actorSurname', $actorSurname);
                $stm->bindValue(':filmId', $id);
                $stm->execute();
            } else {

                $actorQuery = 'INSERT INTO `actors` (`name`, `film_id`) VALUES (:actorName, :filmId);';
                $stm = $this->pdo->prepare($actorQuery);
                $stm->bindValue(':actorName', $actorName);
                $stm->bindValue(':filmId', $id);
                $stm->execute();
            }
        }
    }
}