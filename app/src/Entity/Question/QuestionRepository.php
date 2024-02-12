<?php

namespace App\Entity\Question;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityNotFoundException;

interface QuestionRepository
{
    /**
     * @param int[] $questionIds
     * @return Question[]
     */
    public function findAllExceptIds(array $questionIds): array;

    /**
     * @throws EntityNotFoundException
     */
    public function getById(int $questionId): Question;

    /**
     * @return Question[]
     */
    public function findAll(): array;
}