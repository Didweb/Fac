<?php
namespace Ofi\GestionBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ofi\GestionBundle\Entity\Telefono;

class Telefonos implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i=0; $i<5; $i++) {
            $telefono = new Telefono();

            $telefono->setTelefono('93'.rand(1111111,9999999));
            $telefono->setNombre('NombreTel '.$i);
            $telefono->setTipo('Tipo '.$i);
           
            $manager->persist($telefono);
        }

        $manager->flush();
    }
}
