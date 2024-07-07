<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Supplier;
use App\Models\Produk;
use App\Models\KategoriProduk;

class KategoriProdukController extends Controller {

  public function index() {
    $data = KategoriProduk::all();
    return view('admin.kategori_produk.index', compact('data'));
  }

  public function baru() {
    $data = new KategoriProduk;
    $keterangan = "baru";
    return view('admin.kategori_produk.cru', compact('data', 'keterangan'));
  }

  public function store(Request $request) {
    $data = new KategoriProduk;
    $data->kategori_produk = $request->kategori_produk;
    $data->sub_kategori_produk = $request->sub_kategori_produk;
    $data->save();
    return redirect('admin/kategori_produk')->with('success', 'Berhasil menambah data.');
  }

  public function edit($kategori_produk_id) {
    $data = KategoriProduk::find($kategori_produk_id);
    $keterangan = "edit";
    return view('admin.kategori_produk.cru', compact('data', 'keterangan'));
  }

  public function update(Request $request, $kategori_produk_id) {
    $data = KategoriProduk::find($kategori_produk_id);
    $data->kategori_produk = $request->kategori_produk;
    $data->sub_kategori_produk = $request->sub_kategori_produk;
    $data->save();
    return redirect('admin/kategori_produk')->with('success', 'Berhasil mengubah data.');
  }

  public function delete($kategori_produk_id) {
    $data = KategoriProduk::find($kategori_produk_id);
    $data_kategori_produk = Produk::where('kategori_produk_id', $kategori_produk_id)->count();
    if($data_kategori_produk > 0) {
      return redirect('admin/kategori_produk')->with('error', 'Tidak bisa menghapus data! Masih ada Produk yang bekategori '.$data->sub_kategori_produk);
    } else {
      $data->delete();
      return redirect('admin/kategori_produk')->with('success', 'Berhasil menghapus data.');
    }
  }

}

?>