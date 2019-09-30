<?php

namespace App\Albums;


interface AlbumInterface
{
    /**
     * AlbumInterface constructor.
     * @param $db
     * @param $table
     */
    public function __construct(\PDO $db,$table);

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data);

    /**
     * @param $ids
     * @return mixed
     */
    public function destroy($ids);

}