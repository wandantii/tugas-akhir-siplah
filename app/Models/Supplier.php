<?php

namespace App\Models;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Eloquent {
  use HasFactory;

  protected $table = "supplier";
  protected $primaryKey = "supplier_id";

  public function kecamatan() {
    return $this->belongsTo('App\Models\Kecamatan', 'kecamatan_id', 'kecamatan_id');
  }

  public function kota() {
    return $this->belongsTo('App\Models\kota', 'kota_id', 'kota_id');
  }

  public function jarak() {
    return $this->hasMany('App\Models\Jarak', 'kecamatan_id', 'asal_kecamatan');
  }

  public function profil() {
    return $this->hasMany('App\Models\Profil', 'profil_id', 'profil_id');
  }
  
  
}

?>