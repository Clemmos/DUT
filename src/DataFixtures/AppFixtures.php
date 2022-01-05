<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Entreprise;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $entrepriseSafran = new Entreprise();
        $entrepriseSafran->setNom("Safran");
        $entrepriseSafran->setAdresse("Avenue du 1er mai");
        $entrepriseSafran->setActivite("aéronautique");
        $entrepriseSafran->setUrlSite("https://www.safran-group.com/fr");
        $manager->persist($entrepriseSafran);

        $manager->flush();
    }
}
