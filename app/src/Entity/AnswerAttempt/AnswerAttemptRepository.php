<?php

namespace App\Entity\AnswerAttempt;

interface AnswerAttemptRepository
{
    public function add(AnswerAttempt $answerAttempt): void;
}