<?php

namespace App\Controller;

use App\Entity\Materias;
use App\Form\ActualizarMateriaType;
use App\Form\RegistroMateriaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MateriasController extends AbstractController
{
    #[Route('/materias', name: 'materias')]
    public function index(): Response
    {
        $form = $this->createFormBuilder()
                ->add('nombre', TextType::class)->getForm();
        $em = $this->getDoctrine()->getManager();
        $materias = $em->getRepository(Materias::class)->findAll();
        return $this->render('materias/index.html.twig', [
            'controller_name' => 'Estudiante',
            'formulario' => $form->createView(),
            'materias' => $materias, 
        ]);
    }


    #[Route('/materias/registro', name: 'materias_registro')]
    public function registrarMateria(Request $request): Response
    {
        $materia = new Materias();
        $form = $this->createForm(RegistroMateriaType::class, $materia);
        $form-> handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($materia);
            $em->flush();
            $this->addFlash("exito", "Se registró exitosamente");
            return $this->redirectToRoute('materias');
        }
        return $this->render('materias/registroMateria.html.twig', [
            'controller_name' => 'MateriasController',
            'formulario' => $form->createView()
        ]);
    }
    #[Route('/materias/buscarmaterias', name: 'estudiantes_buscar_materias')]
    public function buscarEstudiantes(Request $request): Response
    {
        if($request->isXmlHttpRequest()){
            $nombre = $request->request->get('nombre');
            $em = $this->getDoctrine()->getManager();
            $materias = $em->getRepository(Materias::class)->buscarMateria($nombre);
        }
        return $this->render('materias/buscarMaterias.html.twig', [
            'materias' => $materias,
        ]);
    }

    #[Route('/materias/eliminar', name: 'materias_eliminar')]
    public function eliminarEstudiante(Request $request): Response
    {
        if($request->isXmlHttpRequest()){
            $id = $request->request->get('id');
            $em = $this->getDoctrine()->getManager();
            $materia = $em->getRepository(Materias::class)->find($id);
            $em->remove($materia);
            $em->flush();
        }
        return $this->index();
    }

    #[Route('/materias/actualizar/{id}', name: 'actualizar_materia')]
    public function actualizarMateria($id, Request $request): Response
    {       
        
        $em = $this->getDoctrine()->getManager();

        $materia = new Materias();
        $materia = $em->getRepository(Materias::class)->find($id);

        $form = $this->createForm(ActualizarMateriaType::class, $materia);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em->flush();
            $this->addFlash("exito", "Se actualizó exitosamente");
            return $this->redirectToRoute('materias');
        }

        return $this->render('materias/actualizarMateria.html.twig', [
            'formulario' => $form->createView(),
            'materia' => $materia,
        ]);
    }
}
