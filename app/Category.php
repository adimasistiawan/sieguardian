<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //mendefinisikan nama tabel
    protected $table= 'category';
    //menentukan filed atau data mana saja yang boleh kita insert ke database
    protected $fillable= ['name'];

    public function obat()
    {
        return $this->hasMany('App\Obat');
    }
}
