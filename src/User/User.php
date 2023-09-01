<?php
namespace User;

class User
{
    /**
     * @var string
     */
    private $id_personne;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $prenom;


    /**
     * @return string
     */
    public function getId()
    {
        return $this->id_personne;
    }

    /**
     * @param string $id_personne
     * @return User
     */
    public function setId($id_personne)
    {
        $this->id_personne = $id_personne;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return User
     */
    public function setFirstname($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     * @return User
     */
    public function setLastname($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }
}

