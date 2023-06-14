<?php

declare(strict_types=1);

use Entity\Actor;
use Html\WebPage;
use Entity\Collection\MovieCollection;
use Entity\Cast;

$webPage = new WebPage();


$actor = Actor::findById((int)$_GET['Id']);
$movies = MovieCollection::findByIdpeople((int)$_GET['Id']);

$webPage->appendToHead("<link rel='stylesheet' type='text/css' href='css/style.css' />");
$webPage->appendContent("<header>Films - {$actor->getName()}</header>");
$webPage->appendContent("<div class='acteur__page'>");

$webPage->appendContent(<<<HTML
<div class='actor__infos'>
<img class="Actor__vignette" src="image.php?Id={$actor->getAvatarId()}" alt="poster de {$actor->getname()}">
<div class="details">
<a class="basicinfo">{$actor->getname()}</a><br>
<a class="basicinfo">{$actor->getPlaceOfBirth()}</a><br>
<a class="basicinfo">Naissance : {$actor->getBirthday()}<br>Décès : {$actor->getDeathday()}</a>
<a class="basicinfo">{$actor->getBiography()}</a><br>
</div></div>
HTML);
foreach ($movies as $movie) {
    $cast = Cast::findById($movie->getId(),$actor->getId());
    $webPage->appendContent(<<<HTML
<div class="acteurFilm">
<img class="movie__poster" src="image.php?Id={$movie->getPosterId()}" alt="poster de {$movie->getTitle()}"></a>
<a id='boxClick' href="movie.php?Id={$movie->getId()}">{$movie->getTitle()}{$movie->getReleaseDate()}</a>
<a id='boxAutre'>{$cast->getRole()}</a>
</div>
HTML);
}
$webPage->appendContent("</div>"."<footer>Dernière modification : {$webPage->getLastModification()}</footer>");

$page = $webPage->toHTML();
echo $page;
