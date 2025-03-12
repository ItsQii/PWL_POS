<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelModel extends Model
{
    use HasFactory;

    protected $table = 'm_level'; // Sesuaikan dengan nama tabel di database
    protected $primaryKey = 'level_id'; // Sesuaikan dengan primary key tabel
    protected $fillable = ['level_id', 'level_kode', 'level_nama']; // Jika tidak ada `created_at` & `updated_at`
}
