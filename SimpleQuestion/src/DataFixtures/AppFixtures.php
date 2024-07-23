<?php

namespace App\DataFixtures;

use App\Entity\Answer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $answer = new Answer();
        $answer_id = $answer->getAnswerId();
        $answer->setAnswer('Oedipus');

        $manager->persist($answer);

        $manager->flush();
    }
}
