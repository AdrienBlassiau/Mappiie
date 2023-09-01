<?php
namespace Cours;
class CoursRepository
{
    /**
     * @var \PDO
     */
    private $connection;
    /**
     * UserRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll($date,$groupe)
    {
        $rows = $this->connection->query("SELECT 'nom','id_salle','type' FROM 'cours' NATURAL JOIN ('intervention' JOIN ('professeur'  JOIN 'personne' ) ON 'id_personne'='id_professeur') WHERE 'date_inter'=".$date." AND 'id_groupe'=".$groupe.";")->fetchAll(\PDO::FETCH_OBJ);
        $interventions = [];
        foreach ($rows as $row) {
            $inter = new User();
            $inter
                ->setProfesseur($row->nom)
                ->setSalle($row->id_salle)
                ->setType($row->type);
            $interventions[] = $inter;
        }
        return $interventions;
    }
}