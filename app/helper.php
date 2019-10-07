<?php

if (!function_exists('readableDate')) {
    /**
     * @param array $options ['date_format','lang']
     * @return false|mixed|string
     */

    function readableDate($options = [])
    {
        /**
         * @var $date_format
         * @var $lang
         */
        $default = [
            'date_format' => 'j F Y',
            'lang'        => 'tr'
        ];
        $options = array_merge($options, $default);
        extract($options);

        $date_format = $lang === 'tr' ? $date_format : 'F j Y';
        $date = date($date_format, strtotime(date("Y/m/d")));
        if ($lang === 'tr') {
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
            foreach ($months as $key => $value)
                $date = str_replace($key, $value, $date);
        }
        return $date;

    }
}
