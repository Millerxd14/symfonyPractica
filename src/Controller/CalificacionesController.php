<?php

namespace App\Controller;

use App\Entity\CalificacionesFinales;
use App\Entity\Estudiantes;
use App\Entity\Materias;
use App\Form\CalificacionesRegistroType;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalificacionesController extends AbstractController
{
    #[Route('/calificaciones', name: 'calificaciones')]
    public function index(): Response
    {
        $form = $this->createFormBuilder()
                ->add('nombre', TextType::class)->getForm();
        $em = $this->getDoctrine()->getManager();
        $calificaciones = $em->getRepository(CalificacionesFinales::class)->findAll();
        return $this->render('calificaciones/index.html.twig', [
            'controller_name' => 'CalificacionesController',
            'formulario' => $form->createView(),
            'calificaciones' => $calificaciones
        ]);
    }
    #[Route('/calificaciones/registro', name: 'calificaciones_registro')]
    public function registrarCalificacion(Request $request): Response
    {

        $em = $this->getDoctrine()->getManager();
        $calificaciones = new CalificacionesFinales();

        $hoy= new DateTime();
        $hoy->getTimestamp();
        $hoy->format("Y-m_d");

        $calificaciones->setFechaRegistro($hoy);


        $form = $this->createForm(CalificacionesRegistroType::class, $calificaciones);
        $form-> handleRequest($request);
        
        $estudiantes = $em->getRepository(Estudiantes::class)->findAll();
        $materias = $em->getRepository(Materias::class)->findAll();
        if($form->isSubmitted() && $form->isValid()){
            
            
            $idEstudiante = $calificaciones->getEstudiante();
            $estudianteACalificar = $em->getRepository(Estudiantes::class)->find($idEstudiante);

            $idMateria = $calificaciones->getMateria();
            $materiaACalificar = $em->getRepository(Materias::class)->find($idMateria);


            $calificaciones->setEstudiante($estudianteACalificar);
            $calificaciones->setMateria($materiaACalificar);

            $em = $this->getDoctrine()->getManager();
            $em->persist($calificaciones);
            $em->flush();
            $this->addFlash("exito", "Se registró exitosamente");
            return $this->redirectToRoute('calificaciones');
        }


        return $this->render('calificaciones/calificacionesRegistro.html.twig', [
            'controller_name' => 'CalificacionesController',
            'formulario' => $form->createView(),
            'calificaciones' => $calificaciones,
            'estudiantes' => $estudiantes,
            'materias' => $materias,

        ]);
    }


    #[Route('/calificaciones/buscarcalificaciones', name: 'calificaciones_buscar_calificaciones')]
    public function buscarCalificaciones(Request $request): Response
    {
        if($request->isXmlHttpRequest()){
            $nombre = $request->request->get('nombre');
            $em = $this->getDoctrine()->getManager();
            $calificaciones = $em->getRepository(CalificacionesFinales::class)->buscarCalificacion($nombre);
        }
        return $this->render('calificaciones/buscarCalificaciones.html.twig', [
            'calificaciones' => $calificaciones,
        ]);
    }




    #[Route('/calificaciones/eliminar', name: 'calificaciones_eliminar')]
    public function eliminarEstudiante(Request $request): Response
    {
        if($request->isXmlHttpRequest()){
            $id = $request->request->get('id');
            $em = $this->getDoctrine()->getManager();
            $califiacion = $em->getRepository(CalificacionesFinales::class)->find($id);
            $em->remove($califiacion);
            $em->flush();
        }
        return $this->index();
    }



    #[Route('/calificaciones/actualizar/{id}', name: 'actualizar_calificacion')]
    public function actualizarEstudiante($id, Request $request): Response
    {       
        
        $em = $this->getDoctrine()->getManager();

        $calificacion = new CalificacionesFinales();
        $calificacion = $em->getRepository(CalificacionesFinales::class)->find($id);


        $form = $this->createForm(CalificacionesRegistroType::class);

        $estudiantes = $em->getRepository(Estudiantes::class)->findAll();
        $materias = $em->getRepository(Materias::class)->findAll();
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
 
        /*
                    $idEstudianteACalificar = $request->get('estudiante');
                    $idMateriaACalificar = $request->get('materia');

                    $estudianteACalificar = $em->getRepository(Estudiantes::class)->find($idEstudianteACalificar);
                    $materiaACalificar = $em->getRepository(Estudiantes::class)->find($idMateriaACalificar);

                    $calificacion->setNombreEstudiante($request->get('nombreEstudiante'));
                    $calificacion->setnombreMateria($request->get('nombreMateria'));
                    $calificacion->setcalificacionFinal($request->get('calificacionFinal'));
                    $calificacion->setEstudiante($estudianteACalificar);
                    $calificacion->setMateria($materiaACalificar);
        */
            $em->flush();
            $this->addFlash("exito", "Se actualizó exitosamente");
            return $this->redirectToRoute('estudiantes');
        }

        return $this->render('calificaciones/actualizarCalificacion.html.twig', [
            'formulario' => $form->createView(),
            'calificacion' => $calificacion,
            'estudiantes' => $estudiantes,
            'materias' => $materias,
        ]);
    }
}
