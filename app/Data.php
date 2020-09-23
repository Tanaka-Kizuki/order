<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $fillable = [
        'order_id', 'name', 'count','total',
    ];

    public function order()
    {
        $this->belongsTo('App\Order');
    }
}
