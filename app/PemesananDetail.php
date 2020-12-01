<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PemesananDetail extends Model
{
    protected $table = 'pemesanan_detail';
    protected $fillable = ['pemesanan_id','obat_id','qty','keterangan','sisa_stock'];
}
