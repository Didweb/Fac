<?php

namespace Ofi\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AdminConfig
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ofi\GestionBundle\Entity\AdminConfigRepository")
 */
class AdminConfig
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
     * @var integer
     *
     * @ORM\Column(name="numerofactura", type="integer")
     */
    private $numerofactura;

    /**
     * @var string
     *
     * @ORM\Column(name="nomcomercial", type="string", length=255)
     */
    private $nomcomercial;


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
     * Set numerofactura
     *
     * @param integer $numerofactura
     * @return AdminConfig
     */
    public function setNumerofactura($numerofactura)
    {
        $this->numerofactura = $numerofactura;

        return $this;
    }

    /**
     * Get numerofactura
     *
     * @return integer 
     */
    public function getNumerofactura()
    {
        return $this->numerofactura;
    }

    /**
     * Set nomcomercial
     *
     * @param string $nomcomercial
     * @return AdminConfig
     */
    public function setNomcomercial($nomcomercial)
    {
        $this->nomcomercial = $nomcomercial;

        return $this;
    }

    /**
     * Get nomcomercial
     *
     * @return string 
     */
    public function getNomcomercial()
    {
        return $this->nomcomercial;
    }
}
