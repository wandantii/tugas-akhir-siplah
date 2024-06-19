<?php

namespace App\Models;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Eloquent {
  use HasFactory;

  protected $table = "kota";
  protected $primaryKey = "kota_id";

}

?>