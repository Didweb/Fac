<?php
namespace Ofi\GestionBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ofi\GestionBundle\Entity\Empresa;
use Ofi\GestionBundle\Entity\Correo;
use Ofi\GestionBundle\Entity\Telefono;

class Clientes implements FixtureInterface 
{
	
	
	
    public function load(ObjectManager $manager)
    {
        for ($i=0; $i<10; $i++) {
            $cliente 	= new Empresa();
            $correo 	= new Correo();
            $telefono 	= new Telefono();

            $cliente->setNombre('Empresa '.$i);
            $cliente->setApellido('Apellido '.$i);
            $cliente->setNomsocial('NomSocial'.$i);
            $cliente->setTipo(rand(0,1));
           
           
            $manager->persist($cliente);
        }

        $manager->flush();
        
        
    }
    
}
