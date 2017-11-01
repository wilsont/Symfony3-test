<?php
/**
 * Created by PhpStorm.
 * User: wilson.tang
 * Date: 31/10/2017
 * Time: 2:42 PM
 */
namespace CarBundle\Service;

use CarBundle\Entity\Car;
use Doctrine\ORM\EntityManager;

class DataChecker
{

    /** @var  boolean */
    protected $requiredImagesToPromoteCar;

    /** @var  EntityManager */
    protected $entityManager;

    /**
     * DataChecker constructor.
     * @param EntityManager $entityManager
     * @param bool $requiredImagesToPromoteCar
     */
    public function __construct(EntityManager $entityManager, $requiredImagesToPromoteCar)
    {
        $this->entityManager = $entityManager;
        $this->requiredImagesToPromoteCar = $requiredImagesToPromoteCar;
    }

    public function checkCar(Car $car)
    {
        $promote = true;
        if ($this->requiredImagesToPromoteCar) {
            $promote = false;
        }

        $car->setPromote($promote);
        $this->entityManager->persist($car);
        $this->entityManager->flush();

        return $promote;
    }
}