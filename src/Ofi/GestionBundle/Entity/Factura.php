<?php

namespace Ofi\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Ofi\GestionBundle\Entity\Detalle;
use Ofi\GestionBundle\Entity\Presupuesto;

/**
 * Factura
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ofi\GestionBundle\Entity\FacturaRepository")
 */
class Factura
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="nfactura", type="string", length=20)
     */
    private $nfactura;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipofactura", type="integer", length=2)
     */
    private $tipofactura;

	/**
	 * @ORM\ManyToOne(targetEntity="Empresa", inversedBy="facturas")
	 * @ORM\JoinColumn(name="empresa_id", referencedColumnName="id")
	 */ 
	 private $empresa;

	/**
	 * @ORM\OneToMany(targetEntity="Detalle", mappedBy="factura")
	 * 
	 */ 
    private $detalles;


	/**
	 * @ORM\ManyToOne(targetEntity="Proyecto", inversedBy="facturas")
	 * @ORM\JoinColumn(name="proyecto_id", referencedColumnName="id")
	 */ 
	 private $proyecto;

	/**
	 * @ORM\OneToMany(targetEntity="Presupuesto", mappedBy="factura")
	 * 
	 */ 
    private $presupuestos;
    
	 
	public function __construct()
	{
		$this->detalles 	= new ArrayCollection();
		$this->presupuestos = new ArrayCollection();
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Factura
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


    /**
     * Set proyecto
     *
     * @param string $proyecto
     * @return Factura
     */
    public function setProyecto($proyecto)
    {
        $this->proyecto = $proyecto;

        return $this;
    }

    /**
     * Get proyecto
     *
     * @return string 
     */
    public function getProyecto()
    {
        return $this->proyecto;
    }


    /**
     * Set empresa
     *
     * @param string $nfactura
     * @return Factura
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa
     *
     * @return string 
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }


    /**
     * Set nfactura
     *
     * @param string $nfactura
     * @return Factura
     */
    public function setNfactura($nfactura)
    {
        $this->nfactura = $nfactura;

        return $this;
    }

    /**
     * Get nfactura
     *
     * @return string 
     */
    public function getNfactura()
    {
        return $this->nfactura;
    }


    /**
     * Set tipofactura
     *
     * @param integer $tipofactura
     * @return Factura
     */
    public function setTipofactura($tipofactura)
    {
        $this->tipofactura = $tipofactura;

        return $this;
    }

    /**
     * Get tipofactura
     *
     * @return integer 
     */
    public function getTipofactura()
    {
        return $this->tipofactura;
    }


      /**
     * Set detalles
     *
     * 
     * @return Detalles
     */
    public function setDetalles($detalles)
    {
        $this->detalles = $detalles;

        return $this;
    }

    /**
     * Get detalles
     *
     * 
     */
    public function getDetalles()
    {
        return $this->detalles;
    }

}
