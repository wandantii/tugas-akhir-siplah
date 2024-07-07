<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory;
    protected $table = "user";
    protected $primaryKey = "user_id";
    protected $guarded = ['user_id'];
  
    public function profil() {
      return $this->belongsTo('App\Models\Profil', 'profil_id', 'profil_id');
    }

    public function kecamatan() {
      return $this->belongsTo('App\Models\Kecamatan', 'kecamatan_id', 'kecamatan_id');
    }
  
    public function kota() {
      return $this->belongsTo('App\Models\kota', 'kota_id', 'kota_id');
    }

}
