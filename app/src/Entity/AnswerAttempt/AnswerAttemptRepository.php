<?php

namespace App\Entity\AnswerAttempt;

interface AnswerAttemptRepository
{
    public function add(AnswerAttempt $answerAttempt): void;

    /**
     * @return AnswerAttempt[]
     */
    public function findAllByTestId(int $testId): array;

    /**
     * @return AnswerAttempt[]
     */
    public function findCorrectAnswerAttemptsByTestId(int $testId): array;

    /**
     * @return AnswerAttempt[]
     */
    public function findWrongAnswerAttemptsByTestId(int $testId): array;
}
