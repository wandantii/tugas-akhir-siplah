<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Supplier;
use App\Models\Profil;
use App\Models\Jarak;
use App\Models\Produk;
use Session;

class MetodeMooraController extends Controller {

  public function index() {
    $kriteria = Kriteria::get();
    
    return view('admin.metode_moora.index', compact(
      'kriteria'
    ));
  }

  public function searchPost(Request $request) {
    // GET Data General
    $data_kriteria = Kriteria::get();
    $searchProduk = $request->querysearch;
    $searchProduk2 = preg_replace("/[^a-zA-Z0-9]+/", "", $searchProduk);
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

    
    if($data_produk->count() == 0) {
      $pesan = "Mohon maaf, data tidak ditemukan.";
    } else {
      // Get data JARAK dan Menentukan nilai jarak
      foreach($data_produk as $key=>$produk) {
        $get_location_supplier = $produk->kecamatan_id;
        $get_jarak = Jarak::where('tujuan_kota', '=', $kota_user)
                      ->where('tujuan_kecamatan', '=', $kecamatan_user)
                      ->where('asal_kecamatan', '=', $get_location_supplier)
                      ->first();
        if($get_jarak->jarak > 0 && $get_jarak->jarak <=10) {
          $get_jarak->nilai_jarak = 0.14;
        } else if($get_jarak->jarak > 10 && $get_jarak->jarak <=20) {
          $get_jarak->nilai_jarak = 0.28;
        } else if($get_jarak->jarak > 20 && $get_jarak->jarak <=30) {
          $get_jarak->nilai_jarak = 0.42;
        } else if($get_jarak->jarak > 30 && $get_jarak->jarak <=40) {
          $get_jarak->nilai_jarak = 0.56;
        } else if($get_jarak->jarak > 40 && $get_jarak->jarak <=50) {
          $get_jarak->nilai_jarak = 0.70;
        } else if($get_jarak->jarak > 50 && $get_jarak->jarak <=60) {
          $get_jarak->nilai_jarak = 0.84;
        } else if($get_jarak->jarak > 60 && $get_jarak->jarak <=70) {
          $get_jarak->nilai_jarak = 0.98;
        }
        $data_jarak[] = $get_jarak;
        $produk->jarak = $get_jarak;
      }
      

      // Menentukan nilai harga
      if($data_produk->count() == 1) {
        foreach($data_produk as $key=>$produk) {
          $produk->kategori_harga = "Rata-Rata";
          $produk->nilai_harga = 0.66;
        }
      } else if($data_produk->count() == 2) {
        $data_awal = $data_produk->take(1);
        $data_akhir = $data_produk->skip(1)->take(1);
        foreach($data_produk as $key=>$produk) {
          foreach($data_awal as $key=>$produk_awal) {
            if($produk->produk_id == $produk_awal->produk_id) {
              $produk->kategori_harga = "Murah";
              $produk->nilai_harga = 0.33;
            }
          }
          foreach($data_akhir as $key=>$produk_akhir) {
            if($produk->produk_id == $produk_akhir->produk_id) {
              $produk->kategori_harga = "Mahal";
              $produk->nilai_harga = 0.99;
            }
          }
        }
      } else if($data_produk->count() > 2) {
        $batas_harga = ceil($data_produk->count()/3);
        $data_awal = $data_produk->take($batas_harga);
        $data_tengah = $data_produk->skip($data_awal->count())->take($data_produk->count()-($data_awal->count()*2));
        $data_akhir = $data_produk->skip($data_awal->count()+$data_tengah->count())->take($batas_harga);
        foreach($data_produk as $key=>$produk) {
          foreach($data_awal as $key=>$produk_awal) {
            if($produk->produk_id == $produk_awal->produk_id) {
              $produk->kategori_harga = "Murah";
              $produk->nilai_harga = 0.33;
            }
          }
          foreach($data_tengah as $key=>$produk_tengah) {
            if($produk->produk_id == $produk_tengah->produk_id) {
              $produk->kategori_harga = "Rata-Rata";
              $produk->nilai_harga = 0.66;
            }
          }
          foreach($data_akhir as $key=>$produk_akhir) {
            if($produk->produk_id == $produk_akhir->produk_id) {
              $produk->kategori_harga = "Mahal";
              $produk->nilai_harga = 0.99;
            }
          }
        }
      }


      // Menentukan nilai rating supplier
      foreach($data_produk as $key=>$produk) {
        if($produk->supplier->rating > 0 && $produk->supplier-> rating <= 1) {
          $produk->nilai_rating = 0.2;
        } else if($produk->supplier->rating > 1 && $produk->supplier-> rating <= 2) {
          $produk->nilai_rating = 0.4;
        } else if($produk->supplier->rating > 2 && $produk->supplier-> rating <= 3) {
          $produk->nilai_rating = 0.6;
        } else if($produk->supplier->rating > 3 && $produk->supplier-> rating <= 4) {
          $produk->nilai_rating = 0.8;
        } else if($produk->supplier->rating > 4 && $produk->supplier-> rating <= 5) {
          $produk->nilai_rating = 1;
        }
      }
      

      // Menentukan nilai jumlah terjual
      if($data_produk->count() == 1) {
        foreach($data_produk as $key=>$produk) {
          $produk->kategori_jt = "Rata-Rata";
          $produk->nilai_jt = 0.66;
        }
      } else if($data_produk->count() == 2) {
        $data_awal = $data_produk->take(1);
        $data_akhir = $data_produk->skip(1)->take(1);
        foreach($data_produk as $key=>$produk) {
          foreach($data_awal as $key=>$produk_awal) {
            if($produk->produk_id == $produk_awal->produk_id) {
              $produk->kategori_jt = "Sedikit";
              $produk->nilai_jt = 0.33;
            }
          }
          foreach($data_akhir as $key=>$produk_akhir) {
            if($produk->produk_id == $produk_akhir->produk_id) {
              $produk->kategori_jt = "Banyak";
              $produk->nilai_jt = 0.99;
            }
          }
        }
      } else if($data_produk->count() > 2) {
        $batas_harga = ceil($data_produk->count()/3);
        $data_awal = $data_produk->take($batas_harga);
        $data_tengah = $data_produk->skip($data_awal->count())->take($data_produk->count()-($data_awal->count()*2));
        $data_akhir = $data_produk->skip($data_awal->count()+$data_tengah->count())->take($batas_harga);
        foreach($data_produk as $key=>$produk) {
          foreach($data_awal as $key=>$produk_awal) {
            if($produk->produk_id == $produk_awal->produk_id) {
              $produk->kategori_jt = "Sedikit";
              $produk->nilai_jt = 0.33;
            }
          }
          foreach($data_tengah as $key=>$produk_tengah) {
            if($produk->produk_id == $produk_tengah->produk_id) {
              $produk->kategori_jt = "Rata-Rata";
              $produk->nilai_jt = 0.66;
            }
          }
          foreach($data_akhir as $key=>$produk_akhir) {
            if($produk->produk_id == $produk_akhir->produk_id) {
              $produk->kategori_jt = "Banyak";
              $produk->nilai_jt = 0.99;
            }
          }
        }
      }

      // foreach($data_produk as $key=>$produk) {
      //   echo "<br>".$produk->nama." ".$produk->jarak->nilai_jarak." ".$produk->nilai_harga." ".$produk->nilai_rating." ".$produk->nilai_jt;
      // }



      // START : Proses Perhitungan

      // Normalisasi Matriks
      foreach($data_produk as $key=>$produk) {
        $pangkat_nilai_jarak = pow($produk->jarak->nilai_jarak, 2);   // Memangkatkan nilai jarak
        $pangkat_nilai_harga = pow($produk->nilai_harga, 2);          // Memangkatkan nilai harga
        $pangkat_nilai_rating = pow($produk->nilai_rating, 2);        // Memangkatkan nilai rating
        $pangkat_nilai_jt = pow($produk->nilai_jt, 2);                // Memangkatkan nilai jumlah terjual
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
        if($kriteria->kriteria_id == 1) {
          foreach($data_produk as $key=>$produk) {
            $normalisasi_harga = $produk->nilai_harga/$bagi_nilai_harga;
            $nm_harga[] = $normalisasi_harga;
            $produk->nm_harga = $normalisasi_harga;
          }
        } else if($kriteria->kriteria_id == 2) {
          foreach($data_produk as $key=>$produk) {
            $normalisasi_jarak = $produk->jarak->nilai_jarak/$bagi_nilai_jarak;
            $nm_jarak[] = $normalisasi_jarak;
            $produk->nm_jarak = $normalisasi_jarak;
          }
        } else if($kriteria->kriteria_id == 3) {
          foreach($data_produk as $key=>$produk) {
            $normalisasi_rating = $produk->nilai_rating/$bagi_nilai_rating;
            $nm_rating[] = $normalisasi_rating;
            $produk->nm_rating = $normalisasi_rating;
          }
        } else if($kriteria->kriteria_id == 4) {
          foreach($data_produk as $key=>$produk) {
            $normalisasi_jt = $produk->nilai_jt/$bagi_nilai_jt;
            $nm_jt[] = $normalisasi_jt;
            $produk->nm_jt = $normalisasi_jt;
          }
        }
      }
      

      // Optimasi Nilai Atribut
      foreach($data_kriteria as $key=>$kriteria) {
        if($kriteria->kriteria_id == 1) {
          foreach($data_produk as $key=>$produk) {
            $optimasi_harga =  ($produk->nilai_harga/$bagi_nilai_harga)*$kriteria->bobot;
            $op_harga[] = $optimasi_harga;
            $produk->op_harga = $optimasi_harga;
          }
        } else if($kriteria->kriteria_id == 2) {
          foreach($data_produk as $key=>$produk) {
            $optimasi_jarak = ($produk->jarak->nilai_jarak/$bagi_nilai_jarak)*$kriteria->bobot;
            $op_jarak[] = $optimasi_jarak;
            $produk->op_jarak = $optimasi_jarak;
          }
        } else if($kriteria->kriteria_id == 3) {
          foreach($data_produk as $key=>$produk) {
            $optimasi_rating = ($produk->nilai_rating/$bagi_nilai_rating)*$kriteria->bobot;
            $op_rating[] = $optimasi_rating;
            $produk->op_rating = $optimasi_rating;
          }
        } else if($kriteria->kriteria_id == 4) {
          foreach($data_produk as $key=>$produk) {
            $optimasi_jt = ($produk->nilai_jt/$bagi_nilai_jt)*$kriteria->bobot;
            $op_jt[] = $optimasi_jt;
            $produk->op_jt = $optimasi_jt;
          }
        }
      }


      // Menentukan Nilai Yi(Max-Min)
      foreach($data_produk as $key=>$produk) {
        $max = $produk->op_rating+$produk->op_jt;
        $min = $produk->op_harga+$produk->op_jarak;
        $produk->max = $max;
        $produk->min = $min;

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
      
      $rank_sorted = $data_produk->sortBy('rank')->groupBy('supplier.nama');
    }
    // END : Proses Perhitungan
    // dd($rank_sorted);
    
    return view('admin.metode_moora.hasil', compact(
      'data_produk', 'data_kriteria', 'rank', 'rank_sorted', 'data_supplier', 'pesan'
    ));
  }

}

?>