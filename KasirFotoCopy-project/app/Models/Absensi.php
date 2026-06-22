<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'user_absensi'; 
    protected $fillable = ['user_id', 'tanggal', 'jam_masuk', 'jam_keluar'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}