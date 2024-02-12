<?php

declare(strict_types=1);

namespace App\Entity\Question;

use App\Entity\Answer\Answer;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
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

    /** @var Collection<array-key, Answer> $answers */
    #[OneToMany(targetEntity: Answer::class, mappedBy: 'question', orphanRemoval: true)]
    private Collection $answers;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
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

    /**
     * @return Collection<array-key, Answer>
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    /**
     * @param Collection<array-key, Answer> $answers
     */
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
}
