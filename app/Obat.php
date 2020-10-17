<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    //mendefinisikan nama tabel
    protected $table= 'obat';
    //menentukan filed atau data mana saja yang boleh kita insert ke database
    protected $fillable= ['plu', 'name', 'slug','category','satuan','stock', 'price'];

    public function category()
    {
        return $this->belongsTo('App\Category');    
    }
    public function transaction()
    {
        return $this->hasMany('App\Transaction');    
    }
}
