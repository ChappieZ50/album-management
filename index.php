<?php
ini_set('display_errors', E_ALL);

require_once __DIR__ . '/database.php';
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/vendor/autoload.php';

use App\Albums\Album;
use App\Pictures\Pictures;

$album = new Album($db);
dd($album->get());

/*dd($album->update(5,[
    'title' => 'Updated',
    'slug' => 'updated',
]));*/

/*dd($album->destroy());*/

/*$picture = new Pictures($db');
dd($picture->destroy(5,6));*/