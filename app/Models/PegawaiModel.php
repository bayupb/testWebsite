<?php

namespace App\Models;

use App\Models\AgamaModel;
use App\Models\JabatanModel;
use App\Models\GolonganModel;
use App\Models\PenempatanModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PegawaiModel extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $fillable = [
        'gambar_pegawai','nip_pegawai', 'nama_pegawai' , 'tempat_lahir_pegawai', 'alamat_pegawai', 'eselon',
        'tanggal_lahir_pegawai' , 'jenis_kelamin_pegawai', 'id_golongan', 'id_penempatan' , 'id_agama' , 'jabatan_id',
        'no_hp', 'npwp', 'unit_kerja'
    ];

    public function golongan(){
        return $this->belongsTo(GolonganModel::class , 'id_golongan', 'id');
    }
    public function agama(){
        return $this->belongsTo(AgamaModel::class , 'id_agama', 'id');
    }
    public function jabatan(){
        return $this->belongsTo(JabatanModel::class , 'jabatan_id', 'id');
    }
    public function penempatan(){
        return $this->belongsTo(PenempatanModel::class , 'id_penempatan', 'id');
    }

    public function scopeGetdata($query){
        $query->latest();
    }

    // public function scopeFilter($query){
    //     $query->orderBy('desc');
    // }
}
