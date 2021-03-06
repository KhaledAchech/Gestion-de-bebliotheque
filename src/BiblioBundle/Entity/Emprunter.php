<?php


namespace BiblioBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Class Document
 * @package BiblioBundle\Entity
 * @ORM\Entity
 */


class Emprunter
{
    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column (type="integer")
     */
    private $id;

    /**
     * @ORM\Column (type="date")
     */
    private $date_emp;

    /**
     * @ORM\Column (type="date", nullable=TRUE)
     */
    private $date_retour;


    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="adherent_id", referencedColumnName="id")
     */
    private $emprunteur;

    /**
     * @return mixed
     */
    public function getEmprunteur()
    {
        return $this->emprunteur;
    }

    /**
     * @param mixed $emprunteur
     */
    public function setEmprunteur($emprunteur)
    {
        $this->emprunteur = $emprunteur;
    }

    /**
     * @return mixed
     */
    public function getDocument_Emprunte()
    {
        return $this->Document_emprunte;
    }

    /**
     * @param mixed $Document_emprunte
     */
    public function setDocumentEmprunte($Document_emprunte)
    {
        $this->Document_emprunte = $Document_emprunte;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Document")
     * @ORM\JoinColumn(name="document_id", referencedColumnName="id")
     */
    private $Document_emprunte;


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
    public function getDate_Emp()
    {
        return $this->date_emp;
    }

    /**
     * @param mixed $date_emp
     */
    public function setDateEmp($date_emp)
    {
        $this->date_emp = $date_emp;
    }

    /**
     * @return mixed
     */
    public function getDate_Retour()
    {
        return $this->date_retour;
    }
    /**
     * @return mixed
     */
    public function getDateRetour()
    {
        return $this->date_retour;
    }

    /**
     * @param mixed $date_retour
     */
    public function setDateRetour($date_retour)
    {
        $this->date_retour = $date_retour;
    }



}