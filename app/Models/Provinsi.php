<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $table = "provinsi";
    protected $fillable = ['nama'];

    public function kecamatan()
    {
        return $this->hasMany('App\Models\Kecamatan', 'id_kecamatan');
    }
}
