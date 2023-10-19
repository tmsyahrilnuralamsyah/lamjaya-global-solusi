<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = "kecamatan";
    protected $fillable = ['nama', 'id_provinsi'];

    public function provinsi()
    {
        return $this->belongsTo('App\Models\Provinsi');
    }

    public function kelurahan()
    {
        return $this->hasMany('App\Models\Kelurahan', 'id_kelurahan');
    }
}
