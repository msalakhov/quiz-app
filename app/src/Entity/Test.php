<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;

#[Entity]
class Test
{
    #[Id]
    #[GeneratedValue]
    #[Column(type: 'integer')]
    private ?int $id;

    #[OneToMany(targetEntity: AnswerAttempt::class, mappedBy: 'test')]
    private Collection $answerAttempts;

    public function __construct()
    {
        $this->answerAttempts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getAnswerAttempts(): Collection
    {
        return $this->answerAttempts;
    }

    public function setAnswerAttempts(Collection $answerAttempts): self
    {
        $this->answerAttempts = $answerAttempts;

        return $this;
    }

    public function addAnswerAttempt(AnswerAttempt $answerAttempt): self
    {
        if ($this->answerAttempts->contains($answerAttempt) === false) {
            $this->answerAttempts->add($answerAttempt);
        }

        return $this;
    }
}
