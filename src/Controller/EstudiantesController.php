<?php

namespace App\Controller;

use App\Entity\Estudiantes;
use App\Form\EstudianteRegistroType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EstudiantesController extends AbstractController
{
    #[Route('/estudiantes', name: 'estudiantes')]
    public function index(): Response
    {
        $form = $this->createFormBuilder()
                ->add('nombre', TextType::class)->getForm();
        $em = $this->getDoctrine()->getManager();
        $estudiantes = $em->getRepository(Estudiantes::class)->findAll();
        return $this->render('estudiantes/index.html.twig', [
            'controller_name' => 'Estudiante',
            'formulario' => $form->createView(),
            'estudiantes' => $estudiantes, 
        ]);
    }

    #[Route('/estudiantes/registro', name: 'estudiantes_registro')]
    public function registrarEstudiante(Request $request): Response
    {
        $estudiante = new Estudiantes();
        $form = $this->createForm(EstudianteRegistroType::class, $estudiante);
        $form-> handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($estudiante);
            $em->flush();
            $this->addFlash("exito", "Se registró exitosamente");
            return $this->redirectToRoute('estudiantes');
        }
        return $this->render('estudiantes/registroEstudiante.html.twig', [
            'controller_name' => 'Registrar Estudiante',
            'formulario' => $form->createView(),
        ]);
    }

    #[Route('/estudiantes/buscarestudiantes', name: 'estudiantes_buscar_estudiantes')]
    public function buscarEstudiantes(Request $request): Response
    {
        if($request->isXmlHttpRequest()){
            $nombre = $request->request->get('nombre');
            $em = $this->getDoctrine()->getManager();
            $estudiantes = $em->getRepository(Estudiantes::class)->buscarEstudiante($nombre);
        }
        return $this->render('estudiantes/buscarEstudiantes.html.twig', [
            'estudiantes' => $estudiantes,
        ]);
    }

    #[Route('/estudiantes/eliminar', name: 'estudiantes_eliminar')]
    public function eliminarEstudiante(Request $request): Response
    {
        if($request->isXmlHttpRequest()){
            $id = $request->request->get('id');
            $em = $this->getDoctrine()->getManager();
            $estudiante = $em->getRepository(Estudiantes::class)->find($id);
            $em->remove($estudiante);
            $em->flush();
        }
        return $this->index();
    }

    
    #[Route('/estudiantes/actualizar/{id}', name: 'actualizar_estudiante')]
    public function actualizarEstudiante($id, Request $request): Response
    {       
        
        $em = $this->getDoctrine()->getManager();

        $estudiante = new Estudiantes();
        $estudiante = $em->getRepository(Estudiantes::class)->find($id);

        $form = $this->createForm(EstudianteRegistroType::class, $estudiante);        
        $form-> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em->flush();
            $this->addFlash("exito", "Se actualizó exitosamente");
            return $this->redirectToRoute('estudiantes');
        }

        return $this->render('estudiantes/actualizarEstudiante.html.twig', [
            'formulario' => $form->createView(),
            'estudiante' => $estudiante, 
        ]);
    }
}
