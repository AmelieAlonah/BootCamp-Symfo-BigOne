<?php

namespace App\DataFixtures;

use DateTime;
use Faker;
use App\Entity\Genre;
use App\Entity\Movie;
use App\Entity\Person;
use App\Entity\Casting;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DataFixtures\Provider\MovieDbProvider;
use App\Entity\User;
use App\Service\MySlugger;
use Doctrine\DBAL\Connection;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\String\Slugger\SluggerInterface;

class AppFixtures extends Fixture
{
    // MySlugger
    private $mySlugger;

    // La connexion directe (DBAL)
    private $connection;

    // Injection des services nécessaires
    public function __construct(MySlugger $mySlugger, Connection $connection)
    {
        $this->mySlugger = $mySlugger;
        $this->connection = $connection;
    }

    private function truncate()
    {
        // Need truncate custom
        $this->connection->executeQuery('SET foreign_key_checks = 0');
        $this->connection->executeQuery('TRUNCATE TABLE casting');
        $this->connection->executeQuery('TRUNCATE TABLE department');
        $this->connection->executeQuery('TRUNCATE TABLE genre');
        $this->connection->executeQuery('TRUNCATE TABLE job');
        $this->connection->executeQuery('TRUNCATE TABLE movie');
        $this->connection->executeQuery('TRUNCATE TABLE movie_genre');
        $this->connection->executeQuery('TRUNCATE TABLE person');
        $this->connection->executeQuery('TRUNCATE TABLE review');
        $this->connection->executeQuery('TRUNCATE TABLE team');
        $this->connection->executeQuery('TRUNCATE TABLE user');
    }

    public function load(ObjectManager $manager)
    {
        // truncate table id -> 1
        $this->truncate();

        // faker
        $faker = Faker\Factory::create('fr_FR');

        $faker->seed('BABAR');

        $faker->addProvider(new MovieDbProvider());

        print('Création des utilisateurs' . PHP_EOL);

        // 3 users : USER, MANAGER, ADMIN
        // mot de passe = user, manager, admin
        print('ROLE_USER' . PHP_EOL);
        $user = new User();
        $user->setEmail('user@user.com');
        // "user" via "bin/console security:hash-password"
        $user->setPassword('$2y$13$h.eZWrS5PJya7zNMNsKcXe8LUSVBtN2PBy8WHxmdHgAFjHG/rW.dG');
        $user->setRoles(['ROLE_USER']);

        $manager->persist($user);

        print('ROLE_MANAGER' . PHP_EOL);
        $userManager = new User();
        $userManager->setEmail('manager@manager.com');
        // "manager" via "bin/console security:hash-password"
        $userManager->setPassword('$2y$13$3YxSfXMdyaKdplTEd07.SuDnbjAQZIAn8NLbhHzTLUnl1N7oegQg2');
        $userManager->setRoles(['ROLE_MANAGER']);

        $manager->persist($userManager);

        print('ROLE_ADMIN' . PHP_EOL);
        $admin = new User();
        $admin->setEmail('admin@admin.com');
        // "admin" via "bin/console security:hash-password"
        $admin->setPassword('$2y$13$L81zK/fTjQikyz3PtBmbL.WdDILXR.Ppn.whBAvLJsbaFu4Fu0zVe');
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        // 20 genres

        // Liste genres
        $genresList = [];

        for ($i = 1; $i <= 20; $i++) {

            // New genre
            $genre = new Genre();
            $genre->setName($faker->unique()->movieGenre());

            $genresList[] = $genre; // array_push($genresList, $genre);

            // Doctrine Persist
            $manager->persist($genre);
        }


        // 20 films

        $moviesList = [];

        for ($i = 1; $i <= 20; $i++) {

            $movie = new Movie();
            $movie->setTitle($faker->unique()->movieTitle());
            $movie->setDuration($faker->numberBetween(15, 360));
            $movie->setPoster($faker->imageUrl(300, 400));
            $movie->setRating($faker->numberBetween(1, 5));
            $movie->setReleaseDate($faker->dateTimeBetween('-70 years'));

            // slugify with service
            // => transféré dans le MovieListener

            // random genre associate
            for ($r = 1; $r <= mt_rand(1, 3); $r++) {
                $movie->addGenre($genresList[array_rand($genresList)]);
            }

            $moviesList[] = $movie;

            $manager->persist($movie);
        }

        // 20 personnes

        $personsList = [];

        for ($i = 1; $i <= 20; $i++) {

            $person = new Person();
            $person->setFirstname($faker->firstName());
            $person->setLastname($faker->lastName());

            $personsList[] = $person;

            $manager->persist($person);
        }

        // castings
        for ($i = 1; $i < 100; $i++) {
            $casting = new Casting();
            $casting->setRole($faker->firstName());
            $casting->setCreditOrder(mt_rand(1, 10));

            $randomMovie = $moviesList[mt_rand(0, count($moviesList) - 1)];
            $casting->setMovie($randomMovie);

            $randomPerson = $personsList[array_rand($personsList)];
            $casting->setPerson($randomPerson);

            $manager->persist($casting);
        }

        $manager->flush();
    }
}
