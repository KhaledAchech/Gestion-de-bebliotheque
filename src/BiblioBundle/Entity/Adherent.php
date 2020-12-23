<?php
namespace BiblioBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Adherent
 * @package BiblioBundle\Entity
 * @ORM\Entity
 */
class Adherent extends User
{

    /**
     * @ORM\ManyToOne(targetEntity="Message")
     * @ORM\JoinColumn(name="message_id", referencedColumnName="id")
     */
    private $message;
/*
    /**
     * @ORM\ManyToOne(targetEntity="Emprunter")
     * @ORM\JoinColumn(name="emprunt_id", referencedColumnName="id")
     */
   // private $emprunt;

    /*
    public function __construct()
    {
        $this->emprunts = new ArrayCollection();
    }
    */
}