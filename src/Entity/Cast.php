<?php

namespace Entity;

use Database\MyPdo;
use Exception;
use PDO;
use Entity\Exception\EntityNotFoundException;

Class Cast{
    private int $id;
    private int $movieId;
    private int $peopleId;
    private string $role;
    private int $orderIndex;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getMovieId(): int
    {
        return $this->movieId;
    }

    /**
     * @return int
     */
    public function getPeopleId(): int
    {
        return $this->peopleId;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @return int
     */
    public function getOrderIndex(): int
    {
        return $this->orderIndex;
    }

    public static function findById(int $movieId,int $peopleId) : Cast {
        $stmt = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT *
            FROM cast
            WHERE peopleId = :actorId
            AND movieId = :movieId;
            SQL
        );
        $stmt->bindParam(':actorId', $peopleId);
        $stmt->bindParam(':movieId', $movieId);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, Cast::class);
        $res = $stmt->fetch();
        if (!$res) {
            throw new EntityNotFoundException('cast non trouvé');
        }
        return $res;
    }
}
