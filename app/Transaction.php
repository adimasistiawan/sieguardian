<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';
    protected $fillable = ['no_transaction','user_id','date', 'total','status'];

    public function obat()
    {
        return $this->belongsTo('App\Obat','obat_id','id');
    }
    public function users()
    {
        return $this->belongsTo('App\User','user_id','id');    
    }
   
}
