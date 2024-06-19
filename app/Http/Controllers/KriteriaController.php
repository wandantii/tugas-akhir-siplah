<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Supplier;

class KriteriaController extends Controller {
  
  public function index() {
    $data = Kriteria::get();
    return view('admin.kriteria.index', compact('data'));
  }

  public function baru() {
    $data = new Kriteria;
    $keterangan = "baru";
    return view('admin.kriteria.cru', compact('data', 'keterangan'));
  }

  public function detail($kriteria_id) {
    $data = Kriteria::find($kriteria_id);
    $keterangan = "detail";
    return view('admin.kriteria.cru', compact('data', 'keterangan'));
  }

  public function store(Request $request) {
    $data = new Kriteria;
    $data->nama   = $request->nama;
    $data->tipe   = $request->tipe;
    $data->bobot  = $request->bobot;
    $data->save();
    return redirect('admin/kriteria')->with('success', 'Berhasil menambah data.');
  }

  public function edit($kriteria_id) {
    $data = Kriteria::find($kriteria_id);
    $keterangan = "edit";
    return view('admin.kriteria.cru', compact('data', 'keterangan'));
  }

  public function update(Request $request, $kriteria_id) {
    $data = Kriteria::find($kriteria_id);
    $data->nama   = $request->nama;
    $data->tipe   = $request->tipe;
    $data->bobot  = $request->bobot;
    $data->save();
    return redirect('admin/kriteria')->with('success', 'Berhasil mengubah data.');
  }

  public function delete($kriteria_id) {
    $data = Kriteria::find($kriteria_id);
    $data->delete();
    return redirect('admin/kriteria')->with('success', 'Berhasil menghapus data.');
  }

}

?>