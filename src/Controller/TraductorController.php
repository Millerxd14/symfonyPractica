<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TraductorController extends AbstractController
{
    #[Route('/traductor', name: 'traductor')]
    public function index(): Response
    {
        return $this->render('traductor/index.html.twig', [
            'controller_name' => 'TraductorController',
        ]);
    }
}
