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
use Session;

class AdminController extends Controller {

  public function index() {
    $data_profil = Profil::where('user_id',  Session::get('loginId'))->with('user', 'kota', 'kecamatan')->first();
    $data_profil_latest = Profil::orderBy('profil_id', 'DESC')->first();
    $data_kota = Kota::orderBy('kota', 'ASC')->get();
    $data_kecamatan = Kecamatan::orderBy('kecamatan', 'ASC')->get();
    // dd($data_profil);
    return view('admin.dashboard.index', compact('data_profil', 'data_profil_latest', 'data_kota', 'data_kecamatan'));
  }

  public function store(Request $request) {
    $data = new Profil;
    $data->profil_id = $request->profil_id;
    $data->user_id = Session::get('loginId');
    $data->tentang = $request->tentang;
    $data->alamat = $request->alamat;
    $data->kota_id = $request->kota;
    $data->kecamatan_id = $request->kecamatan;
    $data->kode_pos = $request->kode_pos;
    $data->save();
    $data = User::find(Session::get('loginId'));
    $data->profil_id = $request->profil_id;
    if($request->hasFile('foto_profil')) {
      $request->file('foto_profil')->move('user/', $request->file('foto_profil')->getClientOriginalName());
      $data->foto_profil = $request->file('foto_profil')->getClientOriginalName();
    }
    $data->save();
    return redirect('admin/')->with('success', 'Berhasil mengubah data.');
  }

  public function update(Request $request) {
    $data = Profil::where('user_id', Session::get('loginId'))->first();
    $data->tentang = $request->tentang;
    $data->alamat = $request->alamat;
    $data->kota_id = $request->kota;
    $data->kecamatan_id = $request->kecamatan;
    $data->kode_pos = $request->kode_pos;
    if($request->hasFile('foto_profil')) {
      $request->file('foto_profil')->move('user/', $request->file('foto_profil')->getClientOriginalName());
      $data->foto_profil = $request->file('foto_profil')->getClientOriginalName();
    }
    $data->save();
    return redirect('admin/')->with('success', 'Berhasil mengubah data.');
  }

}

?>