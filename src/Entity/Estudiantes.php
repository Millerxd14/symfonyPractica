<?php

namespace App\Entity;

use App\Repository\EstudiantesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EstudiantesRepository::class)
 */
class Estudiantes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $nombre;

    /**
     * @ORM\Column(type="smallint")
     */
    private $edad;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $grado;


    //foraneas


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Estudiantemateria", mappedBy="estudiante")
     */
    private $estudiantemateria;



    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CalificacionesFinales", mappedBy="estudiante")
     */
    private $estudiantecalificacion;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getEdad(): ?int
    {
        return $this->edad;
    }

    public function setEdad(int $edad): self
    {
        $this->edad = $edad;

        return $this;
    }

    public function getGrado(): ?string
    {
        return $this->grado;
    }

    public function setGrado(string $grado): self
    {
        $this->grado = $grado;

        return $this;
    }

    /**
     * Get the value of estudiantecalificacion
     */ 
    public function getEstudiantecalificacion()
    {
        return $this->estudiantecalificacion;
    }

    /**
     * Set the value of estudiantecalificacion
     *
     * @return  self
     */ 
    public function setEstudiantecalificacion($estudiantecalificacion)
    {
        $this->estudiantecalificacion = $estudiantecalificacion;

        return $this;
    }

    /**
     * Get the value of estudiantemateria
     */ 
    public function getEstudiantemateria()
    {
        return $this->estudiantemateria;
    }

    /**
     * Set the value of estudiantemateria
     *
     * @return  self
     */ 
    public function setEstudiantemateria($estudiantemateria)
    {
        $this->estudiantemateria = $estudiantemateria;

        return $this;
    }
}
