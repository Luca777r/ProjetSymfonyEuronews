<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\MarvelService;

class MarvelController extends AbstractController
{
    #[Route('/monappli.com/comics/avengers', name: 'marvel')]
    public function index(MarvelService $marvelService): Response
    {
        return $this->render('marvel/index.html.twig', [
            "response" => $marvelService->getMarvelComics()
        ]);
    }

    #[Route('/monappli.com/comics/avengers/characters/{id}', name: 'marvel_characters')]
    public function characters(MarvelService $marvelService, $id): Response
    {
        return $this->render('marvel/characters.html.twig', [
            "response" => $marvelService->getMarvelComicsCharacters($id)
        ]);
    }
}
