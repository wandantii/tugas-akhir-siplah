<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Supplier;
use App\Models\Produk;
use App\Models\SatuanProduk;

class SatuanProdukController extends Controller {

  public function index() {
    $data = SatuanProduk::orderBy('nama', 'ASC')->get();
    return view('admin.satuan_produk.index', compact('data'));
  }

  public function baru() {
    $data = new SatuanProduk;
    $keterangan = "baru";
    return view('admin.satuan_produk.cru', compact('data', 'keterangan'));
  }

  public function store(Request $request) {
    $data = new SatuanProduk;
    $data->nama = $request->nama;
    $data->save();
    return redirect('admin/satuanproduk')->with('success', 'Berhasil menambah data.');
  }

  public function edit($satuan_produk_id) {
    $data = SatuanProduk::find($satuan_produk_id);
    $keterangan = "edit";
    return view('admin.satuan_produk.cru', compact('data', 'keterangan'));
  }

  public function update(Request $request, $satuan_produk_id) {
    $data = SatuanProduk::find($satuan_produk_id);
    $data->nama = $request->nama;
    $data->save();
    return redirect('admin/satuanproduk')->with('success', 'Berhasil mengubah data.');
  }

  public function delete($satuan_produk_id) {
    $data = SatuanProduk::find($satuan_produk_id);
    $data_satuan_produk = Produk::where('satuan_produk_id', $satuan_produk_id)->count();
    if($data_satuan_produk > 0) {
      return redirect('admin/satuanproduk')->with('error', 'Tidak bisa menghapus data! Masih ada data Produk yang satuannya '.$data->nama);
    } else {
      $data->delete();
      return redirect('admin/satuanproduk')->with('success', 'Berhasil menghapus data.');
    }
  }

}

?>