<?php
ini_set('display_errors', E_ALL);

require_once __DIR__ . '/database.php';
require_once __DIR__ . '/vendor/autoload.php';

use App\Albums\Album;

$album = new Album($db, 'rix_albums');
dd($album->create([
    'title' => 'Title',
    'slug'  => 'title'
]));