<?php

namespace Ofi\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Ofi\GestionBundle\Entity\Detalle;

/**
 * Presupuesto
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ofi\GestionBundle\Entity\PresupuestoRepository")
 */
class Presupuesto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

	/**
	 * @ORM\ManyToOne(targetEntity="Proyecto", inversedBy="presupuestos")
	 * @ORM\JoinColumn(name="proyecto_id", referencedColumnName="id")
	 */ 
	private $proyecto;


	/**
	 * @ORM\ManyToOne(targetEntity="Factura", inversedBy="presupuestos")
	 * @ORM\JoinColumn(name="factura_id", referencedColumnName="id")
	 */ 
	private $factura;

	/**
	 * @ORM\OneToMany(targetEntity="Detalle", mappedBy="presupuesto", cascade={"all"})
	 * 
	 */ 
    private $detalles;

    public function __construct() {
        $this->detalles 	= new ArrayCollection();

    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Presupuesto
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Presupuesto
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }
}
