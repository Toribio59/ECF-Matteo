<?php

namespace App\DataFixtures;

use App\Entity\Testimonial;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TestimonialFixtures extends Fixture
{
	private const TESTIMONIAL_REFERENCE = 'testimonial';

    public function load(ObjectManager $manager): void
    {	

        $aDataFixture = [
			[
				'author' => 'Jean',
				'content' => 'Très bon accueil, je recommande',
				'rating' => 5,
				'status' => 1,
			],
			[
				'author' => 'Pierre',
				'content' => 'Service rapide et efficace',
				'rating' => 4,
				'status' => 1,

			],
			[
				'author' => 'Paul',
				'content' => 'Très bon service',
				'rating' => 5,
				'status' => 0,
			],
			[
				'author' => 'Jacques',
				'content' => 'Super réparation, personnel très sympa',
				'rating' => 5,
				'status' => 1,
			],
			[
				'author' => 'Jeanne',
				'content' => 'Erreur de réparation, mais le service client a été très réactif',
				'rating' => 3,
				'status' => 1,
			],
		];

		foreach ($aDataFixture as $data) {
			$testimonial = new Testimonial();
			$testimonial->setAuthor($data['author']);
			$testimonial->setContent($data['content']);
			$testimonial->setRating($data['rating']);
			$testimonial->setStatus($data['status']);
			$manager->persist($testimonial);
		}



        $manager->flush();
    }
}
