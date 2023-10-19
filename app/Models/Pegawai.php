<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = "pegawai";
    protected $fillable = ['nama','tl','tgl_l','jk','agama','alamat','kelurahan','kecamatan','provinsi'];
}
