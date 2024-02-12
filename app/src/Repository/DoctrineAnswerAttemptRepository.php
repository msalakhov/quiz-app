<?php

namespace App\Repository;

use App\Entity\AnswerAttempt\AnswerAttempt;
use App\Entity\AnswerAttempt\AnswerAttemptRepository;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineAnswerAttemptRepository implements AnswerAttemptRepository
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function add(AnswerAttempt $answerAttempt): void
    {
        $this->entityManager->persist($answerAttempt);
    }
}