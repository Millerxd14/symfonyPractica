<?php

namespace App\Entity;

use App\Repository\CalificacionesFinalesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CalificacionesFinalesRepository::class)
 */
class CalificacionesFinales
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaRegistro;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $nombreEstudiante;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $nombreMateria;

    /**
     * @ORM\Column(type="smallint")
     */
    private $calificacionFinal;




    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Estudiantes", inversedBy="estudiantecalificacion")
     */
    private $estudiante;

    /** 
     * @ORM\ManyToOne(targetEntity="App\Entity\Materias", inversedBy="materiacalificacion")
     */
    private $materia;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaRegistro(): ?\DateTimeInterface
    {
        return $this->fechaRegistro;
    }

    public function setFechaRegistro(\DateTimeInterface $fechaRegistro): self
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    public function getNombreEstudiante(): ?string
    {
        return $this->nombreEstudiante;
    }

    public function setNombreEstudiante(string $nombreEstudiante): self
    {
        $this->nombreEstudiante = $nombreEstudiante;

        return $this;
    }

    public function getNombreMateria(): ?string
    {
        return $this->nombreMateria;
    }

    public function setNombreMateria(string $nombreMateria): self
    {
        $this->nombreMateria = $nombreMateria;

        return $this;
    }

    public function getCalificacionFinal(): ?int
    {
        return $this->calificacionFinal;
    }

    public function setCalificacionFinal(int $calificacionFinal): self
    {
        $this->calificacionFinal = $calificacionFinal;

        return $this;
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
