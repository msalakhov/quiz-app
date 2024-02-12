<?php

namespace App\Repository;

use App\Entity\Test\Test;
use App\Entity\Test\TestRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;

class DoctrineTestRepository implements TestRepository
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function add(Test $test): void
    {
        $this->entityManager->persist($test);
    }

    public function getById(int $testId): Test
    {
        $test = $this
            ->entityManager
            ->getRepository(Test::class)
            ->findOneBy(['id' => $testId]);

        if ($test === null) {
            throw new EntityNotFoundException(sprintf('Test entity with id %d not found', $testId));
        }

        return $test;
    }
}
