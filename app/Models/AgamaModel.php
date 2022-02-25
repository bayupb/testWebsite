<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AgamaModel extends Model
{
    use HasFactory;

    protected $table = 'agama';
    protected $fillable = ['nama_agama'];

    public function scopeGetdata($query){
        $query->latest();
    }
    // public function scopeSearch($query){
    //     $query->where('nama_agama', 'LIKE' , '%' . $this->search . '%')->paginate(5);
    // }

}
