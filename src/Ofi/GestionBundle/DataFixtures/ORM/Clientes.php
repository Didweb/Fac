<?php
namespace Ofi\GestionBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ofi\GestionBundle\Entity\Cliente;

class Clientes implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i=0; $i<15; $i++) {
            $cliente = new Cliente();

            $cliente->setNombre('Cliente '.$i);
            $cliente->setApellido('Apellido '.$i);
            $cliente->setNomsocial('NomSocial'.$i);
           
            $manager->persist($cliente);
        }

        $manager->flush();
        
        
    }
    
    
}
