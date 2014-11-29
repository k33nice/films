<?php

/**
 * Class ModelInsert
 */
class ModelInsert extends Model {

    function __construct()
    {
        $pdo = new MySQL();
        $this->pdo = $pdo->connect();
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        try {

            $query = "SELECT `name` FROM `films`";
            $stm = $this->pdo->prepare($query);
            $stm->execute();
            $surname = $stm->fetchAll();
            return $surname;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

}