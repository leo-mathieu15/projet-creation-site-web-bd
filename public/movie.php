<?php

use Entity\Movie;
use Html\WebPage;
use Database\MyPdo;

$webPage = new WebPage();


$movie = Movie::findById((int)$_GET['Id']);

$webPage->appendToHead("<link rel='stylesheet' type='text/css' href='css/style.css' />");
$webPage->appendContent("<header>Film - {$movie->getTitle()}</header>");
$webPage->appendContent("<div class='details'>");

$webPage->appendContent(<<<HTML
<img class="movie__poster" src="image.php?Id={$movie->getPosterId()}" alt="poster de {$movie->getTitle()}"></a><br/>
HTML);
$webPage->appendContent(
    "{$movie->getTitle()}<br/>".
    "{$movie->getReleaseDate()}<br/>".
    "{$movie->getOriginalTitle()}<br/>".
    "{$movie->getTagLine()}<br/>".
    "{$movie->getOverview()}<br/>"
);

$webPage->appendContent("</div>"."<footer>Dernière modification : {$webPage->getLastModification()}</footer>");

$page = $webPage->toHTML();
echo $page;