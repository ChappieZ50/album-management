<?php
ini_set('display_errors', E_ALL);

require_once __DIR__ . '/database.php';
require_once __DIR__ . '/vendor/autoload.php';

use App\Albums\Album;
use App\Pictures\Pictures;
$album = new Album($db, 'rix_albums');
/*dd($album->create([
    'title' => 'Media',
    'slug'  => 'media'
]));*/
/*dd($album->update(5,[
    'title' => 'Updated',
    'slug' => 'updated',
]));*/
//dd($album->destroy());

$picture = new Pictures($db,'rix_pictures','rix_albums');
dd($picture->destroy(5,6));