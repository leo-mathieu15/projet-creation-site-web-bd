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
$webPage->appendContent("<header>Film - {$actor->getName()}</header>");

$webPage->appendContent("<div class='acteur'>");

$webPage->appendContent(<<<HTML

<a>
<img class="Actor__vignette" src="image.php?Id={$actor->getAvatarId()}" alt="poster de {$actor->getname()}"></a>
<div class='details'>
<div>{$actor->getname()}</div><br>
<div>{$actor->getPlaceOfBirth()}</div><br>
<div>{$actor->getBirthday()}-{$actor->getDeathday()}</div><br>
<div>{$actor->getBiography()}</div><br>
</div>
HTML);
foreach ($movies as $movie) {
    $cast = Cast::findById($movie->getId(),$actor->getId());
    $webPage->appendContent(<<<HTML
<div class="acteurFilm">
<img class="movie__poster" src="image.php?Id={$movie->getPosterId()}" alt="poster de {$movie->getTitle()}"></a>
<a>{$movie->getTitle()}{$movie->getReleaseDate()}</a>
<a>{$cast->getRole()}</a>
</div>
HTML);
}
$webPage->appendContent("</div>"."<footer>Dernière modification : {$webPage->getLastModification()}</footer>");

$page = $webPage->toHTML();
echo $page;
