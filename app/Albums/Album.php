<?php

namespace App\Albums;


use App\DatabaseAbstract;

class Album extends DatabaseAbstract implements AlbumInterface
{

    /**
     * @param array $data
     * @return bool|mixed
     */
    public function create(array $data)
    {
        $readableDate = isset($data['readable_date']) ? $data['readable_date'] : $this->readableDate;

        $prepare = $this->db->prepare("INSERT INTO $this->table SET title = :title ,slug = :slug , readable_date = :readable_date");
        $prepare->bindParam(':title', $data['title']);
        $prepare->bindParam(':slug', $data['slug']);
        $prepare->bindParam(':readable_date', $readableDate);

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
        $prepare = $this->db->prepare("UPDATE $this->table SET title = :title ,slug = :slug   WHERE album_id = :album_id ");

        $prepare->bindParam(':title', $data['title']);
        $prepare->bindParam(':slug', $data['slug']);
        $prepare->bindParam(':album_id', $id);

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

    /**
     * @param $id
     * @return mixed
     */
    public function existsAlbum($id){}
}