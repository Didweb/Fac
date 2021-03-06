<?php

namespace Ofi\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DatosFacturacion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ofi\GestionBundle\Entity\DatosFacturacionRepository")
 */
class DatosFacturacion
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
     * @ORM\Column(name="razonsocial", type="string", length=255)
     */
    private $razonsocial;

    /**
     * @var string
     *
     * @ORM\Column(name="nif", type="string", length=20)
     */
    private $nif;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="poblacion", type="string", length=255)
     */
    private $poblacion;

    /**
     * @var string
     *
     * @ORM\Column(name="cp", type="string", length=255)
     */
    private $cp;

    /**
     * @ORM\OneToOne(targetEntity="Empresa")
     * @ORM\JoinColumn(name="empresa_id", referencedColumnName="id")
     */
    private $empresa;

    /**
     * @ORM\OneToOne(targetEntity="AdminConfig")
     * @ORM\JoinColumn(name="miempresa_id", referencedColumnName="id")
     */
    private $miempresa;


    /**
     * Set empresa
     *
     * @param integer $empresa
     * @return DatosFacturacion
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
    public function getMiempresa()
    {
        return $this->miempresa;
    }

    /**
     * Set empresa
     *
     * @param integer $empresa
     * @return DatosFacturacion
     */
    public function setMiempresa($miempresa)
    {
        $this->miempresa = $miempresa;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set razonsocial
     *
     * @param string $razonsocial
     * @return DatosFacturacion
     */
    public function setRazonsocial($razonsocial)
    {
        $this->razonsocial = $razonsocial;

        return $this;
    }

    /**
     * Get razonsocial
     *
     * @return string 
     */
    public function getRazonsocial()
    {
        return $this->razonsocial;
    }

    /**
     * Set nif
     *
     * @param string $nif
     * @return DatosFacturacion
     */
    public function setNif($nif)
    {
        $this->nif = $nif;

        return $this;
    }

    /**
     * Get nif
     *
     * @return string 
     */
    public function getNif()
    {
        return $this->nif;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return DatosFacturacion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set poblacion
     *
     * @param string $poblacion
     * @return DatosFacturacion
     */
    public function setPoblacion($poblacion)
    {
        $this->poblacion = $poblacion;

        return $this;
    }

    /**
     * Get poblacion
     *
     * @return string 
     */
    public function getPoblacion()
    {
        return $this->poblacion;
    }

    /**
     * Set cp
     *
     * @param string $cp
     * @return DatosFacturacion
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return string 
     */
    public function getCp()
    {
        return $this->cp;
    }
}
