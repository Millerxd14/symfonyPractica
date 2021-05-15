<?php

namespace App\Entity;

use App\Repository\EstudiantemateriaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EstudiantemateriaRepository::class)
 */
class Estudiantemateria
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Estudiantes", inversedBy="estudiantemateria")
     */
    private $estudiante;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Materias", inversedBy="materiaestudiante")
     */
    private $materia;

    
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of estudiante
     */ 
    public function getEstudiante()
    {
        return $this->estudiante;
    }

    /**
     * Set the value of estudiante
     *
     * @return  self
     */ 
    public function setEstudiante($estudiante)
    {
        $this->estudiante = $estudiante;

        return $this;
    }

    /**
     * Get the value of materia
     */ 
    public function getMateria()
    {
        return $this->materia;
    }

    /**
     * Set the value of materia
     *
     * @return  self
     */ 
    public function setMateria($materia)
    {
        $this->materia = $materia;

        return $this;
    }
}
