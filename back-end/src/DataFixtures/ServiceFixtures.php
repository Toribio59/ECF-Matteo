<?php

namespace App\DataFixtures;

use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ServiceFixtures extends Fixture
{

	public function load(ObjectManager $manager): void
	{
		$aDataFixture = [
			[
				'title' => 'Réparation',
				'description' => 'Réparation de votre véhicule',
				'tag' => 'Réparation',
			],
			[
				'title' => 'Vidange',
				'description' => 'Vidange de votre véhicule',
				'tag' => 'Vidange',
			],
			[
				'title' => 'Pneus',
				'description' => 'Changement de vos pneus',
				'tag' => 'Pneus',
			],
			[
				'title' => 'Carrosserie',
				'description' => 'Réparation de votre carrosserie',
				'tag' => 'Carrosserie',
			],
			[
				'title' => 'Peinture',
				'description' => 'Peinture de votre véhicule',
				'tag' => 'Peinture',
			],
			[
				'title' => 'Pare-brise',
				'description' => 'Réparation de votre pare-brise',
				'tag' => 'Pare-brise',
			],
			[
				'title' => 'Freins',
				'description' => 'Réparation de vos freins',
				'tag' => 'Freins',
			],
			[
				'title' => 'Amortisseurs',
				'description' => 'Réparation de vos amortisseurs',
				'tag' => 'Amortisseurs',
			],
			[
				'title' => 'Batterie',
				'description' => 'Réparation de votre batterie',
				'tag' => 'Batterie',
			],
			[
				'title' => 'Echappement',
				'description' => 'Réparation de votre échappement',
				'tag' => 'Echappement',
			],
			[
				'title' => 'Climatisation',
				'description' => 'Réparation de votre climatisation',
				'tag' => 'Climatisation',
			],
			[
				'title' => 'Diagnostic',
				'description' => 'Diagnostic de votre véhicule',
				'tag' => 'Diagnostic',
			],
			[
				'title' => 'Autres',
				'description' => 'Autres réparations',
				'tag' => 'Autres',
			],
		];

		foreach ($aDataFixture as $data) {
			$service = new Service();
			$service->setTitle($data['title']);
			$service->setDescription($data['description']);
			$service->setTag($data['tag']);
			$manager->persist($service);
		}

		$manager->flush();
	}
}
