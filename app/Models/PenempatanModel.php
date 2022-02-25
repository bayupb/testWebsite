<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenempatanModel extends Model
{
    use HasFactory;

    protected $table = 'penempatan';
    protected $fillable = ['nama_penempatan'];

    public function scopeGetdata($query){
        $query->latest();
    }
}
