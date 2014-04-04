<?php

namespace Ofi\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Ofi\GestionBundle\Entity\Telefono;
use Ofi\GestionBundle\Entity\Correo;
use Ofi\GestionBundle\Entity\DatosFacturacion;

/**
 * Empresa
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ofi\GestionBundle\Entity\EmpresaRepository")
 */
class Empresa
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
     * @ORM\Column(name="apellido", type="string", length=255)
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="nomsocial", type="string", length=255)
     */
    private $nomsocial;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tipo", type="boolean")
     */
    private $tipo;

	/**
	 * @ORM\OneToMany(targetEntity="Telefono", mappedBy="empresa", cascade={"all"})
	 * 
	 */ 
    private $telefonos;

	/**
	 * @ORM\OneToMany(targetEntity="Correo", mappedBy="empresa", cascade={"all"})
	 * 
	 */ 
    private $correos;

	/**
	 * @ORM\OneToMany(targetEntity="Factura", mappedBy="empresa")
	 * 
	 */ 
	 protected $facturas;
	 





    public function __construct() {
        $this->telefonos 	= new ArrayCollection();
        $this->correos 		= new ArrayCollection();
        $this->facturas 	= new ArrayCollection();
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
     * @return Cliente
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }



    /**
     * Get correos
     *
     * @return integer 
     */
    public function getCorreos()
    {
        return $this->correos;
    }

    /**
     * Set correos
     *
     * @param string $correos
     * @return Cliente
     */
    public function setCorreos($correos)
    {
        $this->correos = $correos;

        return $this;
    }



    /**
     * Get telefonos
     *
     * @return integer 
     */
    public function getTelefonos()
    {
        return $this->telefonos;
    }

    /**
     * Set telefonos
     *
     * @param string $telefonos
     * @return Cliente
     */
    public function setTelefonos($telefonos)
    {
        $this->telefonos = $telefonos;

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
     * Set apellido
     *
     * @param string $apellido
     * @return Cliente
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string 
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set nomsocial
     *
     * @param string $nomsocial
     * @return Cliente
     */
    public function setNomsocial($nomsocial)
    {
        $this->nomsocial = $nomsocial;

        return $this;
    }

    /**
     * Get nomsocial
     *
     * @return string 
     */
    public function getNomsocial()
    {
        return $this->nomsocial;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     * @return Cliente
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }
    
	public function __toString()
	{
		return $this->nomsocial;	
	}  
}
