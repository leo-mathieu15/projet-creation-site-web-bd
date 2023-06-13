<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

use Database\MyPdo;
use Html\WebPage;

$webPage = new WebPage("Films");

MyPDO::setConfiguration('mysql:host=mysql;dbname=monn0042_movie;charset=utf8', 'monn0042', 'monn0042');
$movies = (new Entity\Collection\MovieCollection())->findAll();

$webPage->appendContent("<div class='films'>");

for ($i=0;$i<count($movies);++$i) {
    $webPage->appendContent("<a href='movie.php?Id={$movies[$i]->getId()}'>".$webPage->escapeString($movies[$i]->getTitle())."</a><br/>");
}

$webPage->appendContent("</div>");

$webPage = $webPage->toHTML();
echo $webPage;
