<?php

namespace App\Models;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jarak extends Eloquent {
  use HasFactory;

  protected $table = "jarak";
  protected $primaryKey = "jarak_id";
  
  public function supplier() {
    return $this->belongsTo('App\Models\Supplier', 'kecamatan_id', 'kecamatan_id');
  }

  public function asal_kecamatan() {
    return $this->belongsTo('App\Models\Kecamatan','asal_kecamatan','kecamatan_id');
  }

  public function tujuan_kecamatan() {
    return $this->belongsTo('App\Models\Kecamatan','tujuan_kecamatan','kecamatan_id');
  }

}

?>