<?php

namespace Ofi\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Ofi\GestionBundle\Entity\Telefono;
use Ofi\GestionBundle\Entity\Correo;
use Ofi\GestionBundle\Entity\DatosFacturacion;

/**
 * Cliente
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ofi\GestionBundle\Entity\ClienteRepository")
 */
class Cliente
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
     * @ORM\ManyToMany(targetEntity="Telefono", cascade={"all"})
     * @ORM\JoinTable(name="Cliente_telefono",
     *      joinColumns={@ORM\JoinColumn(name="cliente_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="telefono_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $telefonos;

	/**
     * @ORM\ManyToMany(targetEntity="Correo", cascade={"all"})
     * @ORM\JoinTable(name="Cliente_correos",
     *      joinColumns={@ORM\JoinColumn(name="cliente_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="correo_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $correos;


    /**
     * @ORM\OneToOne(targetEntity="DatosFacturacion", cascade={"all"})
     * @ORM\JoinColumn(name="datosfacturacion_id", referencedColumnName="id")
     */
    private $datosfacturacion;


    public function __construct() {
        $this->telefonos 	= new ArrayCollection();
        $this->correos 		= new ArrayCollection();
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
}
