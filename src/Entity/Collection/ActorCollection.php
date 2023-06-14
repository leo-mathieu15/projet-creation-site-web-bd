<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Actor;
use PDO;
use Entity\Exception\EntityNotFoundException;

class ActorCollection
{
    /** Permet de créer une instance d'actor pour chaque acteur répertorié dans la base de données
     * @return Actor[] tableau des acteurs
     */
    public static function findByIdMovieAll(int $id): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM people p 
            join cast c on p.id = c.peopleId
            WHERE movieId = :id
            SQL
        );
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $res = $stmt->fetchALL(PDO::FETCH_CLASS, Actor::class);
        if (!$res) {
            throw new EntityNotFoundException('film non trouvée');
        }
        return $res;
    }
}