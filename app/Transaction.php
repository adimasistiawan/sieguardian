<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';
    protected $fillable = ['obat_id','user_id','qty','date', 'total','status','sisa_stock'];

    public function obat()
    {
        return $this->belongsTo('App\Obat','obat_id','id');
    }
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');    
    }
}
