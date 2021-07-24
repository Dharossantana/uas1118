<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
     protected $table = 'nilais';
    protected $primaryKey = 'id_nilai';
    protected $fillable = ['id_nis','id_mapel','nilai_akhir','keterangan'];

    public function Siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_nis');
        
    }

    public function Mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel');
        
    }

}
