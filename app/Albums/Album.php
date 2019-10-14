<?php

namespace App\Albums;

use App\DatabaseAbstract;

class Album extends DatabaseAbstract implements AlbumInterface
{
    /**
     * @var string
     */
    protected $table = ALBUM_TABLE;

    /**
     * @var string
     */
    protected $pictureTable = PICTURE_TABLE;

    public function get(string $sql = null)
    {
        $pictures = [
            $this->pictureTable . '.picture_id, ","',
            $this->pictureTable . '.album_id, ","',
            $this->pictureTable . '.title, ","',
            $this->pictureTable . '.info, ","',
            $this->pictureTable . '.readable_date, ","',
            $this->pictureTable . '.created_at, ","',
            $this->pictureTable . '.updated_at',
        ];
        $prepare = $this->db->prepare(" SELECT $this->table.*,$this->pictureTable.* FROM $this->table
        LEFT JOIN (SELECT $this->pictureTable.album_id,GROUP_CONCAT($this->pictureTable.title) AS pictures
        FROM $this->pictureTable
        GROUP BY $this->pictureTable.album_id) $this->pictureTable ON $this->table.album_id = $this->pictureTable.album_id");
        $prepare->execute();
        return $prepare->fetchAll(\PDO::FETCH_OBJ);

    }

    /**
     * @param array $data
     * @return bool|mixed
     */
    public function create(array $data)
    {
        $prepare = $this->db->prepare("INSERT INTO $this->table SET title = :title ,slug = :slug , readable_date = :readable_date");
        $prepare->bindValue(':title', $data['title']);
        $prepare->bindValue(':slug', $data['slug']);
        $prepare->bindValue(':readable_date', $this->readableDate);

        $execute = $prepare->execute();
        return $execute;
    }

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */

    public function update(int $id, array $data)
    {
        $prepare = $this->db->prepare("UPDATE $this->table SET title = COALESCE(NULLIF (:title,''),title), slug = COALESCE(NULLIF(:slug,''),slug)  WHERE album_id = :album_id ");

        $prepare->bindValue(':title', isset($data['title']) ? $data['title'] : null);
        $prepare->bindValue(':slug', isset($data['slug']) ? $data['slug'] : null);
        $prepare->bindValue(':album_id', $id);

        $execute = $prepare->execute();
        return $execute;
    }

    /**
     * @param mixed ...$id
     * @return bool|mixed
     */

    public function destroy(...$id)
    {
        $ids = implode(',', $id);
        $prepare = $this->db->prepare("DELETE FROM $this->table WHERE album_id IN ($ids)");
        $execute = $prepare->execute();
        return $execute;
    }
}