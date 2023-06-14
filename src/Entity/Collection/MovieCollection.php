<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Movie;
use PDO;
use Entity\Exception\EntityNotFoundException;

class MovieCollection
{
    /** Permet de créer une instance de film pour chaque film répertorié dans la base de données
     * @return Movie[] tableau de film
     */
    public static function findAll(): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM movie
            ORDER BY title
            SQL
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, Movie::class);
    }

    public static function findByIdpeople(int $id): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT m.*
            FROM movie m 
            join cast c on m.id = c.movieId
            WHERE peopleId = :id
            SQL
        );
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $res = $stmt->fetchALL(PDO::FETCH_CLASS, Movie::class);
        if (!$res) {
            throw new EntityNotFoundException('acteur non trouvée');
        }
        return $res;
    }
}
