<?php
namespace Cours;
class Cours
{
    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $id_salle;

    /**
     * @var string
     */
    private $type;


    /**
     * @return string
     */
    public function getProfesseur()
    {
        return $this->nom;
    }

    /**
     * @param string $id_personne
     * @return User
     */
    public function setProfesseur($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return string
     */
    public function getSalle()
    {
        return $this->id_salle;
    }

    /**
     * @param string $nom
     * @return User
     */
    public function setSalle($nom)
    {
        $this->id_salle = $id_salle;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $prenom
     * @return User
     */
    public function setType($prenom)
    {
        $this->type = $type;
        return $this;
    }
}

