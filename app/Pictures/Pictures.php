<?php

namespace App\Pictures;


use App\Albums\Album;
use App\DatabaseAbstract;

class Pictures extends DatabaseAbstract implements PicturesInterface
{
    /**
     * If album won't created then created automatically uncategorized record
     * and picture will be attached to this album
     * @var string
     */
    protected $default = 'uncategorized';

    /**
     * @var string
     */
    protected $albumTable;

    public function __construct(\PDO $db, $table, $albumTable)
    {
        $this->albumTable = $albumTable;
        parent::__construct($db, $table);
        $this->defaultRecord();
    }

    /**
     * @param array $data
     * @param $id
     * @return bool|mixed
     */
    public function create(array $data, $id)
    {

        $prepare = $this->db->prepare("INSERT INTO $this->table SET album_id = :album_id, title = :title ,info = :info , readable_date = :readable_date");


        $prepare->bindValue(':album_id', $id);
        $prepare->bindValue(':title', $data['title']);
        $prepare->bindValue(':info', json_encode($data['info']));
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
        $prepare = $this->db->prepare("UPDATE $this->table SET title = COALESCE(NULLIF(:title, ''),title), info = COALESCE(NULLIF(:info, ''),info)   WHERE picture_id = :picture_id ");

        $prepare->bindValue(':title', isset($data['title']) ? $data['title'] : null);
        $prepare->bindValue(':info', isset($data['info']) ? json_encode($data['info']) : null);
        $prepare->bindValue(':picture_id', $id);


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
        $prepare = $this->db->prepare("DELETE FROM $this->table WHERE picture_id IN ($ids)");
        $execute = $prepare->execute();
        return $execute;
    }

    public function defaultRecord()
    {
        if (!$this->existsAlbum(null, $this->default)) {
            $album = new Album($this->db, $this->albumTable);
            return $album->create([
                    'title' => $this->default,
                    'slug'  => $this->default
                ]) ?? false;
        }
        return true;
    }

    /**
     * @param null $id
     * @param null $slug
     * @return array|bool
     */
    public function existsAlbum($id = null, $slug = null)
    {
        $prepare = $this->db->prepare("SELECT count(*) as count FROM $this->albumTable WHERE " . $id !== null ? "album_id = :value" : "slug = :value");
        $prepare->bindValue(':value', $id !== null ? $id : $slug);
        $prepare->execute();
        $count = $prepare->rowCount();
        return $count > 0 ?? true;
    }

}