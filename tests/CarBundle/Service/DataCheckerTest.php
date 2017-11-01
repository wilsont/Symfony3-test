<?php
/**
 * Created by PhpStorm.
 * User: wilson.tang
 * Date: 1/11/2017
 * Time: 12:25 AM
 */

namespace CarBundle\Service;


use CarBundle\Entity\Car;
use Doctrine\ORM\EntityManager;

class DataCheckerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var EntityManager|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $entityManager;

    public function setup()
    {
        $this->entityManager = $this
            ->getMockBuilder('Doctrine\ORM\EntityManager')
            ->disableOriginalConstructor()
            ->getMock()
        ;
    }

    public function testABC()
    {
        $subject = new DataChecker($this->entityManager, true);

        $expected = false;


        $car = $this->getMock('CarBundle\Entity\Car');

        $car
            ->expects($this->once())
            ->method('setPromote')
        ;


        $this->entityManager
            ->expects($this->once())
            ->method('persist')
            ->with($car)
        ;

        $this->entityManager
            ->expects($this->once())
            ->method('flush')
        ;

        $result = $subject->checkCar($car);
        $this->assertEquals($expected, $result);
    }
}
