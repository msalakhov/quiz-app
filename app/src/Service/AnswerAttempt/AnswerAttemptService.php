<?php

namespace App\Service\AnswerAttempt;

use App\Entity\Answer\Answer;
use App\Entity\Answer\AnswerRepository;
use App\Entity\AnswerAttempt\AnswerAttempt;
use App\Entity\AnswerAttempt\AnswerAttemptRepository;
use App\Entity\Question\QuestionRepository;
use App\Entity\Test\TestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AnswerAttemptService
{
    public function __construct(
        private TestRepository $testRepository,
        private QuestionRepository $questionRepository,
        private AnswerRepository $answerRepository,
        private AnswerAttemptRepository $answerAttemptRepository,
        private ValidatorInterface $validator,
        private EntityManagerInterface $entityManager
    )
    {
    }

    /**
     * @param Answer[] $answers
     */
    private function isCorrectAnswer(array $answers): bool
    {
        foreach ($answers as $answer) {
            if ($answer->isCorrect() === false) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param string[] $answerIds
     */
    public function createAnswerAttempt(string $testId, string $questionId, array $answerIds): AnswerAttempt
    {
        $test = $this->testRepository->getById((int) $testId);
        $question = $this->questionRepository->getById((int) $questionId);
        $answers = $this->answerRepository->findByIds($answerIds);
        $answerAttempt = (new AnswerAttempt())
            ->setTest($test)
            ->setQuestion($question)
            ->setAnswers(
                new ArrayCollection($answers)
            )
            ->setCorrect(
                $this->isCorrectAnswer($answers)
            );

        $violations = $this->validator->validate($answerAttempt);
        if ($violations->count() > 0) {
            throw new Exception('validation error');
        }

        $this->answerAttemptRepository->add($answerAttempt);
        $this->entityManager->flush();

        return $answerAttempt;
    }
}