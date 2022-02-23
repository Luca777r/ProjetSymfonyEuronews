<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MarvelController extends AbstractController
{
    #[Route('/monappli.com/comics/avengers', name: 'marvel')]
    public function index(): Response
    {
        $ts = time();
        $private = "7ccb4de3a15ad51661809fde5ca3743ebaac6956";
        $public = "58c3607be4b218a65242d720871dee86";
        $hash = md5($ts . $private . $public);
        $httpClient = HttpClient::create([], 6, 10);
        $response = $httpClient->request(
            'GET',
            'https://gateway.marvel.com:443/v1/public/comics?characters=1009165&orderBy=onsaleDate&limit=50&ts=' . $ts . '&apikey=58c3607be4b218a65242d720871dee86&hash=' . $hash,
        );

        $statusCode = $response->getStatusCode();
        $content = $response->getContent();
        $data = json_decode($content);
        // dd($data);

        return $this->render('marvel/index.html.twig', [
            'controller_name' => 'MarvelController',
            "response" => $data
        ]);
    }
}
