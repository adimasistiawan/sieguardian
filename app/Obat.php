<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $table= 'obat';
    protected $fillable= ['id','plu', 'name','category_id','satuan','stock', 'price','status','empty_date'];

    public function category()
    {
        return $this->belongsTo('App\Category','category_id','id');    
    }
    public function transaction()
    {
        return $this->hasMany('App\Transaction');    
    }
}
