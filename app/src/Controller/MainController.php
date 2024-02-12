<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\TestFormType;
use App\Service\AnswerAttempt\AnswerAttemptService;
use App\Service\Question\QuestionService;
use App\Service\Test\TestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route(path: '/', name: 'begin_test_page', methods: ['GET', 'POST'])]
    public function beginTest(Request $request, TestService $testService): Response
    {
        if ($request->getMethod() === 'POST') {
            $testId = $testService->createTest();
            return $this->redirectToRoute('test_process_page', ['testId' => $testId]);
        }

        return $this->render(
            'begin-test.html.twig',
            ['title' => 'Begin test']
        );
    }

    #[Route(path: '/test', name: 'test_process_page', methods: ['GET', 'POST'])]
    public function processTest(Request $request, QuestionService $questionService, AnswerAttemptService $answerAttemptService)
    {
        if ($request->getMethod() === 'POST') {
            /** @todo make it async */
            $answerAttemptService->createAnswerAttempt(
                $request->get('testId'),
                $request->get('question'),
                $request->get('answers')
            );
        }

        $question = $questionService->getRandomQuestion();

        return $this->render(
            'test.html.twig',
            [
                'question' => $question,
            ]
        );
    }
}
