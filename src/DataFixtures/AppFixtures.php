<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Livre;
use App\Entity\Auther;
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i <10 ; $i++) { 
                
            $auther = new Auther();
            $auther->setNom("nom $i");
            $auther->setNationalite("nationalite $i");
            $auther->setDateNaissance(new \DateTime());
            $manager->persist($auther);
            for ($j=0; $j < 3; $j++) { 
                $livre = new Livre();
                $livre->setTitre("titre $j");
                $livre->setDate(new \DateTime());
                $livre->setImage("https://images.ctfassets.net/usf1vwtuqyxm/24YWmI4UcyoMwj7wdKrEcL/374de1941927db12bd844fb197eab11f/English_Harry_Potter_3_Epub_9781781100233.jpg?w=914&q=70&fm=jpg");
                $livre->setNbPages(100);
                $livre->setAuteur($auther);
                $manager->persist($livre); 
            }

        }


        $manager->flush();
    }
}
