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
        $prepare = $this->db->prepare("INSERT INTO $this->table SET title = :title ,slug = :slug , readable_date = :readable_date");
        $prepare->bindValue(':title', $data['title']);
        $prepare->bindValue(':slug', $data['slug']);
        $prepare->bindValue(':readable_date', isset($data['readable_date']) ? $data['readable_date'] : $this->readableDate);

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

        $prepare->bindValue(':title', $data['title']);
        $prepare->bindValue(':slug', $data['slug']);
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