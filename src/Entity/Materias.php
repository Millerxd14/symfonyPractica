<?php

namespace App\Entity;

use App\Repository\MateriasRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MateriasRepository::class)
 */
class Materias
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Estudiantemateria", mappedBy="materia")
     */
    private $materiaestudiante;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CalificacionesFinales", mappedBy="materia")
     */
    private $materiacalificacion;




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
}
