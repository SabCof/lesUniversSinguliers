<?php

namespace App\Controller;

use App\Entity\Mook;
use App\Form\MookType;
use App\Repository\MookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/mook')]
class MookController extends AbstractController
{
    #[Route('/', name: 'app_mook_index', methods: ['GET'])]
    public function index(MookRepository $mookRepository): Response
    {
        return $this->render('mook/index.html.twig', [
            'mooks' => $mookRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_mook_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MookRepository $mookRepository): Response
    {
        $mook = new Mook();
        $form = $this->createForm(MookType::class, $mook);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mookRepository->save($mook, true);

            return $this->redirectToRoute('app_mook_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mook/new.html.twig', [
            'mook' => $mook,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mook_show', methods: ['GET'])]
    public function show(Mook $mook): Response
    {
        return $this->render('mook/show.html.twig', [
            'mook' => $mook,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_mook_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Mook $mook, MookRepository $mookRepository): Response
    {
        $form = $this->createForm(MookType::class, $mook);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mookRepository->save($mook, true);

            return $this->redirectToRoute('app_mook_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mook/edit.html.twig', [
            'mook' => $mook,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_mook_delete', methods: ['POST'])]
    public function delete(Request $request, Mook $mook, MookRepository $mookRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mook->getId(), $request->request->get('_token'))) {
            $mookRepository->remove($mook, true);
        }

        return $this->redirectToRoute('app_mook_index', [], Response::HTTP_SEE_OTHER);
    }
}
