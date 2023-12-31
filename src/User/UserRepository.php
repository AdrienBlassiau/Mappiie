<?php
namespace User;
class UserRepository
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
    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "personne"')->fetchAll(\PDO::FETCH_OBJ);
        $users = [];
        foreach ($rows as $row) {
            $user = new User();
            $user
                ->setId($row->id_personne)
                ->setFirstname($row->prenom)
                ->setLastname($row->nom);
            $users[] = $user;
        }
        return $users;
    }
}