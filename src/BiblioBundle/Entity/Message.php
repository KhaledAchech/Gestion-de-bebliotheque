<?php


namespace BiblioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * Class Document
 * @package BiblioBundle\Entity
 * @ORM\Entity
 */
class Message
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
    private $sujet;



}