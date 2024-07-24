<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Form\AnswerType;
use App\Repository\AnswerRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(AnswerRepository $answerRepository, Request $request): Response
    {
        $correctAnswer = $answerRepository->findOneBy(['answer' => 'Oedipus']);
        $answer = new Answer();

        $form = $this->createForm(AnswerType::class, $answer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $submittedAnswer = $form->get('answer')->getData();

            if ($submittedAnswer === $correctAnswer->getAnswer()) {
                $this->addFlash(
                    "success",
                    "That's correct! Well done!"
                );
            } else {
                $this->addFlash(
                    "error",
                    "That's incorrect! Try again."
                );
            }
        }

        return $this->render('home/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
