<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Movie;
use PDO;

class MovieCollection
{
    /** Permet de créer une instance de Artist pour chaque artiste répertorié dans la base de données
     * @return Movie[] tableau d'artistes
     */
    public static function findAll(): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT id, title
            FROM movie
            ORDER BY title
            SQL
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, Movie::class);
    }
}
