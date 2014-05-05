<?php

namespace Ofi\GestionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Irpf
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ofi\GestionBundle\Entity\IrpfRepository")
 */
class Irpf
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
     * @var float
     *
     * @ORM\Column(name="porcentaje", type="float")
     */
    private $porcentaje;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="inicio", type="date")
     */
    private $inicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="final", type="date")
     */
    private $final;


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
     * Set porcentaje
     *
     * @param float $porcentaje
     * @return Irpf
     */
    public function setPorcentaje($porcentaje)
    {
        $this->porcentaje = $porcentaje;

        return $this;
    }

    /**
     * Get porcentaje
     *
     * @return float 
     */
    public function getPorcentaje()
    {
        return $this->porcentaje;
    }

    /**
     * Set inicio
     *
     * @param \DateTime $inicio
     * @return Irpf
     */
    public function setInicio($inicio)
    {
        $this->inicio = $inicio;

        return $this;
    }

    /**
     * Get inicio
     *
     * @return \DateTime 
     */
    public function getInicio()
    {
        return $this->inicio;
    }

    /**
     * Set final
     *
     * @param \DateTime $final
     * @return Irpf
     */
    public function setFinal($final)
    {
        $this->final = $final;

        return $this;
    }

    /**
     * Get final
     *
     * @return \DateTime 
     */
    public function getFinal()
    {
        return $this->final;
    }
}
