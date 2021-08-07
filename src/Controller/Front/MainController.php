<?php

namespace App\Controller\Front;

use App\Entity\Movie;
use App\Entity\Review;
use App\Form\ReviewType;
use App\Repository\MovieRepository;
use App\Repository\CastingRepository;
use App\Repository\GenreRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     * Movies ist
     * 
     * @Route("/", name="home")
     */
    public function home(MovieRepository $movieRepository, GenreRepository $genreRepository): Response
    {
        $movies = $movieRepository->findAllOrderedByTitleAscDql();

        $genres = $genreRepository->findBy([], ['name' => 'ASC']);

        return $this->render('front/main/home.html.twig', [
            'movies' => $movies,
            'genres' => $genres,
        ]);
    }

    /**
     * Read with slug
     * 
     * @Route("/movie/{slug}", name="movie_show")
     */
    public function readMovie(Movie $movie = null, CastingRepository $castingRepository): Response
    {
        if ($movie === null) {
            throw $this->createNotFoundException('Film non trouvé.');
        }

        $castings = $castingRepository->findAllByMovieJoinedToPerson($movie);

        return $this->render('front/main/movie_show.html.twig', [
            'movie' => $movie,
            'castings' => $castings,
        ]);
    }

    /**
     * Create Review
     * 
     * @Route("/movie/{id}/create/review", name="movie_create_review", methods={"GET", "POST"})
     */
    public function movieCreateReview(Movie $movie = null, Request $request): Response
    {
        if ($movie === null) {
            throw $this->createNotFoundException('Film non trouvé.');
        }

        $review = new Review();
        $form   = $this->createForm(ReviewType::class, $review);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $review->setMovie($movie);

            $em = $this->getDoctrine()->getManager();
            $em->persist($review);
            $em->flush();

            return $this->redirectToRoute('movie_show', ['id' => $movie->getId()]);
        }

        return $this->render('front/main/movie_add_review.html.twig', [
            'form' => $form->createView(),
            'movie' => $movie,
        ]);
    }
}
