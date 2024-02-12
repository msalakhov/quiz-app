<?php

namespace App\Entity\Test;

use Doctrine\ORM\EntityNotFoundException;

interface TestRepository
{
    public function add(Test $test): void;

    /**
     * @throws EntityNotFoundException
     */
    public function getById(int $testId): Test;
}
