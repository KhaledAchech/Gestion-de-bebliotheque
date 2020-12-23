<?php
namespace BiblioBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Class Document
 * @package BiblioBundle\Entity
 * @ORM\Entity
 */

class Document
{
    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column (type="integer")
     */
    private $id;

    /**
     * @ORM\Column (type="string", length = 255)
     */
    private $nom;

    /**
     * @ORM\Column (type="date")
     */
    private $date;

    /**
     * @ORM\Column (type="string", length = 255)
     */
    private $auteur;

    /**
     * @ORM\Column (type="string", length = 20)
     */
    private $type;

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
/*
    /**
     * @ORM\ManyToOne(targetEntity="Emprunter")
     * @ORM\JoinColumn(name="emprunt_id", referencedColumnName="id")
     */
  //  private $emprunt;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

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
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * @param mixed $auteur
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    }


}