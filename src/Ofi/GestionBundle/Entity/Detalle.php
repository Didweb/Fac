<?php

namespace Ofi\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Ofi\GestionBundle\Entity\Presupuesto;

/**
 * Detalle
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ofi\GestionBundle\Entity\DetallesRepository")
 */
class Detalle
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
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     * @var float
     *
     * @ORM\Column(name="precio", type="float")
     */
    private $precio;

	/**
	 * @ORM\ManyToOne(targetEntity="Presupuesto", inversedBy="detalles")
	 * @ORM\JoinColumn(name="presupuesto_id", referencedColumnName="id")
	 */ 
	private $presupuesto;

	/**
	 * @ORM\ManyToOne(targetEntity="Factura", inversedBy="detalles")
	 * @ORM\JoinColumn(name="factura_id", referencedColumnName="id")
	 */ 
	private $factura;
	
	/**
	 * @ORM\ManyToOne(targetEntity="Servicio", inversedBy="detalles")
	 * @ORM\JoinColumn(name="servicio_id", referencedColumnName="id")
	 */ 
	private $servicio;	
	

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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Detalles
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
     * Set precio
     *
     * @param float $precio
     * @return Detalles
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return float 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set presupuesto
     *
     * @param float $presupuesto
     * @return Detalles
     */
    public function setPresupuesto($presupuesto)
    {
        $this->presupuesto = $presupuesto;

        return $this;
    }

    /**
     * Get presupuesto
     *
     * @return float 
     */
    public function getPresupuesto()
    {
        return $this->presupuesto;
    }
    
    /**
     * Set servicio
     *
     * @param float $servicio
     * @return Detalles
     */
    public function setServicio($servicio)
    {
        $this->servicio = $servicio;

        return $this;
    }

    /**
     * Get servicio
     *
     * @return float 
     */
    public function getServicio()
    {
        return $this->servicio;
    }
    
    
}
