<?php

namespace App\DataFixtures;


use App\Entity\Car;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CarFixtures extends Fixture
{
    public const CAR_REFERENCE = 'car';

    public function load(ObjectManager $manager): void
    {
        $aDataFixture = [
            [
                'title' => 'Audi A4 2018',
                'price' => 16000,
                'manufactureYear' => 2018,
                'mileage' => 100.000,
                'description' => 'Voiture en très bon état',
                'model' => 'A4',
                'brand' => 'Audi',
            ],
            [
                'title' => 'Audi A3 peu utilisée',
                'price' => 25000,
                'manufactureYear' => 2013,
                'mileage' => 82000,
                'description' => 'Voiture moyennement bon état',
                'model' => 'A3',
                'brand' => 'Audi',
            ],
            [
                'title' => 'Chevrolet Camaro première main',
                'price' => 15000,
                'manufactureYear' => 2017,
                'mileage' => 105000,
                'description' => 'Voiture en très bon état, première main',
                'model' => 'Camaro',
                'brand' => 'Chevrolet',
            ],
            [
                'title' => 'Fiât 500 Très bon état',
                'price' => 10000,
                'manufactureYear' => 2012,
                'mileage' => 120000,
                'description' => 'Voiture en très bon état',
                'model' => '500',
                'brand' => 'Fiât',
            ],

        ];

        foreach ($aDataFixture as $aCarFixture) {
            $car = new Car();
            $car->setTitle($aCarFixture['title']);
            $car->setPrice($aCarFixture['price']);
            $car->setManufactureYear($aCarFixture['manufactureYear']);
            $car->setMileage($aCarFixture['mileage']);
            $car->setDescription($aCarFixture['description']);
            $car->setModel($aCarFixture['model']);
            $car->setBrand($aCarFixture['brand']);
            $manager->persist($car);
        }

        $manager->flush();
    }
}
