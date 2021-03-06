<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'today', 'year', 'month','day','shop'
    ];

    public function datas()
    {
        return $this->hasMany('App\Data');
    }
}
