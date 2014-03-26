<?php
namespace Ofi\GestionBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ofi\GestionBundle\Entity\Correo;

class Correos implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i=0; $i<10; $i++) {
            $correo = new Correo();

            $correo->setMail('correo'.$i.'@dominio'.$i.'.com');
            $correo->setNombre('NombreCorreo '.$i);
            $correo->setCargo('Cargo '.$i);
            $correo->setBoletin(rand(0,1));
           
            $manager->persist($correo);
        }

        $manager->flush();
    }
    
    
    
}
