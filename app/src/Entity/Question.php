<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;

#[Entity]
class Question
{
    #[Id]
    #[GeneratedValue]
    #[Column(type: 'integer')]
    private ?int $id;

    #[Column(type: 'string', unique: true)]
    private string $content;

    #[OneToMany(targetEntity: Answer::class, mappedBy: 'question', orphanRemoval: true)]
    private Collection $answers;

    #[ManyToOne(targetEntity: AnswerAttempt::class, inversedBy: 'question')]
    private Collection $answerAttempts;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
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

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function setAnswers(Collection $answers): self
    {
        $this->answers = $answers;

        return $this;
    }

    public function addAnswer(Answer $answer): self
    {
        if ($this->answers->contains($answer) === false) {
            $this->answers->add($answer);
        }

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
}
