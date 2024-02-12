<?php

declare(strict_types=1);

namespace App\Entity\AnswerAttempt;

use App\Entity\Answer\Answer;
use App\Entity\Question\Question;
use App\Entity\Test\Test;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\ManyToOne;

#[Entity]
class AnswerAttempt
{
    #[Id]
    #[GeneratedValue]
    #[Column(type: 'integer')]
    private ?int $id;

    #[ManyToOne(targetEntity: Test::class, inversedBy: 'answerAttempts')]
    #[JoinColumn(name: 'test', referencedColumnName: 'id', nullable: false)]
    private Test $test;

    #[ManyToOne(targetEntity: Question::class)]
    private Question $question;

    /** @var Collection<array-key, Answer>  */
    #[ManyToMany(targetEntity: Answer::class)]
    private Collection $answers;

    #[Column(type: 'boolean')]
    private bool $correct;

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

    public function getTest(): Test
    {
        return $this->test;
    }

    public function setTest(Test $test): self
    {
        $this->test = $test;

        return $this;
    }

    public function getQuestion(): Question
    {
        return $this->question;
    }

    public function setQuestion(Question $question): self
    {
        $this->question = $question;

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

    public function removeAnswer(Answer $answer): self
    {
        $this->answers->removeElement($answer);

        return $this;
    }

    public function isCorrect(): bool
    {
        return $this->correct;
    }

    public function setCorrect(bool $correct): self
    {
        $this->correct = $correct;

        return $this;
    }
}
