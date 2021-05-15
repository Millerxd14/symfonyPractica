<?php

namespace App\Controller;

use App\Entity\Estudiantemateria;
use App\Entity\Estudiantes;
use App\Entity\Materias;
use App\Form\EstudianteMateriaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EstudianteMateriaController extends AbstractController
{
    #[Route('/estudiante/materia', name: 'estudiante_materia')]
    public function index(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager(); 
        $formEstudiante = $this->createFormBuilder()
                ->add('nombreEstudiante', TextType::class)->getForm();
        $estudiantes = $em->getRepository(Estudiantes::class)->findAll();

        
        $formMateria = $this->createFormBuilder()
                ->add('nombreMateria', TextType::class)->getForm();
        $materias = $em->getRepository(Materias::class)->findAll();


        $asociacion = new Estudiantemateria();
        $formRegistro = $this->createForm(EstudianteMateriaType::class, $asociacion);
        $formRegistro-> handleRequest($request);


        if($formRegistro->isSubmitted() && $formRegistro->isValid()){
            $idEstudiante = $asociacion->getEstudiante();
            $estudianteAsociar = $em->getRepository(Estudiantes::class)->find($idEstudiante);
            $asociacion->setEstudiante($estudianteAsociar);

            $idMateria = $asociacion->getMateria();
            $materiaAsociar = $em->getRepository(Materias::class)->find($idMateria);
            $asociacion->setMateria($materiaAsociar);

            $em->persist($asociacion);
            $em->flush();
            $this->addFlash("exito", "Se registró exitosamente");
            return $this->redirectToRoute('estudiante_materia'); 
        }
        return $this->render('estudiante_materia/index.html.twig', [
            'formularioGeneral' => $formRegistro->createView(),
            'formularioEstudiante' =>$formEstudiante->createView(),
            'formularioMateria' =>$formMateria->createView(),
            'estudiantes' =>$estudiantes,
            'materias' => $materias
        ]);
    }
}
