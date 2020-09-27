<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setoran extends Model
{
    protected $table = 'setoran';

    protected $fillable = [
       'id','user_id', 'jenis', 'kiloan','pendapatan','tanggal_setor','penyetor'
  	];

  	public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
