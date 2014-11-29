<?php

/**
 * Class ModelMain
 */
class ModelImport extends Model {

    /**
     *
     */
    function __construct()
    {
        $pdo = new MySQL();
        $this->pdo = $pdo->connect();
        $this->view = new View();
    }

    /**
     * @return mixed
     */
    public function insertFilms($resultName, $resultYear, $resultFormat)
    {
        $resultName = trim($resultName);
        $resultYear = trim($resultYear);
        $resultFormat = trim($resultFormat);
        try {
            $update = 'INSERT IGNORE INTO `films`(`name`, `year`, `format`)
                       VALUES (:resultName, :resultYear, :resultFormat)';
            $stm = $this->pdo->prepare($update);
            $stm->bindValue(':resultName', $resultName);
            $stm->bindValue(':resultYear', $resultYear);
            $stm->bindValue(':resultFormat', $resultFormat);
            $stm->execute();
            return $stm;

        } catch (PDOException $e) {
            $e = 'Скорее всего все фильмы уже внесены в базу';
            $this->view->generate('ImportView.php', $e);
            die();
        }
    }

    /**
     * @return mixed
     */
    public function getFilm()
    {
        $query = 'SELECT `id`, `name` FROM `films`';
        $stmd = $this->pdo->prepare($query);
        $stmd->execute();
        return $stmd->fetchAll();
    }

    /**
     * @param $resultSurname
     * @param $resultName
     * @param $resultFilmId
     * @return mixed
     */
    public function insertActors($resultSurname, $resultName, $resultFilmId)
    {
        $update = 'INSERT IGNORE INTO `actors`(`surname`, `name`, `film_id`)
                   VALUES (:resultSurname, :resultName, :resultFilmId)';
        $stm = $this->pdo->prepare($update);
        $stm->bindValue(':resultSurname', $resultSurname);
        $stm->bindValue(':resultName', $resultName);

        $stm->bindValue(':resultFilmId', $resultFilmId);
        return $stm->execute();
    }
}