<?php

namespace App\Albums;


class TestModel
{
    public $album_id, $title, $slug, $readable_date, $created_at, $updated_at, $picture_id, $info, $pictures;

    public function __construct()
    {
        $this->pictures = (object) [
            'picture_id' => $this->picture_id,
            'info' => $this->info
        ];
        unset($this->info);
        unset($this->picture_id);
    }
}