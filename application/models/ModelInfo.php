<?php


/**
 * Class ModelInfo
 */
class ModelInfo extends Model {

    /**
     *
     */
    function __construct()
    {
        $pdo = new MySQL();
        $this->pdo = $pdo->connect();
    }


    /**
     * @param $id
     */
    public function getInfo($id)
    {
        try {
            $query = "SELECT films.name, films.year, films.format, actors.name as actor_name, actors.surname
                      FROM `films`JOIN `actors` ON films.id=actors.film_id
                      WHERE films.id=(:id)";
            $stm = $this->pdo->prepare($query);
            $stm->bindValue(':id', $id, PDO::PARAM_INT);
            $stm->execute();
            $data = $stm->fetchAll();

            return $data;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }


}