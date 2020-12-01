<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $table = 'pemesanan';
    protected $fillable = ['no_invoice','user_id','receive_date','date','status'];

    public function users()
    {
        return $this->belongsTo('App\User','user_id','id');    
    }
}
