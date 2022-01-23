<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
   
    use HasFactory;

    protected $table = 'tb_outlet';

    protected $fillable = ['nama', 'telepon', 'alamat'];

    public function paket() {
        return $this->hasMany(Paket::class, 'id_outlet');
    }

    public function user(){
        return $this->belongsToMany(User::class, 'tb_outlet_user', 'id_outlet', 'id_user')->withPivot('role');
    }
}
