<?php

namespace App\DataFixtures;

use App\Entity\Schedule;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ScheduleFixtures extends Fixture
{
    public const SCHEDULE_REFERENCE = 'schedule';

    public function load(ObjectManager $manager): void
    {
        $aDataFixture = [
            "mondayOTM" => "08:00",
            "mondayCTM" => "12:00",
            "mondayOTA" => "14:00",
            "mondayCTA" => "18:00",
            "tuesdayOTM" => "08:00",
            "tuesdayCTM" => "12:00",
            "tuesdayOTA" => "14:00",
            "tuesdayCTA" => "18:00",
            "wednesdayOTM" => "08:00",
            "wednesdayCTM" => "12:00",
            "wednesdayOTA" => "12:00",
            "wednesdayCTA" => "18:00",
            "thursdayOTM" => "08:00",
            "thursdayCTM" => "12:00",
            "thursdayOTA" => "14:00",
            "thursdayCTA" => "18:00",
            "fridayOTM" => "08:00",
            "fridayCTM" => "12:00",
            "fridayOTA" => "14:00",
            "fridayCTA" => "17:00",
            "saturdayOTM" => "08:00",
            "saturdayCTM" => "12:00",
            "saturdayOTA" => null,
            "saturdayCTA" => null,
            "sundayOTM" => null,
            "sundayCTM" => null,
            "sundayOTA" => null,
            "sundayCTA" => null,
            "description" => "Horaires d'ouverture de la concession",
        ];

        $schedule = new Schedule();
        $schedule->setMondayOTM($aDataFixture['mondayOTM']);
        $schedule->setMondayCTM($aDataFixture['mondayCTM']);
        $schedule->setMondayOTA($aDataFixture['mondayOTA']);
        $schedule->setMondayCTA($aDataFixture['mondayCTA']);
        $schedule->setTuesdayOTM($aDataFixture['tuesdayOTM']);
        $schedule->setTuesdayCTM($aDataFixture['tuesdayCTM']);
        $schedule->setTuesdayOTA($aDataFixture['tuesdayOTA']);
        $schedule->setTuesdayCTA($aDataFixture['tuesdayCTA']);
        $schedule->setWednesdayOTM($aDataFixture['wednesdayOTM']);
        $schedule->setWednesdayCTM($aDataFixture['wednesdayCTM']);
        $schedule->setWednesdayOTA($aDataFixture['wednesdayOTA']);
        $schedule->setWednesdayCTA($aDataFixture['wednesdayCTA']);
        $schedule->setThursdayOTM($aDataFixture['thursdayOTM']);
        $schedule->setThursdayCTM($aDataFixture['thursdayCTM']);
        $schedule->setThursdayOTA($aDataFixture['thursdayOTA']);
        $schedule->setThursdayCTA($aDataFixture['thursdayCTA']);
        $schedule->setFridayOTM($aDataFixture['fridayOTM']);
        $schedule->setFridayCTM($aDataFixture['fridayCTM']);
        $schedule->setFridayOTA($aDataFixture['fridayOTA']);
        $schedule->setFridayCTA($aDataFixture['fridayCTA']);
        $schedule->setSaturdayOTM($aDataFixture['saturdayOTM']);
        $schedule->setSaturdayCTM($aDataFixture['saturdayCTM']);
        $schedule->setSaturdayOTA($aDataFixture['saturdayOTA']);
        $schedule->setSaturdayCTA($aDataFixture['saturdayCTA']);
        $schedule->setSundayOTM($aDataFixture['sundayOTM']);
        $schedule->setSundayCTM($aDataFixture['sundayCTM']);
        $schedule->setSundayOTA($aDataFixture['sundayOTA']);
        $schedule->setSundayCTA($aDataFixture['sundayCTA']);
        $schedule->setDescription($aDataFixture['description']);
        $manager->persist($schedule);

        $manager->flush();
    }
}
