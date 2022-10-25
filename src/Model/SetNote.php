<?php

namespace App\Model;

use App\Repository\SetNoteRepository;
use Doctrine\ORM\Mapping as ORM;


class SetNote
{
 
    private $note;

    

    public function getNote(): ?float
    {
        return $this->note;
    }

    public function setNote(float $note): self
    {
        $this->note = $note;

        return $this;
    }
}
