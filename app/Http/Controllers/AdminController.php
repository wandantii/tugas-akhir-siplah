<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Supplier;
use App\Models\Kecamatan;
use App\Models\Kota;
use App\Models\User;
use App\Models\Profil;

class AdminController extends Controller {

  public function index() {
    $data_user = User::where('user_id', auth()->user()->user_id)->first();
    $data_profil = Profil::where('user_id', auth()->user()->user_id)->first();
    $data_profil_latest = Profil::orderBy('profil_id', 'DESC')->first();
    $data_kota = Kota::orderBy('kota', 'ASC')->get();
    $data_kecamatan = Kecamatan::orderBy('kecamatan', 'ASC')->get();
    return view('admin.dashboard.index', compact('data_user', 'data_profil', 'data_profil_latest', 'data_kota', 'data_kecamatan'));
  }

  public function store(Request $request) {
    $data = new Profil;
    $data->profil_id = $request->profil_id;
    $data->user_id = auth()->user()->user_id;
    $data->tentang = $request->tentang;
    $data->alamat = $request->alamat;
    $data->kota_id = $request->kota;
    $data->kecamatan_id = $request->kecamatan;
    $data->kode_pos = $request->kode_pos;
    $data->save();
    $data = User::find(auth()->user()->user_id);
    $data->profil_id = $request->profil_id;
    $data->save();
    return redirect('admin/')->with('success', 'Berhasil mengubah data.');
  }

  public function update(Request $request) {
    $data = Profil::where('user_id', auth()->user()->user_id)->first();
    $data->tentang = $request->tentang;
    $data->alamat = $request->alamat;
    $data->kota_id = $request->kota;
    $data->kecamatan_id = $request->kecamatan;
    $data->kode_pos = $request->kode_pos;
    $data->save();
    return redirect('admin/')->with('success', 'Berhasil mengubah data.');
  }

}

?>