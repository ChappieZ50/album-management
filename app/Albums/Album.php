<?php

namespace App\Albums;


class Album implements AlbumInterface
{
    /**
     * @var null
     * Database
     */
    private $db;

    /**
     * @var null
     * Table
     */
    private $table;
    /**
     * @var string
     * Date format for readable_date column in tables
     */
    private $dateFormat = 'j F Y';
    /**
     * @var string
     * Language
     */
    protected $lang = 'tr';

    /**
     * Album constructor.
     * @param $db
     * @param $table
     */
    public function __construct(\PDO $db, $table)
    {
        $this->db = $db;
        $this->table = $table;
    }

    /**
     * @param array $data
     * @return bool|mixed
     */
    public function create(array $data)
    {
        $prepare = $this->db->prepare("INSERT INTO rix_albums SET title = ? ,slug = ? , readable_date = ?");
        $execute = $prepare->execute([
            $data['title'],
            $data['slug'],
            $this->createReadableDate()
        ]);
        return $execute;
    }

    /**
     * @param int $id
     * @param array $data
     * @return mixed|void
     */
    public function update(int $id, array $data)
    {

    }

    /**
     * @param $ids
     * @return mixed|void
     */
    public function destroy($ids)
    {

    }

    public function createReadableDate()
    {
        $this->dateFormat = $this->lang === 'tr' ? $this->dateFormat : 'F j Y';
        $date = date($this->dateFormat, strtotime(date("Y/m/d")));
        if ($this->lang === 'tr') {
            $months = array(
                'January'   => 'Ocak',
                'February'  => 'Şubat',
                'March'     => 'Mart',
                'April'     => 'Nisan',
                'May'       => 'Mayıs',
                'June'      => 'Haziran',
                'July'      => 'Temmuz',
                'August'    => 'Ağustos',
                'September' => 'Eylül',
                'October'   => 'Ekim',
                'November'  => 'Kasım',
                'December'  => 'Aralık',
            );
            foreach ($months as $en => $tr)
                $date = str_replace($en, $tr, $date);
        }
        return $date;
    }
}