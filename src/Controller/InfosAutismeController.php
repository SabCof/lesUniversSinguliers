<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InfosAutismeController extends AbstractController
{
    #[Route('/infos/autisme', name: 'app_infos_autisme')]
    public function index(): Response
    {
        return $this->render('infos_autisme/index.html.twig', [
            'controller_name' => 'InfosAutismeController',
        ]);
    }
}
