<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\Test\TestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    public function __construct(private TestService $testService)
    {
    }

    #[Route(path: '/', name: 'begin_test_page', methods: ['GET', 'POST'])]
    public function beginTest(Request $request): Response
    {
        if ($request->getMethod() === 'POST') {
            $testId = $this->testService->createTest();
            return $this->redirectToRoute('test_process_page', ['testId' => $testId]);
        }

        return $this->render(
            'begin-test.html.twig',
            ['title' => 'Begin test']
        );
    }

    #[Route(path: '/test/{testId}', name: 'test_process_page', methods: ['GET', 'POST'])]
    public function processTest(int $testId, Request $request): Response
    {
        if ($request->getMethod() === 'POST') {
            /** @todo make it async */
            $this->testService->writeQuestionAnswers(
                $testId,
                (int) $request->get('question'),
                $request->get('answers')
            );
        }

        $question = $this->testService->getNextQuestion($testId);

        if ($question === null) {
            return $this->redirectToRoute('test_result_page', ['testId' => $testId]);
        }

        return $this->render(
            'test.html.twig',
            [
                'question' => $question,
            ]
        );
    }

    #[Route(path: '/test/{testId}/result', name: 'test_result_page')]
    public function testResult(int $testId): Response
    {
        $result = $this->testService->getResult($testId);

        return $this->render(
            'test-result.html.twig',
            [
                'result' => $result,
            ]
        );
    }
}
