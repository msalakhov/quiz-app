<?php

namespace App\Repository;

use App\Entity\Answer\Answer;
use App\Entity\Answer\AnswerRepository;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineAnswerRepository implements AnswerRepository
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function findByIds(array $answerIds): array
    {
        $queryBuilder = $this
            ->entityManager
            ->createQueryBuilder();

        /** @var Answer[] $answers */
        $answers = $queryBuilder
            ->select('a')
            ->from(Answer::class, 'a')
            ->where(
                $queryBuilder->expr()->in('a.id', $answerIds)
            )
            ->getQuery()
            ->getResult();

        return $answers;
    }
}
