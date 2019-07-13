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

    //$items = Item::All();
}
