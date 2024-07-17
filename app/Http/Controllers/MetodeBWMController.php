<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Imports\SolverImport;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Supplier;
use App\Models\Profil;
use App\Models\Jarak;
use App\Models\Produk;
use App\Models\Solver;
use Session;

class MetodeBWMController extends Controller {

  public function index() {
    $solver = Solver::where('user_id', Session::get('loginId'))->first();
    
    return view('admin.metode_bwm.index', compact(
      'solver'
    ));
  }

  public function import_excel(Request $request) {
    $data = $request->file('solver');

    $namafile = Session::get('loginId')."_".$data->getClientOriginalName();
    $data->move('solver', $namafile);

    Excel::import(new SolverImport, \public_path('/solver/'.$namafile));
    return redirect()->back();
  }

  public function download_template() {
    return response()->download(storage_path('template\BWMSolver.xlsx'));
  }

}

?>