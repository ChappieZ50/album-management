<?php

namespace App\Pictures;


interface PicturesInterface
{
    public function __construct(\PDO $db);

    public function create(array $data, int $id);

    public function update(int $id, array $data);

    public function destroy(...$id);

    public function defaultRecord();

    public function existsAlbum($id = null, $slug = null);
}