<?php

namespace App\Service\Question;

use App\Entity\Question\Question;
use App\Entity\Question\QuestionRepository;
use Doctrine\Common\Collections\Collection;

class QuestionService
{
    public function __construct(private QuestionRepository $questionRepository)
    {
    }

    private function getQuestions(): Collection
    {
        return $this->questionRepository->getAll();
    }

    public function getRandomQuestion()
    {
        $questions = $this->getQuestions();
        $questionIndex = rand(0, $questions->count());

        return $questions[$questionIndex];
    }

}