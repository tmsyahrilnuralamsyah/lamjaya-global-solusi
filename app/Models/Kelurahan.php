<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    protected $table = "kelurahan";
    protected $fillable = ['nama', 'id_kecamatan'];

    public function kecamatan()
    {
        return $this->belongsTo('App\Models\Kecamatan');
    }
}
