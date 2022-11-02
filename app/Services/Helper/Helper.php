<?php

namespace App\Services\Helper;

class Helper
{
    public static function getRelations($query)
    {
        if (!empty($query && $query['relations'])) return explode(',', $query['relations']);

        else return [];
    }
}
