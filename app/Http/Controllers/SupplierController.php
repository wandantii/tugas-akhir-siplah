<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Alternatif;
use App\Models\Produk;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Supplier;

class SupplierController extends Controller {

  public function index() {
    $data = Supplier::with('kecamatan', 'kota')->orderBy('nama', 'ASC')->get();
    return view('admin.supplier.index', compact('data'));
  }

  public function baru() {
    $data = new Supplier;
    $data_kota = Kota::orderBy('kota', 'ASC')->get();
    $data_kecamatan = Kecamatan::orderBy('kecamatan', 'ASC')->get();
    $keterangan = "baru";
    return view('admin.supplier.cru', compact('data', 'keterangan', 'data_kota', 'data_kecamatan'));
  }

  public function store(Request $request) {
    $data = new Supplier;
    $data->nama = $request->nama;
    $data->rating = $request->rating;
    $data->jumlah_pesanan_selesai = $request->jumlah_pesanan_selesai;
    $data->instagram = $request->instagram;
    $data->ecommerce = $request->ecommerce;
    $data->nomor_telepon = $request->nomor_telepon;
    $data->kota_id = $request->kota;
    $data->kecamatan_id = $request->kecamatan;
    $data->alamat = $request->alamat;
    $data->kode_pos = $request->kode_pos;
    if($request->hasFile('logo')) {
      $request->file('logo')->move('supplier/', $request->file('logo')->getClientOriginalName());
      $data->logo = $request->file('logo')->getClientOriginalName();
    }
    $data->save();
    return redirect('admin/supplier')->with('success', 'Berhasil menambah data.');
  }

  public function edit($id_supplier) {
    $data = Supplier::find($id_supplier);
    $data_kota = Kota::orderBy('kota', 'ASC')->get();
    $data_kecamatan = Kecamatan::orderBy('kecamatan', 'ASC')->get();
    $keterangan = "edit";
    return view('admin.supplier.cru', compact('data', 'keterangan', 'data_kota', 'data_kecamatan'));
  }

  public function update(Request $request, $id_supplier) {
    $data = Supplier::find($id_supplier);
    $data->nama = $request->nama;
    $data->rating = $request->rating;
    $data->jumlah_pesanan_selesai = $request->jumlah_pesanan_selesai;
    $data->instagram = $request->instagram;
    $data->ecommerce = $request->ecommerce;
    $data->nomor_telepon = $request->nomor_telepon;
    $data->kota_id = $request->kota;
    $data->kecamatan_id = $request->kecamatan;
    $data->alamat = $request->alamat;
    $data->kode_pos = $request->kode_pos;
    if($request->hasFile('logo')) {
      $request->file('logo')->move('supplier/', $request->file('logo')->getClientOriginalName());
      $data->logo = $request->file('logo')->getClientOriginalName();
    }
    $data->save();
    return redirect('admin/supplier')->with('success', 'Berhasil mengubah data.');
  }

  public function delete($supplier_id ) {
    $data = Supplier::find($supplier_id);
    $data_satuan_produk = Produk::where('supplier_id', $supplier_id)->count();
    if($data_satuan_produk > 0) {
      return redirect('admin/supplier')->with('error', 'Tidak bisa menghapus data! Masih ada Produk yang berasal dari '.$data->nama);
    } else {
      $data->delete();
      return redirect('admin/supplier')->with('success', 'Berhasil menghapus data.');
    }
  }

}

?>