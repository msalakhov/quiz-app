<?php

namespace App\Service\Question;

use App\Entity\AnswerAttempt\AnswerAttempt;
use App\Entity\AnswerAttempt\AnswerAttemptRepository;
use App\Entity\Question\Question;
use App\Entity\Question\QuestionRepository;

class QuestionService
{
    public function __construct(
        private QuestionRepository $questionRepository,
        private AnswerAttemptRepository $answerAttemptRepository
    )
    {
    }

    public function getRandomQuestionForTest(int $testId): ?Question
    {
        $answerAttempts = $this->answerAttemptRepository->findAllByTestId($testId);

        $answeredQuestionIds = array_map(
            fn (AnswerAttempt $answerAttempt): int => (int) $answerAttempt->getQuestion()->getId(),
            $answerAttempts
        );

        if (count($answeredQuestionIds) > 0) {
            $availableQuestions = $this->questionRepository->findAllExceptIds($answeredQuestionIds);
        } else {
            $availableQuestions = $this->questionRepository->findAll();
        }

        if (count($availableQuestions) === 0) {
            return null;
        }

        $questionIndex = rand(0, count($availableQuestions) - 1);

        return $availableQuestions[$questionIndex];
    }
}