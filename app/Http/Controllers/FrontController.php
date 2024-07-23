<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Alternatif;
use App\Models\Kecamatan;
use App\Models\KategoriProduk;
use App\Models\SatuanProduk;
use App\Models\Kota;
use App\Models\User;
use App\Models\Profil;
use App\Models\Solver;
use Session;

class FrontController extends Controller {

  public function dashboard() {
    return view('front.home.index');
  }

  public function profil() {
    $data_user = User::where('user_id',  Session::get('loginId'))->first();
    $data_profil = Profil::with('user', 'kota', 'kecamatan')->where('user_id',  Session::get('loginId'))->first();
    $data_profil_latest = Profil::orderBy('profil_id', 'DESC')->first();
    $data_kota = Kota::orderBy('kota', 'ASC')->get();
    $data_kecamatan = Kecamatan::orderBy('kecamatan', 'ASC')->get();
    
    return view('front.profil.index', compact('data_profil', 'data_user', 'data_profil_latest', 'data_kota', 'data_kecamatan'));
  }

  public function store(Request $request) {
    $data = new Profil;
    $data->user_id = Session::get('loginId');
    $data->tentang = $request->tentang;
    $data->nomor_telepon = $request->nomor_telepon;
    $data->alamat = $request->alamat;
    $data->kota_id = $request->kota;
    $data->kecamatan_id = $request->kecamatan;
    $data->kode_pos = $request->kode_pos;
    if($request->hasFile('foto_profil')) {
      $request->file('foto_profil')->move('user/', $request->file('foto_profil')->getClientOriginalName());
      $data->foto_profil = $request->file('foto_profil')->getClientOriginalName();
    }
    $data->save();

    $get = Profil::where('user_id', Session::get('loginId'))->first();
    $user = User::find(Session::get('loginId'));
    $user->profil_id = $get->profil_id;
    $user->save();
    
    return redirect('profil')->with('success', 'Berhasil mengubah data.');
  }

  public function update(Request $request) {
    $data = Profil::where('user_id', Session::get('loginId'))->first();
    $data->tentang = $request->tentang;
    $data->nomor_telepon = $request->nomor_telepon;
    $data->alamat = $request->alamat;
    $data->kota_id = $request->kota;
    $data->kecamatan_id = $request->kecamatan;
    $data->kode_pos = $request->kode_pos;
    if($request->hasFile('foto_profil')) {
      $request->file('foto_profil')->move('user/', $request->file('foto_profil')->getClientOriginalName());
      $data->foto_profil = $request->file('foto_profil')->getClientOriginalName();
    }
    $data->save();
    return redirect('profil')->with('success', 'Berhasil mengubah data.');
  }

  public function metode() {
    $data_kategori_produk = KategoriProduk::orderBy('kategori_produk', 'ASC')->get();
    $data_satuan_produk = SatuanProduk::orderBy('nama', 'ASC')->get();
    $solver = Solver::where('user_id', Session::get('loginId'))->first();
    return view('front.metode.index', compact(
      'solver', 'data_kategori_produk', 'data_satuan_produk'
    ));
  }

}

?>