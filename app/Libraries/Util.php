<?php

namespace App\Libraries;

class Util
{

    /**
     * @param string $lang
     * @param $date
     * @return \DateTime|string
     * @throws \Exception
     */
    static function formatDate(?String $lang, ?String $date)
    {

        $dateFormat = new \DateTime($date);
        switch ($lang) {
            case "pt-br":
                $dateFormat = $dateFormat->format('d/m/Y H:i:s');
                break;
            default:
                $dateFormat = $dateFormat->format('Y-m-d H:i:s');
                break;
        }

        return $dateFormat;
    }
}
