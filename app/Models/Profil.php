<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Profil extends Authenticatable
{
    use HasFactory;
    protected $table = "profil";
    protected $primaryKey = "profil_id";
  
    public function user() {
      return $this->belongsTo('App\Models\User', 'user_id', 'user_id');
    }

    public function kecamatan() {
      return $this->belongsTo('App\Models\Kecamatan', 'kecamatan_id', 'kecamatan_id');
    }
  
    public function kota() {
      return $this->belongsTo('App\Models\Kota', 'kota_id', 'kota_id');
    }

}
