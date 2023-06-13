<?php

declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use PDO;

Class Actor {

    private int $id;
    private int $avatarId;
    private string $birthday;
    private string $deathday;
    private string $name;
    private string $biography;
    private string $placeOfBirth;

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
    public function getAvatarId(): int
    {
        return $this->avatarId;
    }

    /**
     * @return string
     */
    public function getBirthday(): string
    {
        return $this->birthday;
    }

    /**
     * @return string
     */
    public function getDeathday(): string
    {
        return $this->deathday;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getBiography(): string
    {
        return $this->biography;
    }

    /**
     * @return string
     */
    public function getPlaceOfBirth(): string
    {
        return $this->placeOfBirth;
    }

    /**
     * Return an actor based of the id given, if the id does not match anything, throw EntityNotFound
     * @param int $id
     * @return Actor
     * @throws EntityNotFoundException
     */
    public static function findById(int $id): Actor
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT *
            FROM people
            WHERE id = :actorId;
            SQL
        );
        $stmt->bindParam(':actorId', $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, Actor::class);
        $res = $stmt->fetch();
        if (!$res) {
            throw new EntityNotFoundException('Acteur non trouvé');
        }
        return $res;
    }
}