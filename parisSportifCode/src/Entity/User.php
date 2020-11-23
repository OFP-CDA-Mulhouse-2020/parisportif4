<?php


namespace App\Entity;

class User
{
    private $nom;
    private $prenom;

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom): void
    {
        if(!preg_match("/^[a-zA-Z]+$/", $nom)){

            throw new \InvalidArgumentException('containe number');
        }
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom): void
    {
        if(!preg_match("/^[a-zA-Z]+$/", $prenom)){

            throw new \InvalidArgumentException('containe number');
        }
        $this->prenom = $prenom;
    }
}
