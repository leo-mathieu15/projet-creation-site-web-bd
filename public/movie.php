<?php

use Entity\Movie;
use Html\WebPage;
use Database\MyPdo;
use Entity\Collection\ActorCollection;
use Entity\Exception\EntityNotFoundException;

$webPage = new WebPage();


$movie = Movie::findById((int)$_GET['Id']);
$actors = ActorCollection::findByIdMovieAll((int)$_GET['Id']);

$webPage->appendToHead("<link rel='stylesheet' type='text/css' href='css/style.css' />");
$webPage->appendContent("<header>Film - {$movie->getTitle()}</header>");
$webPage->appendContent("<div class='movie__page'>");

$webPage->appendContent(<<<HTML
<div class="movie__info">
<img class="movie__poster" src="image.php?Id={$movie->getPosterId()}" alt="poster de {$movie->getTitle()}"></a><br/>
<div class="details">
<a class="basicinfo">{$movie->getTitle()}</a>
<a class="basicinfo">{$movie->getReleaseDate()}</a><br/>
<a>{$movie->getOriginalTitle()}</a><br/>
<a>{$movie->getTagLine()}</a><br/>
<a>{$movie->getOverview()}</a><br/></div>
HTML);
foreach ($actors as $actor) {
    $webPage->appendContent(<<<HTML
<div class="acteurFilm">
<img class="Actor__vignette" src="image.php?Id={$actor->getAvatarId()}" alt="poster de {$actor->getname()}"></a>
<a>{$actor->getName()}</a>
<a>{$actor->getRole((int)$_GET['Id'])}</a>
</div>
HTML);
}


$webPage->appendContent("</div>"."<footer>Dernière modification : {$webPage->getLastModification()}</footer>");

$page = $webPage->toHTML();
echo $page;