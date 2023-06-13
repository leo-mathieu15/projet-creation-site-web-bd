<?php

declare(strict_types=1);

namespace Entity\Collection;

use Database\MyPdo;
use Entity\Actor;
use PDO;

class ActorCollection
{
    /** Permet de créer une instance d'actor pour chaque acteur répertorié dans la base de données
     * @return Actor[] tableau des acteurs
     */
    public static function findAll(): array
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<'SQL'
            SELECT *
            FROM people
            ORDER BY title
            SQL
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, Actor::class);
    }
}
