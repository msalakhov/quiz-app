<?php

namespace App\Entity\Answer;

use Doctrine\Common\Collections\Collection;

interface AnswerRepository
{
    /**
     * @param string[] $answerIds
     * @return Answer[]
     */
    public function findByIds(array $answerIds): array;
}
