<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'travel_id', 'external_reference',
        'order_code', 'init_point', 'payed'
    ];

    /*****************************************************
     * Relationships:
     *****************************************************/

    //1:1
    public function travel()
    {
        return $this->belongsTo('App\Travel');
    }
}
