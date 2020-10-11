<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WithdrawalTable extends Model
{
    protected $table = 'withdrawal';

    protected $fillable = [
       'id','user_id', 'jumlah_penarikan'
  	];

}