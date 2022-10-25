<?php

namespace App\Entity;

use App\Repository\ElementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ElementRepository::class)
 */

class Element
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
    private $nomElement;

    /**
     * @ORM\Column(type="float")
     */
    private $coefficient;

    /**
     * @ORM\ManyToOne(targetEntity=Module::class, inversedBy="elements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $module;

    /**
     * @ORM\OneToMany(targetEntity=Notes::class, mappedBy="element")
     */
    private $notes;

    /**
     * @ORM\ManyToOne(targetEntity=Teacher::class, inversedBy="elements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $teacher;

    public function __toString()
    {
        return $this->nomElement;
    }
    
     public function __construct()
    {
        $this->notes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomElement(): ?string
    {
        return $this->nomElement;
    }

    public function setNomElement(string $nomElement): self
    {
        $this->nomElement = $nomElement;

        return $this;
    }

    public function getCoefficient(): ?int
    {
        return $this->coefficient;
    }

    public function setCoefficient(int $coefficient): self
    {
        $this->coefficient = $coefficient;

        return $this;
    }

    public function getModule(): ?module
    {
        return $this->module;
    }

    public function setModule(?module $module): self
    {
        $this->module = $module;

        return $this;
    }

    /**
     * @return Collection|Notes[]
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Notes $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes[] = $note;
            $note->setElement($this);
        }

        return $this;
    }

    public function removeNote(Notes $note): self
    {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getElement() === $this) {
                $note->setElement(null);
            }
        }

        return $this;
    }

    public function getClass(): ?classe
    {
        return $this->class;
    }

    public function setClass(?classe $class): self
    {
        $this->class = $class;

        return $this;
    }

    public function getTeacher(): ?Teacher
    {
        return $this->teacher;
    }

    public function setTeacher(?Teacher $teacher): self
    {
        $this->teacher = $teacher;

        return $this;
    }
}
