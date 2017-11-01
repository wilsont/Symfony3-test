<?php
/**
 * Created by PhpStorm.
 * User: wilson.tang
 * Date: 1/11/2017
 * Time: 12:53 AM
 */

namespace CarBundle\DataFixtures\ORM;

use CarBundle\Entity\Car;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCars extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.

        $car = new Car();
        $car->setPrice(1999);
        $car->setYear(2014);
        $car->setNavigation(true);
        $car->setPromote(true);
        $car->setModel($this->getReference('NSX'));
        $car->setMake($this->getReference('honda'));

        $car1 = new Car();
        $car1->setPrice(1999);
        $car1->setYear(1939);
        $car1->setNavigation(false);
        $car1->setPromote(false);
        $car1->setModel($this->getReference('NSX'));
        $car1->setMake($this->getReference('honda'));

        $manager->persist($car);
        $manager->persist($car1);
        
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}