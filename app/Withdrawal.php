<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $table = 'withdrawal';

    protected $fillable = [
       'id','user_id', 'status', 'total'
  	];

  	public function user()
    {
    	return $this->belongsTo('App\User');
    }
}