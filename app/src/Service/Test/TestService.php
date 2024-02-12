<?php

namespace App\Service\Test;

use App\Entity\Test\Test;
use App\Entity\Test\TestRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TestService
{
    public function __construct(
        private ValidatorInterface $validator,
        private TestRepository $testRepository,
        private EntityManagerInterface $entityManager
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
}