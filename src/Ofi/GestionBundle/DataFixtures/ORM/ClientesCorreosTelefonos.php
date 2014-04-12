<?php
namespace Ofi\GestionBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ofi\GestionBundle\Entity\Cliente;
use Ofi\GestionBundle\Entity\Correo;
use Ofi\GestionBundle\Entity\Telefono;

class Clientes implements FixtureInterface 
{
	
	
	
    public function load(ObjectManager $manager)
    {
        for ($i=0; $i<10; $i++) {
            $cliente 	= new Cliente();
            $correo 	= new Correo();
            $telefono 	= new Telefono();

            $cliente->setNombre('Cliente '.$i);
            $cliente->setApellido('Apellido '.$i);
            $cliente->setNomsocial('NomSocial'.$i);
           
           
            $manager->persist($cliente);
        }

        $manager->flush();
        
        
    }
    
}
