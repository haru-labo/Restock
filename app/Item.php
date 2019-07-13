<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = array('id');
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'dateopen',
        'datelastopen'
    ];

    public static $rules = array(
        'category' => 'required',
        'name' => 'required',
        'stock' => 'required|integer|min:0|max:999',
        'dateopen' => 'required|date_format:"Y-m-d"',
        'datelastopen' => 'required|date_format:"Y-m-d"'
    );

    public function getDayPerStock()
    {
        return $this->dateopen->diffInDays($this->datelastopen);
    }

    public function toDatelastopen($item)
    {
        $oldDateopen = $item->dateopen;
        $item->datelastopen = $oldDateopen;
        return $item;
    }

    public function toYMD($targetDate)
    {
        return $targetDate->format('Y-m-d');
    }

    //$items = Item::All();
}
