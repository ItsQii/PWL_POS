<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelModel extends Model
{
    use HasFactory;

    protected $table = 'level'; // Sesuaikan dengan nama tabel di database
    protected $primaryKey = 'id'; // Sesuaikan dengan primary key tabel
    public $timestamps = false; // Jika tidak ada `created_at` & `updated_at`
}
