<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class member extends Model
{
    use HasFactory;
    protected $table = 'tb_member';

    protected $fillable = ['nama', 'telepon', 'alamat', 'email', 'jenis_kelamin'];

    
}
