<?php

namespace Ofi\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Ofi\GestionBundle\Entity\Cliente;

/**
 * Correo
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ofi\GestionBundle\Entity\CorreoRepository")
 */
class Correo
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
     * @ORM\Column(name="mail", type="string", length=255)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="cargo", type="string", length=255, nullable=true)
     * @Assert\Null
     */
    private $cargo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="boletin", type="boolean", nullable=true)
     * @Assert\Null
     */
    private $boletin;


	/**
	 * @ORM\ManyToOne(targetEntity="Cliente", inversedBy="correos")
	 * @ORM\JoinColumn(name="cliente_id", referencedColumnName="id")
	 */ 
	private $cliente;

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
     * Set cliente
     *
     * @param integer $cliente
     * @return cliente
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get cliente
     *
     * @return integer 
     */
    public function getCliente()
    {
        return $this->cliente;
    }



    /**
     * Set mail
     *
     * @param string $mail
     * @return Correo
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Correo
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
     * Set cargo
     *
     * @param string $cargo
     * @return Correo
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;

        return $this;
    }

    /**
     * Get cargo
     *
     * @return string 
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * Set boletin
     *
     * @param boolean $boletin
     * @return Correo
     */
    public function setBoletin($boletin)
    {
        $this->boletin = $boletin;

        return $this;
    }

    /**
     * Get boletin
     *
     * @return boolean 
     */
    public function getBoletin()
    {
        return $this->boletin;
    }
}
