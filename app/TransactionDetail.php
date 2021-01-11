<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $table = 'transaction_detail';
    protected $fillable = ['transaction_id','obat_id','qty','price','sub_total'];
}
