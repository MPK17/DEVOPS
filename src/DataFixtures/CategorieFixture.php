<?php

namespace App\DataFixtures;

use App\Entity\CategorieProduit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategorieFixture extends AppFixtures
{
    public function load(ObjectManager $manager): void
    {
       for($i = 0 ; $i<=15 ; $i++){
           $categorie = new CategorieProduit();
           $categorie->setNomCategorie("pulls");
           $categorie->setDescriptionCategorie("Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.");
            $manager->persist($categorie);
       }

        $manager->flush();
    }
}
