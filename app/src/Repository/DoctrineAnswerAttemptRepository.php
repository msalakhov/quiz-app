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


    public function findAllByTestId(int $testId): array
    {
        return $this
            ->entityManager
            ->getRepository(AnswerAttempt::class)
            ->findBy(['test' => $testId]);
    }

    public function findCorrectAnswerAttemptsByTestId(int $testId): array
    {
        return $this
            ->entityManager
            ->createQueryBuilder()
            ->select('a')
            ->from(AnswerAttempt::class, 'a')
            ->where('a.test = :testId')
            ->andWhere('a.correct = true')
            ->orderBy('a.question', 'ASC')
            ->setParameter('testId', $testId)
            ->getQuery()
            ->getResult();
    }

    public function findWrongAnswerAttemptsByTestId(int $testId): array
    {
        return $this
            ->entityManager
            ->createQueryBuilder()
            ->select('a')
            ->from(AnswerAttempt::class, 'a')
            ->where('a.test = :testId')
            ->andWhere('a.correct = false')
            ->orderBy('a.question', 'ASC')
            ->setParameter('testId', $testId)
            ->getQuery()
            ->getResult();
    }
}