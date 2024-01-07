<?php

namespace App\Entity;

use App\Repository\AulaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AulaRepository::class)
 */
class Aula
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $carrera;

    /**
     * @ORM\Column(type="string", length=300, nullable=true)
     */
    private $equipamiento;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $capacidad;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $caracteristicas;

    /**
     * @ORM\Column(type="string", length=300, nullable=true)
     */
    private $ubicacion;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $imagen;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(?int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getCarrera(): ?string
    {
        return $this->carrera;
    }

    public function setCarrera(?string $carrera): self
    {
        $this->carrera = $carrera;

        return $this;
    }

    public function getEquipamiento(): ?string
    {
        return $this->equipamiento;
    }

    public function setEquipamiento(?string $equipamiento): self
    {
        $this->equipamiento = $equipamiento;

        return $this;
    }

    public function getCapacidad(): ?int
    {
        return $this->capacidad;
    }

    public function setCapacidad(?int $capacidad): self
    {
        $this->capacidad = $capacidad;

        return $this;
    }

    public function getCaracteristicas(): ?string
    {
        return $this->caracteristicas;
    }

    public function setCaracteristicas(?string $caracteristicas): self
    {
        $this->caracteristicas = $caracteristicas;

        return $this;
    }

    public function getUbicacion(): ?string
    {
        return $this->ubicacion;
    }

    public function setUbicacion(?string $ubicacion): self
    {
        $this->ubicacion = $ubicacion;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(?string $imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }
    public function __toString():string
    {
        return $this->getCarrera();
    }
   
    
}
