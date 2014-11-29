<?php

/**
 * Class ModelMain
 */
class ModelDelete extends Model {

    /**
     *
     */
    function __construct()
    {
        $pdo = new MySQL();
        $this->pdo = $pdo->connect();
    }

    /**
     * @return mixed
     */
    public function getName($start, $filmsPerPage)
    {
        try {
            $query = "SELECT `id`,`name` FROM `films` LIMIT ?, ?";
            $stm = $this->pdo->prepare($query);
            $stm->bindValue(1, $start, PDO::PARAM_INT);
            $stm->bindValue(2, $filmsPerPage, PDO::PARAM_INT);
            $stm->execute();
            $data = $stm->fetchAll();
            return $data;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    /**
     * @param $checkbox
     * @return array
     */
    function delete($checkbox)
    {
        for ($i = 0; $i < count($checkbox); $i++) {
            $id = $checkbox[$i];
            $query = 'DELETE FROM films WHERE `id` = (:id)';
            $stm = $this->pdo->prepare($query);
            $stm->bindValue(':id', $id, PDO::PARAM_INT);
            $stm->execute();
        }
    }

}