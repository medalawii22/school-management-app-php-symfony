<?php

namespace App\Model;

use App\Repository\ChangepassRepository;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=ChangepassRepository::class)
 */
class Changepass
{

    private $id;
    /**
     * @SecurityAssert\UserPassword(
     *     message = "Wrong value for your current password"
     * )
     */
    private $oldPassword;

    /**
     * @Assert\Length(min=8,minMessage="le code doit etre au moins 8 caracteres")
     */

    private $newPassword;

    /**
     * @Assert\EqualTo(propertyPath="newPassword",message="ce champ doit etre identiaue avec nouveau mdp")
     */
  
    private $repeatNewPassword;

    public function getId():?Integer
    {
        return $this->id;
    }

    public function getOldPassword(): ?string
    {
        return $this->oldPassword;
    }

    public function setOldPassword(string $oldPassword): self
    {
        $this->oldPassword = $oldPassword;

        return $this;
    }

    public function getNewPassword(): ?string
    {
        return $this->newPassword;
    }

    public function setNewPassword(string $newPassword): self
    {
        $this->newPassword = $newPassword;

        return $this;
    }

    public function getRepeatNewPassword(): ?string
    {
        return $this->repeatNewPassword;
    }

    public function setRepeatNewPassword(string $repeatNewPassword): self
    {
        $this->repeatNewPassword = $repeatNewPassword;

        return $this;
    }
}
