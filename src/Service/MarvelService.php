<?php

namespace App\Service;

use stdClass;
use Symfony\Component\HttpClient\HttpClient;


class MarvelService
{
    protected $marvelPrivateKey;
    protected $marvelPublicKey;

    public function __construct(string $marvelPrivateKey, string $marvelPublicKey)
    {
        $this->marvelPrivateKey = $marvelPrivateKey;
        $this->marvelPublicKey = $marvelPublicKey;
    }

    public function getMarvelComics(string $hero): stdClass
    {
        $ts = time();
        $hash = md5($ts . $this->marvelPrivateKey . $this->marvelPublicKey);
        $httpClient = HttpClient::create([], 6, 10);
        $response = $httpClient->request(
            'GET',
            'https://gateway.marvel.com:443/v1/public/comics?titleStartsWith=' . $hero . '&orderBy=onsaleDate&limit=50&ts=' . $ts . '&apikey=' . $this->marvelPublicKey . '&hash=' . $hash,
        );

        $statusCode = $response->getStatusCode();
        $content = $response->getContent();
        $data = json_decode($content);


        return $data;
    }

    public function getMarvelComicsCharacters(int $id)
    {
        $ts = time();
        $hash = md5($ts . $this->marvelPrivateKey . $this->marvelPublicKey);
        $httpClient = HttpClient::create([], 6, 10);
        $response = $httpClient->request(
            'GET',
            'https://gateway.marvel.com:443/v1/public/comics/' . $id . '/characters?apikey=' . $this->marvelPublicKey .
                '&ts=' . $ts . '&hash=' . $hash,
        );

        $statusCode = $response->getStatusCode();
        $content = $response->getContent();
        $data = json_decode($content);

        return $data;
    }
}
