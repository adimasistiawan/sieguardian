<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';
    protected $fillable = ['obat_id','qty', 'total','status'];

    public function obat()
    {
        return $this->belongsTo('App\Obat','obat_id','id');
    }
}
