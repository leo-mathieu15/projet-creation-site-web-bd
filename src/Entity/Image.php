<?php
declare(strict_types=1);

namespace Entity;

use Database\MyPdo;
use Entity\Exception\EntityNotFoundException;
use PDO;
class Image
{
    private int $id;
    private string $jpeg;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getJpeg(): string
    {
        return $this->jpeg;
    }

    /**
     * Return the image based of the id given, if the id does not match anything, throw EntityNotFound
     * @param int $id
     * @return Image
     * @throws EntityNotFoundException
     */
    public static function findById(int $id): Image
    {
        $stmt = MyPdo::getInstance()->prepare(
            <<<SQL
            SELECT *
            FROM image
            WHERE id = :imageId;
            SQL
        );
        $stmt->bindParam(':imageId', $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, Image::class);
        $res = $stmt->fetch();
        if (!$res) {
            throw new EntityNotFoundException('Image non trouvée');
        }
        return $res;
    }
}