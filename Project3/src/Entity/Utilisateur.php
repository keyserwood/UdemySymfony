<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 * @UniqueEntity(fields={"username"},message="Username est déjà pris")
 */
class Utilisateur implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5,max=10,minMessage="Il faut plus de 5 caractères",maxMessage="Il faut moins de 10 caractères")
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5,max=10,minMessage="Il faut plus de 5 caractères",maxMessage="Il faut moins de 10 caractères")
     */
    private $password;

    /**
     * @Assert\Length(min=5,max=10,minMessage="Il faut plus de 5 caractères",maxMessage="Il faut moins de 10 caractères")
     * @Assert\EqualTo(propertyPath="password",message="Les deux mdp ne correspondent pas")
     */
    private $verificationPassword;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $roles;

    public function getVerificationPassword(): ?string
    {
        return $this->verificationPassword;
    }

    public function setVerificationPassword(string $verificationPassword): self
    {
        $this->verificationPassword = $verificationPassword;

        return $this;
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }
    public function getRoles()
    {
        return[$this->roles];
    }

    public function setRoles(?string $roles): self
    {
        if($roles === null)
        {
            $this->roles = "ROLE_USER";
        }
        else{
            $this->roles = $roles;
        }
        return $this;
    }
}
