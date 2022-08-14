<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\String\Slugger\SluggerInterface;

class ArticleFixtures extends Fixture
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("fr_FR");

        for ($i = 0; $i < 20; $i++){
            $article = new Article();
            $article->setTitre($faker->word(3));
            $article->setContenu($faker->paragraphs(100, true));
            $article->setSlug($this->slugger->slug($article->getTitre()));
            $article->setImage("606500.jpg");
            $article->setIsValid(false);
            $manager->persist($article);
        }

        $manager->flush();
    }
}
