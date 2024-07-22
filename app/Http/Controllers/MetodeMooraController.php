<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Supplier;
use App\Models\Solver;
use App\Models\Profil;
use App\Models\Jarak;
use App\Models\Produk;
use Session;

class MetodeMooraController extends Controller {

  public function index() {
    $data_solver = Solver::where('user_id', Session::get('loginId'))->first();
    $message = array();

    if(!isset($data_solver)) {
      $message['data_solver'] = "Ups! Mohon maaf. Silahkan isikan data Metode BWM terlebih dahulu sesuai prosedur perhitungan pada sistem, agar mendapatkan hasil (output) alternatif yang sesuai. Terima kasih.";
    }
    
    if(str_contains(url()->current(), 'admin')) {
      return view('admin.metode_moora.index', compact(
        'data_solver', 'message'
      ));
    } else {
      return view('front.hasil.index', compact(
        'data_solver', 'message'
      ));
    }
  }

  public function searchPost(Request $request) {
    // GET Data General
    $data_kriteria = Kriteria::get();
    $searchProduk = $request->querysearch;
    $data_solver = Solver::where('user_id', Session::get('loginId'))->first();
    $data_profil = Profil::where('user_id', Session::get('loginId'))->first();
    $kota_user = $data_profil->kota_id;
    $kecamatan_user = $data_profil->kecamatan_id;
    
    
    // Get data PRODUK
    $data_produk = Produk::with('supplier', 'kategori_produk')
                    ->where('nama', 'LIKE', "%$searchProduk%")
                    ->where('kota_id', $kota_user)
                    ->orderBy('harga', 'ASC')
                    ->get();
    $data_supplier = Produk::where('nama', 'LIKE', "%$searchProduk%")
                      ->where('kota_id', $kota_user)
                      ->groupBy('supplier_id')
                      ->get('supplier_id');
    $data_jarak = array();

    
    $nm_pembagi = array();
    $nm_harga = array();
    $nm_jarak = array();
    $nm_rating = array();
    $nm_jt = array();
    $array_nilai_jarak = array();
    $array_nilai_harga = array();
    $array_nilai_rating = array();
    $array_nilai_jt = array();
    $bagi_nilai_jarak = 0;
    $bagi_nilai_harga = 0;
    $bagi_nilai_rating = 0;
    $bagi_nilai_jt = 0;

    $op_harga = array();
    $op_jarak = array();
    $op_rating = array();
    $op_jt = array();
    $optimasi_harga = 0;
    $optimasi_jarak = 0;
    $optimasi_rating = 0;
    $optimasi_jt = 0;

    $rank = array();
    $rank_sorted = array();
    $pesan = '';
    $message = array();

    if($data_produk->count() == 0) {
      $message['data_produk'] = "Mohon maaf, data tidak ditemukan.";
    } else {
      // Get data JARAK dan Menentukan nilai jarak
      foreach($data_produk as $key=>$produk) {
        $get_location_supplier = $produk->kecamatan_id;
        $get_jarak = Jarak::where('tujuan_kota', '=', $kota_user)
                      ->where('tujuan_kecamatan', '=', $kecamatan_user)
                      ->where('asal_kecamatan', '=', $get_location_supplier)
                      ->first();
        $data_jarak[] = $get_jarak;
        $produk->jarak = $get_jarak;
      }


      // START : Proses Perhitungan

      // Normalisasi Matriks
      foreach($data_produk as $key=>$produk) {
        $pangkat_nilai_jarak = pow($produk->jarak->jarak, 2);   // Memangkatkan nilai jarak
        $pangkat_nilai_harga = pow($produk->harga, 2);          // Memangkatkan nilai harga
        $pangkat_nilai_rating = pow($produk->rating, 2);        // Memangkatkan nilai rating
        $pangkat_nilai_jt = pow($produk->jumlah_terjual, 2);                // Memangkatkan nilai jumlah terjual
        $array_nilai_jarak[] = $pangkat_nilai_jarak;
        $array_nilai_harga[] = $pangkat_nilai_harga;
        $array_nilai_rating[] = $pangkat_nilai_rating;
        $array_nilai_jt[] = $pangkat_nilai_jt;
      }
      $bagi_nilai_jarak = sqrt(array_sum($array_nilai_jarak));        // Menjumlah seruh nilai dan diakar
      $bagi_nilai_harga = sqrt(array_sum($array_nilai_harga));        // Menjumlah seruh nilai dan diakar
      $bagi_nilai_rating = sqrt(array_sum($array_nilai_rating));      // Menjumlah seruh nilai dan diakar
      $bagi_nilai_jt = sqrt(array_sum($array_nilai_jt));              // Menjumlah seruh nilai dan diakar
      $nm_pembagi = [$bagi_nilai_jarak, $bagi_nilai_harga, $bagi_nilai_rating, $bagi_nilai_jt];
      
      foreach($data_kriteria as $key=>$kriteria) {
        if($kriteria->kriteria_id == 1 && $kriteria->nama == $data_solver->c1) {
          foreach($data_produk as $key=>$produk) {
            $normalisasi_harga = $produk->harga/$bagi_nilai_harga;
            $nm_harga[] = $normalisasi_harga;
            $produk->nm_harga = $normalisasi_harga;
          }
        } else {
          $message['error_c1'] = "Mohon maaf, sistem menemukan adanya perbedaan kriteria C1 yang diinputkan melalui Excel.";
        }

        if(($kriteria->kriteria_id == 2) && ($kriteria->nama == $data_solver->c2)) {
          foreach($data_produk as $key=>$produk) {
            $normalisasi_jarak = $produk->jarak->jarak/$bagi_nilai_jarak;
            $nm_jarak[] = $normalisasi_jarak;
            $produk->nm_jarak = $normalisasi_jarak;
          }
        } else {
          $message['error_c2'] = "Mohon maaf, sistem menemukan adanya perbedaan kriteria C2 yang diinputkan melalui Excel.";
        }
        
        if(($kriteria->kriteria_id == 3) && ($kriteria->nama == $data_solver->c3)) {
          foreach($data_produk as $key=>$produk) {
            $normalisasi_rating = $produk->rating/$bagi_nilai_rating;
            $nm_rating[] = $normalisasi_rating;
            $produk->nm_rating = $normalisasi_rating;
          }
        } else {
          $message['error_c3'] = "Mohon maaf, sistem menemukan adanya perbedaan kriteria C3 yang diinputkan melalui Excel.";
        }
        
        if(($kriteria->kriteria_id == 4) && ($kriteria->nama == $data_solver->c4)) {
          foreach($data_produk as $key=>$produk) {
            $normalisasi_jt = $produk->jumlah_terjual/$bagi_nilai_jt;
            $nm_jt[] = $normalisasi_jt;
            $produk->nm_jt = $normalisasi_jt;
          }
        } else {
          $message['error_c4'] = "Mohon maaf, sistem menemukan adanya perbedaan kriteria C4 yang diinputkan melalui Excel.";
        }
      }
      

      // Optimasi Nilai Atribut
      foreach($data_kriteria as $key=>$kriteria) {
        if(($kriteria->kriteria_id == 1) && ($kriteria->nama == $data_solver->c1)) {
          foreach($data_produk as $key=>$produk) {
            $optimasi_harga =  ($produk->harga/$bagi_nilai_harga)*$data_solver->weight_c1;
            $op_harga[] = $optimasi_harga;
            $produk->op_harga = $optimasi_harga;
          }
        } else {
          $message['error_c1'] = "Mohon maaf, sistem menemukan adanya perbedaan kriteria C1 yang diinputkan melalui Excel.";
        }

        if(($kriteria->kriteria_id == 2) && ($kriteria->nama == $data_solver->c2)) {
          foreach($data_produk as $key=>$produk) {
            $optimasi_jarak = ($produk->jarak->jarak/$bagi_nilai_jarak)*$data_solver->weight_c2;
            $op_jarak[] = $optimasi_jarak;
            $produk->op_jarak = $optimasi_jarak;
          }
        } else {
          $message['error_c2'] = "Mohon maaf, sistem menemukan adanya perbedaan kriteria C2 yang diinputkan melalui Excel.";
        }
        
        if(($kriteria->kriteria_id == 3) && ($kriteria->nama == $data_solver->c3)) {
          foreach($data_produk as $key=>$produk) {
            $optimasi_rating = ($produk->rating/$bagi_nilai_rating)*$data_solver->weight_c3;
            $op_rating[] = $optimasi_rating;
            $produk->op_rating = $optimasi_rating;
          }
        } else {
          $message['error_c3'] = "Mohon maaf, sistem menemukan adanya perbedaan kriteria C3 yang diinputkan melalui Excel.";
        }
        
        if(($kriteria->kriteria_id == 4) && ($kriteria->nama == $data_solver->c4)) {
          foreach($data_produk as $key=>$produk) {
            $optimasi_jt = ($produk->jumlah_terjual/$bagi_nilai_jt)*$data_solver->weight_c4;
            $op_jt[] = $optimasi_jt;
            $produk->op_jt = $optimasi_jt;
          }
        } else {
          $message['error_c4'] = "Mohon maaf, sistem menemukan adanya perbedaan kriteria C4 yang diinputkan melalui Excel.";
        }
      }


      // Menentukan Nilai Yi(Max-Min)
      $max = 0;
      $min = 0;
      foreach($data_produk as $key=>$produk) {
        foreach($data_kriteria as $key=>$kriteria) {
          if($kriteria->kriteria_id == 1 && $kriteria->nama == $data_solver->c1 && $data_solver->type_c1 == 'Benefit') {
            $max = +$produk->op_harga;
          } else if($kriteria->kriteria_id == 1 && $kriteria->nama == $data_solver->c1 && $data_solver->type_c1 == 'Cost') {
            $min = +$produk->op_harga;
          }

          if($kriteria->kriteria_id == 2 && $kriteria->nama == $data_solver->c2 && $data_solver->type_c2 == 'Benefit') {
            $max = +$produk->op_jarak;
          } else if($kriteria->kriteria_id == 2 && $kriteria->nama == $data_solver->c2 && $data_solver->type_c2 == 'Cost') {
            $min = +$produk->op_jarak;
          }

          if($kriteria->kriteria_id == 3 && $kriteria->nama == $data_solver->c3 && $data_solver->type_c3 == 'Benefit') {
            $max = +$produk->op_rating;
          } else if($kriteria->kriteria_id == 3 && $kriteria->nama == $data_solver->c3 && $data_solver->type_c3 == 'Cost') {
            $min = +$produk->op_rating;
          }

          if($kriteria->kriteria_id == 4 && $kriteria->nama == $data_solver->c4 && $data_solver->type_c4 == 'Benefit') {
            $max = +$produk->op_jt;
          } else if($kriteria->kriteria_id == 4 && $kriteria->nama == $data_solver->c4 && $data_solver->type_c4 == 'Cost') {
            $min = +$produk->op_jt;
          }
        }
        $produk->max = $max;
        $produk->min = $min;
        $produk->maxmin = $max-$min;

        $rank[] = [$produk->produk_id, $max-$min];
      }


      // Menentukan Rank
      foreach($data_produk as $key=>$produk) {
        $array_maxmin = array();
        foreach ($rank as $key => $row) {
          $array_maxmin[$key] = $row[1];
        }
        array_multisort($array_maxmin, SORT_DESC, $rank);
        
        foreach($rank as $key=>$value) {
          if($value[0] == $produk->produk_id) {
            $produk->rank = $key+1;
          }
        }
      }
      
      $rank_sorted = $data_produk->sortBy('rank')->groupBy('supplier.supplier_id');
    }
    // END : Proses Perhitungan
    // dd($rank_sorted);
    // foreach($data_produk as $produk) {
    //   echo $produk->jarak->jarak." ";
    // }
    // dd($data_produk);
    
    
    if(str_contains(url()->current(), 'admin')) {
      return view('admin.metode_moora.index', compact(
        'data_produk', 'data_kriteria', 'rank', 'rank_sorted', 'searchProduk', 'data_supplier', 'message', 'data_solver',
        'bagi_nilai_jarak', 'bagi_nilai_harga', 'bagi_nilai_rating', 'bagi_nilai_jt'
      ));
    } else {
      return view('front.hasil.index', compact(
        'data_produk', 'data_kriteria', 'rank', 'rank_sorted', 'searchProduk', 'data_supplier', 'message', 'data_solver',
        'bagi_nilai_jarak', 'bagi_nilai_harga', 'bagi_nilai_rating', 'bagi_nilai_jt'
      ));
    }
  }

}

?>