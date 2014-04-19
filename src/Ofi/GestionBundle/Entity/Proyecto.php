<?php

namespace Ofi\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Ofi\GestionBundle\Entity\Presupuesto;

/**
 * Proyecto
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ofi\GestionBundle\Entity\ProyectoRepository")
 */
class Proyecto
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
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechainicio", type="date")
     */
    private $fechainicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechafinal", type="date")
     */
    private $fechafinal;


	/**
	 * @ORM\ManyToOne(targetEntity="Empresa", inversedBy="proyectos")
	 * @ORM\JoinColumn(name="empresa_id", referencedColumnName="id")
	 */ 
	private $empresa;


	/**
	 * @ORM\OneToMany(targetEntity="Factura", mappedBy="proyecto")
	 * 
	 */ 
	 protected $facturas;



	/**
	 * @ORM\OneToMany(targetEntity="Presupuesto", mappedBy="proyecto", cascade={"all"})
	 * 
	 */ 
    private $presupuestos;


    public function __construct() {
        $this->presupuestos 	= new ArrayCollection();
        $this->facturas 		= new ArrayCollection();

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
     * Set factura
     *
     * @param integer $factura
     * @return integer
     */
    public function setFactura($factura)
    {
        $this->factura = $factura;

        return $this;
    }

    /**
     * Get factura
     *
     * @return integer 
     */
    public function getFactura()
    {
        return $this->factura;
    }

    /**
     * Set empresa
     *
     * @param integer $empresa
     * @return empresa
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa
     *
     * @return integer 
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }


    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Proyecto
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Proyecto
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set fechainicio
     *
     * @param \DateTime $fechainicio
     * @return Proyecto
     */
    public function setFechainicio($fechainicio)
    {
        $this->fechainicio = $fechainicio;

        return $this;
    }

    /**
     * Get fechainicio
     *
     * @return \DateTime 
     */
    public function getFechainicio()
    {
        return $this->fechainicio;
    }

    /**
     * Set fechafinal
     *
     * @param \DateTime $fechafinal
     * @return Proyecto
     */
    public function setFechafinal($fechafinal)
    {
        $this->fechafinal = $fechafinal;

        return $this;
    }

    /**
     * Get fechafinal
     *
     * @return \DateTime 
     */
    public function getFechafinal()
    {
        return $this->fechafinal;
    }
}
