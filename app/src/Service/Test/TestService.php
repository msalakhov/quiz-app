<?php

namespace App\Service\Test;

use App\Entity\AnswerAttempt\AnswerAttempt;
use App\Entity\Question\Question;
use App\Entity\Test\Test;
use App\Entity\Test\TestRepository;
use App\Service\AnswerAttempt\AnswerAttemptService;
use App\Service\Question\QuestionService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TestService
{
    public function __construct(
        private ValidatorInterface $validator,
        private TestRepository $testRepository,
        private EntityManagerInterface $entityManager,
        private QuestionService $questionService,
        private AnswerAttemptService $answerAttemptService
    )
    {
    }

    public function createTest(): int
    {
        $test = new Test();

        $violations = $this->validator->validate($test);
        if ($violations->count() > 0) {
            throw new Exception('validation error');
        }

        $this->testRepository->add($test);
        $this->entityManager->flush();

        return (int) $test->getId();
    }

    public function getNextQuestion(int $testId): ?Question
    {
        return $this->questionService->getRandomQuestionForTest($testId);
    }

    /**
     * @param string[] $answerIds
     */
    public function writeQuestionAnswers(int $testId, int $questionId, array $answerIds): void
    {
        $this->answerAttemptService->createAnswerAttempt($testId, $questionId, $answerIds);
    }

    /**
     * @return mixed[]
     */
    public function getResult(int $testId): array
    {
        return [
            'correct' => $this->answerAttemptService->findCorrectAnsweredQuestions($testId),
            'wrong' => $this->answerAttemptService->findWrongAnsweredQuestions($testId),
        ];
    }
}