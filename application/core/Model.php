<?php

/**
 * Class Model
 */
class Model {

    function __construct()
    {
        $pdo = new MySQL();
        $this->pdo = $pdo->connect();
    }

    /**
     * @return mixed
     */
    public function countFilms()
    {
        $query = 'SELECT COUNT(`id`) FROM `films`';
        $stm = $this->pdo->prepare($query);
        $stm->execute();
        return $stm->fetch();
    }

    /**
     * @return int
     */
    public function getId()
    {

        $select = 'SELECT `id` FROM `films` ORDER BY `id`';
        $stm = $this->pdo->prepare($select);
        $stm->execute();
        $id = $stm->fetchAll();
        $id = array_pop($id);
        $filmId = (integer)($id['id']);
        return $filmId;
    }

}