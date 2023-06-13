<?php

declare(strict_types=1);

use Entity\Actor;
use Html\WebPage;
use Database\MyPdo;

$webPage = new WebPage();


$actor = Actor::findById((int)$_GET['Id']);

$webPage->appendToHead("<link rel='stylesheet' type='text/css' href='css/style.css' />");
$webPage->appendContent("<header>Film - {$actor->getName()}</header>");

$webPage->appendContent("<div class='acteur'>");

$webPage->appendContent(<<<HTML
<a>
<img class="movie__poster" src="image.php?Id={$actor->getAvatarId()}" alt="poster de {$actor->getname()}"></a>
<div class='details'>
<div>{$actor->getname()}</div><br>
<div>{$actor->getPlaceOfBirth()}</div><br>
<div>{$actor->getBirthday()}-{$actor->getDeathday()}</div><br>
<div>{$actor->getBiography()}</div><br>
</div>
HTML);

$webPage->appendContent("</div>"."<footer>Dernière modification : {$webPage->getLastModification()}</footer>");

$page = $webPage->toHTML();
echo $page;