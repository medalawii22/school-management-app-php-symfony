<?php

namespace App\Entity;

use App\Repository\TypeProfRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeProfRepository::class)
 */
class TypeProf
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeProf;

    /**
     * @ORM\OneToMany(targetEntity=Teacher::class, mappedBy="typeProf")
     */
    private $teachers;

    public function __construct()
    {
        $this->teachers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeProf(): ?string
    {
        return $this->typeProf;
    }

    public function setTypeProf(string $typeProf): self
    {
        $this->typeProf = $typeProf;

        return $this;
    }
    public function __toString()
    {
        return $this->typeProf;
    }

    /**
     * @return Collection|Teacher[]
     */
    public function getTeachers(): Collection
    {
        return $this->teachers;
    }

    public function addTeacher(Teacher $teacher): self
    {
        if (!$this->teachers->contains($teacher)) {
            $this->teachers[] = $teacher;
            $teacher->setTypeProf($this);
        }

        return $this;
    }

    public function removeTeacher(Teacher $teacher): self
    {
        if ($this->teachers->removeElement($teacher)) {
            // set the owning side to null (unless already changed)
            if ($teacher->getTypeProf() === $this) {
                $teacher->setTypeProf(null);
            }
        }

        return $this;
    }
}
