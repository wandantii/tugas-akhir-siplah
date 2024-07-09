<?php

namespace App\Models;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Eloquent {
  use HasFactory;

  protected $table = "produk";
  protected $primaryKey = "produk_id";

  public function kategori_produk() {
    return $this->belongsTo('App\Models\KategoriProduk', 'kategori_produk_id', 'kategori_produk_id');
  }
  
  public function satuan_produk() {
    return $this->hasMany('App\Models\SatuanProduk', 'satuan_produk_id', 'satuan_produk_id');
  }

  public function supplier() {
    return $this->belongsTo('App\Models\Supplier', 'supplier_id', 'supplier_id');
  }
  
  public function jarak() {
    return $this->hasMany('App\Models\Jarak', 'asal_kecamatan', 'kecamatan_id');
  }
}

?>