<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accounting extends Model
{
	protected $table = "accounting";

    protected $fillable = [
        'id_user', 'id_kategori', 'jumlah_sampah', 'disetor', 'tanggal_sampah',
    ];
}
