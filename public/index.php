<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

use Database\MyPdo;
use Html\WebPage;

$webPage = new WebPage("Films");

MyPDO::setConfiguration('mysql:host=mysql;dbname=monn0042_movie;charset=utf8', 'monn0042', 'monn0042');
$movies = (new Entity\Collection\MovieCollection())->findAll();

$webPage->appendContent("<header>Films</header>");
$webPage->appendContent("<div class='films'>");
$webPage->appendToHead("<link rel='stylesheet' type='text/css' href='css/style.css' />");

foreach ($movies as $movie) {
    $webPage->appendContent("<a id='box' href='movie.php?Id={$movie->getId()}'>".$webPage->escapeString($movie->getTitle()));
    $webPage->appendContent(<<<HTML
<img class="movie__poster" src="image.php?Id={$movie->getPosterId()}" alt="poster de {$movie->getTitle()}"></a><br/>
HTML);
}

$webPage->appendContent("</div>");



$webPage->appendContent("<footer>Dernière modification : {$webPage->getLastModification()}</footer>");

$webPage = $webPage->toHTML();
echo $webPage;
