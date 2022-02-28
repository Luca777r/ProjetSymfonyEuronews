<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;

class MarvelService
{
    public function getMarvelComics()
    {
        $ts = time();
        $private = "7ccb4de3a15ad51661809fde5ca3743ebaac6956";
        $public = "58c3607be4b218a65242d720871dee86";
        $hash = md5($ts . $private . $public);
        $httpClient = HttpClient::create([], 6, 10);
        $response = $httpClient->request(
            'GET',
            'https://gateway.marvel.com:443/v1/public/comics?titleStartsWith=avengers&orderBy=onsaleDate&limit=50&ts=' . $ts . '&apikey=58c3607be4b218a65242d720871dee86&hash=' . $hash,
        );

        $statusCode = $response->getStatusCode();
        $content = $response->getContent();
        $data = json_decode($content);


        return $data;
    }
    public function getMarvelComicsCharacters($id)
    {
        $ts = time();
        $private = "7ccb4de3a15ad51661809fde5ca3743ebaac6956";
        $public = "58c3607be4b218a65242d720871dee86";
        $hash = md5($ts . $private . $public);
        $httpClient = HttpClient::create([], 6, 10);
        $response = $httpClient->request(
            'GET',
            'https://gateway.marvel.com:443/v1/public/comics/' . $id . '/characters?apikey=' . $public .
                '&ts=' . $ts . '&hash=' . $hash,
        );

        $statusCode = $response->getStatusCode();
        $content = $response->getContent();
        $data = json_decode($content);

        return $data;
    }
}
