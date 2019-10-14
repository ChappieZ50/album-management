<?php

namespace App;


abstract class DatabaseAbstract
{
    /**
     * @var null
     * Database
     */
    protected $db;

    /**
     * @var null
     * Table
     */
    protected $table;

    /**
     * @var false|mixed|string
     */
    protected $readableDate;

    public function __construct(\PDO $db)
    {
        $this->readableDate = readable_date();
        $this->db = $db;
    }

}