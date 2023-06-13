<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

use Database\MyPdo;
use Html\WebPage;
use Entity\Image;

$webPage = new WebPage("Films");

MyPDO::setConfiguration('mysql:host=mysql;dbname=monn0042_movie;charset=utf8', 'monn0042', 'monn0042');
$movies = (new Entity\Collection\MovieCollection())->findAll();

$webPage->appendContent("<header>Films</header>");
$webPage->appendContent("<div class='films'>");

foreach ($movies as $movie) {
    $webPage->appendContent("<a id='box' href='movie.php?Id={$movie->getId()}'>".$webPage->escapeString($movie->getTitle()));
    $webPage->appendContent(<<<HTML
<img class="movie__poster" src="image.php?Id={$movie->getPosterId()}" alt="poster de {$movie->getTitle()}"></a><br/>
HTML);
}

$webPage->appendContent("</div>");

$webPage->appendCss("     
#box {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 1%;
    margin: 1%;
    width: 9em;
    height: 9em;
    border-style: solid;
    border-color:#FFFFFF;
    background: #00AAFF;
    text-decoration: none;
    color: black;
}

.films {
    display: flex;
    justify-content: center;
    flex-direction: row;
    flex-wrap: wrap;
    margin-top:auto;
    width:auto;
    height:94vh;
    overflow: auto;
    flex-grow:1;
}

html, body{
    height:100%;
    margin:0;
    background-color:black;
}

@media screen and (max-height:640px){
    .films {
        height:85vh;
    }
}

header{
    background-color:#000088;
    color:#FFFFFF;
    text-align:center;
    border-style:double;
    border-color:#FFFFFF;
}

footer{
    background-color:#000066;
    color:#FFFFFF;
    text-align:center;
    border-style:double;
    border-color:#FFFFFF;
}
");

$webPage->appendContent("<footer>Dernière modification : {$webPage->getLastModification()}</footer>");

$webPage = $webPage->toHTML();
echo $webPage;
