<?php
namespace BiblioBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Class Admin
 * @package BiblioBundle\Entity
 * @ORM\Entity
 */
class Admin extends User
{
    /**
     * @ORM\ManyToOne(targetEntity="Message")
     * @ORM\JoinColumn(name="message_id", referencedColumnName="id")
     */
    private $message;
}