<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Supplier;

class APIController extends Controller {

  public function kota() {
    $data = Kota::where('kota', 'LIKE', '%'.request('q').'%')->paginate(10);
    return response()->json($data);
  }

  public function kecamatan(Request $request) {
    $kota_id = $request->kota_id;
    $data_kecamatan = Kecamatan::where('kota_id', $kota_id)->get();
    foreach($data_kecamatan as $kecamatan) {
      echo "<option value='$kecamatan->kecamatan_id'>$kecamatan->kecamatan</option>";
    }
  }

}

?>