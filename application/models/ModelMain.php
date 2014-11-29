<?php

/**
 * Class ModelMain
 */
class ModelMain extends Model {

    function __construct()
    {
        $pdo = new MySQL();
        $this->pdo = $pdo->connect();
    }


    /**
     * @param $start
     * @param $filmsPerPage
     * @return mixed
     */
    public function getName($start, $filmsPerPage)
    {
        $query = "SELECT `id`,`name` FROM `films` LIMIT ?, ?";
        $stm = $this->pdo->prepare($query);
        $stm->bindValue(1, $start, PDO::PARAM_INT);
        $stm->bindValue(2, $filmsPerPage, PDO::PARAM_INT);
        $stm->execute();
        $data = $stm->fetchAll();
        return $data;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function searchName($name)
    {
        $name = '%' . $name . '%';
        $query = 'SELECT * FROM films WHERE `name` LIKE :name';
        $stm = $this->pdo->prepare($query);
        $stm->bindParam(':name', $name, PDO::PARAM_STR);
        $stm->execute();
        $search = $stm->fetchAll();
        return $search;
    }

    /**
     * @param $name
     * @param $surname
     * @return mixed
     */
    public function searchActor($name, $surname = '')
    {
        $name = '%' . $name . '%';
        if (!empty($surname)) {
            $surname = '%' . $surname . '%';

            $query = 'SELECT films.name, films.id
                      FROM `films` JOIN `actors` ON films.id=actors.film_id
                      WHERE (actors.name LIKE :name AND actors.surname LIKE :surname) ';
            $stm = $this->pdo->prepare($query);
            $stm->bindParam(':name', $name, PDO::PARAM_STR);
            $stm->bindParam(':surname', $surname, PDO::PARAM_STR);
            $stm->execute();
        } else {
            $query = 'SELECT films.name, films.id
                      FROM `films` JOIN `actors` ON films.id=actors.film_id
                      WHERE actors.name LIKE :name';
            $stm = $this->pdo->prepare($query);
            $stm->bindParam(':name', $name, PDO::PARAM_STR);
            $stm->execute();
        }

        $search = $stm->fetchAll();
        return $search;
    }

}