<?php

namespace App\Controller;

use App\Entity\CalificacionesFinales;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GraficasController extends AbstractController
{
    #[Route('/graficas', name: 'graficas')]
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $promedios = $em->getRepository(CalificacionesFinales::class)->promediosPorMateria();
        return $this->render('graficas/index.html.twig', [
            'controller_name' => 'GraficasController',
            'promedios'=> json_encode($promedios)
        ]);
    }
}
