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
     * If you are using seconds or millisecond it will be wrong.
     * Because we define this variable in construct and when we use
     * class construct then will be get date info.
     * If you don't want use $this->readableDate then you can post date in data array. ['readable_date' => 'value']
     *
     * @var string
     *
     */
    protected $readableDate;

    /**
     * DatabaseAbstract constructor.
     * @param \PDO $db
     * @param $table
     */
    public function __construct(\PDO $db, $table)
    {
        $this->readableDate = readableDate();
        $this->db = $db;
        $this->table = $table;
    }

}