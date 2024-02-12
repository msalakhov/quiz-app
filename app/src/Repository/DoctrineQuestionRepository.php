<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Question\Question;
use App\Entity\Question\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class DoctrineQuestionRepository implements QuestionRepository
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function getAll(): Collection
    {
        /** @var Question[] $questions */
        $questions = $this
            ->entityManager
            ->createQueryBuilder()
            ->select('q')
            ->from(Question::class, 'q')
            ->getQuery()
            ->getResult();

        return new ArrayCollection($questions);
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
}