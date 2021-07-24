<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
      protected $table = 'siswas';
    protected $primaryKey = 'id_nis';
    protected $fillable = ['nama_siswa','alamat','nama_orangtua','no_hp'];
}
