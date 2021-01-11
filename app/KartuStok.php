<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KartuStok extends Model
{
    protected $table= 'kartu_stok';
    protected $fillable= ['id','obat_id', 'date','stock_awal','masuk','keluar','sisa'];
}
