<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

use Database\MyPdo;
use Html\WebPage;
use Entity\Image;

$webPage = new WebPage("Films");

MyPDO::setConfiguration('mysql:host=mysql;dbname=monn0042_movie;charset=utf8', 'monn0042', 'monn0042');
$movies = (new Entity\Collection\MovieCollection())->findAll();

$webPage->appendContent("<div class='films'>");

for ($i=0;$i<count($movies);++$i) {
    $webPage->appendContent("<a id='box' href='movie.php?Id={$movies[$i]->getId()}'>".$webPage->escapeString($movies[$i]->getTitle())."</a><br/>");
    $image = new Image;
    $postId = $movies[$i]->getPosterId();
    $webPage->appendContent("<img id='photo_film' src='{$image->findById($postId)}'>");
}

$webPage->appendContent("</div>");

$webPage->appendCss("
#box {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 2%;
    margin: 2%;
    width: 10em;
    height: 10em;
    border-radius: 10%;
    background: #D7D7D7;
    text-decoration: none;
    color: black;
}

.films {
    display: flex;
    justify-content: center;
    flex-direction: row;
    flex-wrap: wrap;
}
");

$webPage = $webPage->toHTML();
echo $webPage;
