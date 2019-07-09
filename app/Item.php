<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $dateFormat = 'Y-m-d';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'dateopen',
        'datelastopen'
    ];


    public function getDayPerStock()
    {
        return $this->dateopen->diffInDays($this->datelastopen);
    }

    public function toYMD($targetDate)
    {
        return $targetDate->format('Y-m-d');
    }

    //$items = Item::All();
}
