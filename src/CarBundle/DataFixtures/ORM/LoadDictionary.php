<?php
/**
 * Created by PhpStorm.
 * User: wilson.tang
 * Date: 1/11/2017
 * Time: 12:46 AM
 */

namespace CarBundle\DataFixtures\ORM;


use CarBundle\Entity\Make;
use CarBundle\Entity\Model;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadDictionary extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.

        $make = new Make();
        $make->setName('honda');

        $make1 = new Make();
        $make1->setName('toyota');

        $make2 = new Make();
        $make2->setName('bmw');

        $manager->persist($make);
        $manager->persist($make1);
        $manager->persist($make2);


        $model = new Model();
        $model->setName('NSX');

        $model1 = new Model();
        $model1->setName('mini');

        $manager->persist($model);
        $manager->persist($model1);

        $manager->flush();

        $this->addReference("NSX", $model);
        $this->addReference("honda", $make);
    }

    public function getOrder()
    {
        return 1;
    }

}