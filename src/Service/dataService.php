<?php

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;


    $client = new Client();
    $crawler = $client->request('GET', 'https://www.manomano.fr/nos-conseils%27');

    $crawler-> filter ('li > a.Hub_link__HJZxy')-> each ( function ( $node ) {
        $url = $node->attr('href');
        print $node -> text (). "<br/>" . $url . "<br/><br/>";
    });