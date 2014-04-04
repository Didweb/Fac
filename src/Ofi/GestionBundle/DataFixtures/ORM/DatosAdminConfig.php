<?php
namespace Ofi\GestionBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ofi\GestionBundle\Entity\AdminConfig;

class InstAdminConfig implements FixtureInterface 
{
	
	
	
    public function load(ObjectManager $manager)
    {
        $adminconfig 	= new AdminCOnfig();

        $adminconfig->setNumerofactura('1');
        $adminconfig->setNomcomercial('Nombre de tu empresa');
           
		$manager->persist($adminconfig);

        $manager->flush();
 
    }
    
}
