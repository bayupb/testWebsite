<?php

namespace App\Models;

use App\Models\PegawaiModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GolonganModel extends Model
{
    use HasFactory;
    protected $table = 'golongan';
    protected $fillable = ['nama_golongan'];

    public function scopeGetdata($query){
        $query->latest();
    }

    public function pegawai(){
        return $this->hasMany(PegawaiModel::class, 'id_golongan' ,'id');
    }
}
