<?php

namespace App\Entity\Question;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityNotFoundException;

interface QuestionRepository
{
    /**
     * @return Question[]
     */
    public function getAll(): Collection;

    /**
     * @throws EntityNotFoundException
     */
    public function getById(int $questionId): Question;
}