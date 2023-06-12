<?php

declare(strict_types=1);

require_once '../vendor/autoload.php';

use Database\MyPdo;
use Html\WebPage;

$webPage = new WebPage("people");

MyPDO::setConfiguration('mysql:host=mysql;dbname=monn0042_movie;charset=utf8', 'monn0042', 'monn0042');
$stmt = MyPDO::getInstance()->prepare(
    <<<'SQL'
    SELECT id, name
    FROM people
    ORDER BY name
SQL
);

$stmt->execute();

while (($ligne = $stmt->fetch()) !== false) {
    $ligne_cor = $webPage->escapeString("{$ligne['name']}");
    $webPage->appendContent("<p>$ligne_cor\n");
}

$webPage = $webPage->toHTML();
echo $webPage;
