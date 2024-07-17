<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solver extends Model
{
    use HasFactory;
    protected $table = "solver";
    protected $primaryKey = "solver_id";
    protected $guarded = [];
  
    public function user() {
      return $this->belongsTo('App\Models\User', 'user_id', 'user_id');
    }
    
    public function profil() {
      return $this->belongsTo('App\Models\Profil', 'profil_id', 'profil_id');
    }
}
