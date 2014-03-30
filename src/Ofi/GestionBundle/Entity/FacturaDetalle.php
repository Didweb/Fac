<?php

namespace Ofi\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FacturaDetalle
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ofi\GestionBundle\Entity\FacturaDetalleRepository")
 */
class FacturaDetalle
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
     * @ORM\Column(name="concepto", type="string", length=255)
     */
    private $concepto;

    /**
     * @var integer
     *
     * @ORM\Column(name="unidades", type="integer", length=255)
     */
    private $unidades;

    /**
     * @var float
     *
     * @ORM\Column(name="precioconcepto", type="float")
     */
    private $precioconcepto;

    /**
     * @var string
     *
     * @ORM\Column(name="tipoconcepto", type="string", length=1)
     */
    private $tipoconcepto;


	/**
	 * @ORM\ManyToOne(targetEntity="Factura", inversedBy="detalles")
	 * @ORM\JoinColumn(name="factura_id", referencedColumnName="id")
	 */ 
	 private $factura;


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
     * @return FacturaDetalle
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
     * Set concepto
     *
     * @param string $concepto
     * @return FacturaDetalle
     */
    public function setConcepto($concepto)
    {
        $this->concepto = $concepto;

        return $this;
    }

    /**
     * Get concepto
     *
     * @return string 
     */
    public function getConcepto()
    {
        return $this->concepto;
    }

    /**
     * Set unidades
     *
     * @param string $unidades
     * @return FacturaDetalle
     */
    public function setUnidades($unidades)
    {
        $this->unidades = $unidades;

        return $this;
    }

    /**
     * Get unidades
     *
     * @return string 
     */
    public function getUnidades()
    {
        return $this->unidades;
    }

    /**
     * Set precioconcepto
     *
     * @param float $precioconcepto
     * @return FacturaDetalle
     */
    public function setPrecioconcepto($precioconcepto)
    {
        $this->precioconcepto = $precioconcepto;

        return $this;
    }

    /**
     * Get precioconcepto
     *
     * @return float 
     */
    public function getPrecioconcepto()
    {
        return $this->precioconcepto;
    }

    /**
     * Set tipoconcepto
     *
     * @param string $tipoconcepto
     * @return FacturaDetalle
     */
    public function setTipoconcepto($tipoconcepto)
    {
        $this->tipoconcepto = $tipoconcepto;

        return $this;
    }

    /**
     * Get tipoconcepto
     *
     * @return string 
     */
    public function getTipoconcepto()
    {
        return $this->tipoconcepto;
    }
}
