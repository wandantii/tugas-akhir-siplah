<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Supplier;
use App\Models\Produk;
use App\Models\KategoriProduk;

class ProdukController extends Controller {

  public function index() {
    $data = Produk::orderBy('nama', 'ASC')->get();
    return view('admin.produk.index', compact('data'));
  }

  public function baru() {
    $data = new Produk;
    $keterangan = "baru";
    $data_kategori_produk = KategoriProduk::orderBy('kategori_produk', 'ASC')->get();
    $data_supplier = Supplier::with('kota', 'kecamatan')->orderBy('nama', 'ASC')->get();
    return view('admin.produk.cru', compact('data', 'keterangan', 'data_kategori_produk', 'data_supplier'));
  }

  public function store(Request $request) {
    $data_supplier = Supplier::with('kota', 'kecamatan')->where('supplier_id', $request->supplier)->first();
    $data = new Produk;
    $data->nama = $request->nama;
    $data->supplier_id = $request->supplier;
    $data->kota_id = $data_supplier->kota->kota_id;
    $data->kecamatan_id = $data_supplier->kecamatan->kecamatan_id;
    $data->kategori_produk_id = $request->kategori_produk;
    $data->harga = $request->harga;
    $data->url = $request->url;
    $data->jumlah_terjual = $request->jumlah_terjual;
    $data->rating = $request->rating;
    if($request->hasFile('foto_produk')) {
      $request->file('foto_produk')->move('produk/', $request->file('foto_produk')->getClientOriginalName());
      $data->foto_produk = $request->file('foto_produk')->getClientOriginalName();
    }
    $data->save();
    return redirect('admin/produk')->with('success', 'Berhasil menambah data.');
  }

  public function edit($produk_id) {
    $data = Produk::find($produk_id);
    $keterangan = "edit";
    $data_kategori_produk = KategoriProduk::orderBy('kategori_produk', 'ASC')->get();
    $data_supplier = Supplier::with('kota', 'kecamatan')->orderBy('nama', 'ASC')->get();
    return view('admin.produk.cru', compact('data', 'keterangan', 'data_kategori_produk', 'data_supplier'));
  }

  public function update(Request $request, $produk_id) {
    $data_supplier = Supplier::with('kota', 'kecamatan')->where('supplier_id', $request->supplier)->first();
    $data = Produk::find($produk_id);
    $data->nama = $request->nama;
    $data->supplier_id = $request->supplier;
    $data->kota_id = $data_supplier->kota->kota_id;
    $data->kecamatan_id = $data_supplier->kecamatan->kecamatan_id;
    $data->kategori_produk_id = $request->kategori_produk;
    $data->harga = $request->harga;
    $data->url = $request->url;
    $data->jumlah_terjual = $request->jumlah_terjual;
    $data->rating = $request->rating;
    if($request->hasFile('foto_produk')) {
      $request->file('foto_produk')->move('produk/', $request->file('foto_produk')->getClientOriginalName());
      $data->foto_produk = $request->file('foto_produk')->getClientOriginalName();
    }
    $data->save();
    return redirect('admin/produk')->with('success', 'Berhasil mengubah data.');
  }

  public function delete($produk_id) {
    $data = Produk::find($produk_id);
    $data->delete();
    return redirect('admin/produk')->with('success', 'Berhasil menghapus data.');
  }

}

?>