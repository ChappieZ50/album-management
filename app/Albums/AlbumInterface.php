<?php

namespace App\Albums;


interface AlbumInterface
{

    public function get(string $sql = null);

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
     * @param mixed ...$id
     * @return mixed
     */
    public function destroy(...$id);


}