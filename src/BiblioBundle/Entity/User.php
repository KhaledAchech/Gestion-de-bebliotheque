<?php
namespace BiblioBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * Class User
 * @package BiblioBundle\Entity
 * @ORM\Entity
 * @UniqueEntity(
 *     fields={"email"},
 *     message="L'émail que vous avez tapé est déjà utilisé!"
 * )
 */
class User implements UserInterface
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
    private $email;

    /**
     * @ORM\Column (type="string", length = 255)
     * @Assert\Length(
     *     min = 8,
     *     minMessage = "Votre mot de passe doit comporter au minimum {{ limit }} caractères")
     */
    private $password;


    /**
     * @ORM\Column(type="json_array")
     */
    private $roles = [];


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
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */


    public function getRoles()
    {
        $roles = $this->roles;

        // garantit que chaque utilisateur possède le rôle ROLE_USER
        // équivalent à array_push() qui ajoute un élément au tabeau
        $roles[] = 'ROLE_USER';

        //array_unique élémine des doublons
        return array_unique($roles);
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setRoles(array $roles)
    {
        $this->roles = $roles;

        return $this;
    }
    }