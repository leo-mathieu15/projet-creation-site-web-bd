<?php

use Entity\Movie;
use Entity\Cast;
use Html\WebPage;
use Entity\Collection\ActorCollection;


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
<a>{$movie->getOverview()}</a><br/></div></div><div>
HTML);
foreach ($actors as $actor) {
    $cast = Cast::findById($movie->getId(),$actor->getId());
    $webPage->appendContent(<<<HTML
<div class="acteurFilm">
<img class="Actor__vignette" src="image.php?Id={$actor->getAvatarId()}" alt="poster de {$actor->getname()}"></a>
<a href='actor.php?Id={$actor->getId()}' id="boxNomActeur">{$actor->getName()}</a>
<a id="boxAutre">{$cast->getRole()}</a>
</div>
HTML);
}


$webPage->appendContent("</div></div></div>"."<footer>Dernière modification : {$webPage->getLastModification()}</footer>");

$page = $webPage->toHTML();
echo $page;
