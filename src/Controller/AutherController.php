<?php

namespace App\Controller;

use App\Entity\Auther;
use App\Form\AutherType;
use App\Repository\AutherRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\LivreRepository;

#[Route('/auther')]
class AutherController extends AbstractController
{
    #[Route('/', name: 'app_auther_index', methods: ['GET'])]
    public function index(AutherRepository $autherRepository): Response
    {
        return $this->render('auther/index.html.twig', [
            'authers' => $autherRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_auther_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AutherRepository $autherRepository): Response
    {
        $auther = new Auther();
        $form = $this->createForm(AutherType::class, $auther);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $autherRepository->save($auther, true);

            return $this->redirectToRoute('app_auther_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('auther/new.html.twig', [
            'auther' => $auther,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_auther_show', methods: ['GET'])]
    public function show(Auther $auther,LivreRepository $livreRepository): Response
    {
        //  get all livre

            $livres =$livreRepository->findAll();


        return $this->render('auther/show.html.twig', [
            'auther' => $auther,
            'livres' => $livres,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_auther_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Auther $auther, AutherRepository $autherRepository): Response
    {
        $form = $this->createForm(AutherType::class, $auther);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $autherRepository->save($auther, true);

            return $this->redirectToRoute('app_auther_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('auther/edit.html.twig', [
            'auther' => $auther,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_auther_delete', methods: ['POST'])]
    public function delete(Request $request, Auther $auther, AutherRepository $autherRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$auther->getId(), $request->request->get('_token'))) {
            $autherRepository->remove($auther, true);
        }

        return $this->redirectToRoute('app_auther_index', [], Response::HTTP_SEE_OTHER);
    }
}
