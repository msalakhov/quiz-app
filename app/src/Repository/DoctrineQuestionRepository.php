<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Question\Question;
use App\Entity\Question\QuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class DoctrineQuestionRepository implements QuestionRepository
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function getById(int $questionId): Question
    {
        $question = $this
            ->entityManager
            ->getRepository(Question::class)
            ->findOneBy(['id' => $questionId]);

        if ($question === null) {
            throw new Exception(sprintf('Question with id %d not found', $questionId));
        }

        return $question;
    }

    public function findAllExceptIds(array $questionIds): array
    {
        $queryBuilder = $this
            ->entityManager
            ->createQueryBuilder();

        return $queryBuilder
            ->select('q')
            ->from(Question::class, 'q')
            ->where('q.id NOT IN (:ids)')
            ->setParameter('ids', $questionIds)
            ->getQuery()
            ->getResult();
    }

    public function findAll(): array
    {
        return $this
            ->entityManager
            ->getRepository(Question::class)
            ->findAll();
    }
}
