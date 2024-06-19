<?php

namespace App\Models;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Eloquent {
  use HasFactory;

  protected $table = "kecamatan";
  protected $primaryKey = "kecamatan_id";

}

?>