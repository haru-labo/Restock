<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        'dateopen' => 'required|date_format:"Y-m-d"|after_or_equal:datelastopen',
        'datelastopen' => 'required|date_format:"Y-m-d"'
    );

    public function setDayPerStock()
    {
        return $this->fill(['dayperstock' => $this->dateopen->diffInDays($this->datelastopen)]);
    }

    public function setRemainingDays()
    {
        $dateDiff = $this->dateopen->addDay($this->dayperstock)->diffInDays(Carbon::now());
        if (Carbon::now()->lte($this->dateopen->addDay($this->dayperstock))) {
            $this['remainingdays'] = $dateDiff;
        } else {
            $this['remainingdays'] = 0;
        }
    }

    //$items = Item::All();
}
