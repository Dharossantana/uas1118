<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
 protected $table = 'mapels';
    protected $primaryKey = 'id_mapel';
    protected $fillable = ['guru','kelas','remidial','nama_mapel'];
}
