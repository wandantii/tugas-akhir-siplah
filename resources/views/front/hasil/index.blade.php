@extends('front.layout')
@section('content')

<main id="main" class="pt-5">

@if(!isset($data_profil))

  <section id="" class="mt-3">
    <div class="container" data-aos="fade-up">
      <header class="section-header">
        <h2>Hasil</h2>
        <p>Aduh! Maaf ya...</p>
        <small>{{ $message['data_profil'] ?? '' }}</small>
      </div>
    </div>
  </section>

@else

  <section id="values" class="values mt-3">
    <div class="container" data-aos="fade-up">
      <header class="section-header">
        <h2>Metode Best-Worst Method</h2>
        <p>1. Masukkan Kriteria Produk</p>
        <small class="text-secondary">Harap ikuti langkah-langkah di bawah ini agar sistem dapat menampilkan produk yang cocok untuk Anda.</small>
      </header>
      <div class="row">
        <div class="col-6 col-lg-6 col-md-12" data-aos="fade-up" data-aos-delay="200">
          <div class="box">
            <h3>Step 1</h3>
            <p class="pb-0 mb-0">Download template BWM Solver melalui tombol di bawah ini</p>
            <a class="btn btn-success mt-0" href="{{ url('metodebwm/download-template') }}">Download Template BWM Solver</a>
          </div>
        </div>
        <div class="col-6 col-lg-6 col-md-12" data-aos="fade-up" data-aos-delay="200">
          <div class="box">
            <h3>Step 2</h3>
            <p>Buka dan lakukan penyesuaian. Anda hanya diperbolehkan untuk <strong>mengubah kolom-kolom yang berwarna hijau</strong> saja.</p>
          </div>
        </div>
        <div class="col-6 col-lg-6 col-md-12" data-aos="fade-up" data-aos-delay="200">
          <div class="box">
            <h3>Step 3</h3>
            <p>Pilih <strong>Select the Best</strong> sesuai keinginan</p>
          </div>
        </div>
        <div class="col-6 col-lg-6 col-md-12" data-aos="fade-up" data-aos-delay="200">
          <div class="box">
            <h3>Step 4</h3>
            <p>Pilih <strong>Select the Worst</strong> sesuai keinginan</p>
          </div>
        </div>
        <div class="col-6 col-lg-6 col-md-12" data-aos="fade-up" data-aos-delay="200">
          <div class="box">
            <h3>Step 5</h3>
            <p>Pilih nilai untuk <strong>Best to Others</strong> sesuai keinginan</p>
          </div>
        </div>
        <div class="col-6 col-lg-6 col-md-12" data-aos="fade-up" data-aos-delay="200">
          <div class="box">
            <h3>Step 6</h3>
            <p>Pilih nilai untuk <strong>Others to the Worst</strong> sesuai keinginan</p>
          </div>
        </div>
        <div class="col-6 col-lg-6 col-md-12" data-aos="fade-up" data-aos-delay="200">
          <div class="box">
            <h3>Step 7</h3>
            <p>Klik tab <strong>Data</strong> pada menu, kemudian pilih <strong>Solver</strong></p>
          </div>
        </div>
        <div class="col-6 col-lg-6 col-md-12" data-aos="fade-up" data-aos-delay="200">
          <div class="box">
            <h3>Step 8</h3>
            <p>Klik <strong>Solver</strong> pada bagian bawah, kemudian pilih <strong>OK</strong></p>
          </div>
        </div>
        <div class="col-6 col-lg-6 col-md-12" data-aos="fade-up" data-aos-delay="200">
          <div class="box">
            <h3>Step 9</h3>
            <p>Silahkan input file excel yang telah diperbarui sebelumnya pada form di bawah ini, lalu klik <strong>Submit</strong></p>
          </div>
        </div>
        <div class="col-6 col-lg-6 col-md-12" data-aos="fade-up" data-aos-delay="200">
          <div class="box">
            <h3>Step 10</h3>
            <p>Lihat hasil perhitungan produk yang sesuai dengan kebutuhan Anda pada halaman <strong>Cari Produk</strong></p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="" class="" style="background:#fafbff;">
    <div class="">
      <div class="container">
        <div class="row justify-content-center">
          <header class="section-header">
            <p>2. Form BWMSolver</p>
            <small class="text-secondary">Pastikan excel yang Anda ubah sudah sesuai keperluan dan ketentuan sistem<br>Hal ini diperlukan agar sistem bisa melakukan perhitungan dan menampilkan produk yang sesuai</small>
          </header>
          <div class="col-lg-6">
            <form class="row p-0" method="POST" action="{{ url('metodebwm') }}" enctype="multipart/form-data">
            @csrf
              <input class="form-control" style="border-radius:0px;width:70%;float:left;" type="file" id="solver" name="solver">
              <button class="btn btn-primary" style="border-radius:0px;width:30%;float:right;" type="submit" title="Search">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  @if(isset($data_solver))
  <section id="values" class="values">
    <div class="container" data-aos="fade-up">
      <header class="section-header">
        <h2>Hasil Solver</h2>
        <p>3. Metode BWM dengan BWMSolver</p>
      </header>
      <div class="row">
        <div class="col-lg-12" data-aos="fade-up" data-aos-delay="200">
          <div class="box">
            <table class="table table-bordered text-center">
              <tr>
                <th>Criteria Number</th>
                <th>Criterion 1</th>
                <th>Criterion 2</th>
                <th>Criterion 3</th>
                <th>Criterion 4</th>
              </tr>
              <tr>
                <th>Names of Criteria</th>
                <td class="bg-warning">{{ $data_solver->c1 ?? '' }}</td>
                <td class="bg-warning">{{ $data_solver->c2 ?? '' }}</td>
                <td class="bg-warning">{{ $data_solver->c3 ?? '' }}</td>
                <td class="bg-warning">{{ $data_solver->c4 ?? '' }}</td>
              </tr>
              <tr>
                <th>Code of Criteria</th>
                <td class="bg-warning">C1</td>
                <td class="bg-warning">C2</td>
                <td class="bg-warning">C3</td>
                <td class="bg-warning">C4</td>
              </tr>
              <tr>
                <th>Types of Criteria</th>
                <td class="bg-success text-light">{{ $data_solver->type_c1 ?? '' }}</td>
                <td class="bg-success text-light">{{ $data_solver->type_c2 ?? '' }}</td>
                <td class="bg-success text-light">{{ $data_solver->type_c3 ?? '' }}</td>
                <td class="bg-success text-light">{{ $data_solver->type_c4 ?? '' }}</td>
              </tr>
            </table>
            <table class="table table-bordered text-center" style="width:50%;">
              <tr>
                <th style="width:60%;">Best Criteria</th>
                <td class="bg-success text-light" style="width:40%;">{{ $data_solver->best ?? '' }}</td>
              </tr>
            </table>
            <table class="table table-bordered text-center" style="width:50%;">
              <tr>
                <th style="width:60%;">Worst Criteria</th>
                <td class="bg-success text-light" style="width:40%;">{{ $data_solver->worst ?? '' }}</td>
              </tr>
            </table>
            <table class="table table-bordered text-center">
              <tr>
                <th>Best to Others</th>
                <th>{{ $data_solver->c1 ?? '' }}</th>
                <th>{{ $data_solver->c2 ?? '' }}</th>
                <th>{{ $data_solver->c3 ?? '' }}</th>
                <th>{{ $data_solver->c4 ?? '' }}</th>
              </tr>
              <tr>
                <th>{{ $data_solver->best ?? '' }}</th>
                <td class="bg-success text-light">{{ $data_solver->best_to_c1 ?? '' }}</td>
                <td class="bg-success text-light">{{ $data_solver->best_to_c2 ?? '' }}</td>
                <td class="bg-success text-light">{{ $data_solver->best_to_c3 ?? '' }}</td>
                <td class="bg-success text-light">{{ $data_solver->best_to_c4 ?? '' }}</td>
              </tr>
            </table>
            <table class="table table-bordered text-center" style="width:50%;">
              <tr>
                <th>Others to the Worst</th>
                <th>{{ $data_solver->worst ?? '' }}</th>
              </tr>
              <tr>
                <th>{{ $data_solver->c1 ?? '' }}</th>
                <td class="bg-success text-light">{{ $data_solver->c1_to_worst ?? '' }}</td>
              </tr>
              <tr>
                <th>{{ $data_solver->c2 ?? '' }}</th>
                <td class="bg-success text-light">{{ $data_solver->c2_to_worst ?? '' }}</td>
              </tr>
              <tr>
                <th>{{ $data_solver->c3 ?? '' }}</th>
                <td class="bg-success text-light">{{ $data_solver->c3_to_worst ?? '' }}</td>
              </tr>
              <tr>
                <th>{{ $data_solver->c4 ?? '' }}</th>
                <td class="bg-success text-light">{{ $data_solver->c4_to_worst ?? '' }}</td>
              </tr>
            </table>
            <table class="table table-bordered text-center">
              <tr style="vertical-align:middle;">
                <th rowspan="2">Weights</th>
                <th>{{ $data_solver->c1 ?? '' }}</th>
                <th>{{ $data_solver->c2 ?? '' }}</th>
                <th>{{ $data_solver->c3 ?? '' }}</th>
                <th>{{ $data_solver->c4 ?? '' }}</th>
              </tr>
              <tr>
                <td class="bg-warning">{{ $data_solver->weight_c1 ?? '' }}</td>
                <td class="bg-warning">{{ $data_solver->weight_c2 ?? '' }}</td>
                <td class="bg-warning">{{ $data_solver->weight_c3 ?? '' }}</td>
                <td class="bg-warning">{{ $data_solver->weight_c4 ?? '' }}</td>
              </tr>
            </table>
            <table class="table table-bordered text-center" style="width:50%;">
              <tr>
                <th style="width:60%;">Ksi*</th>
                <td class="bg-warning" style="width:40%;">{{ $data_solver->ksi ?? '' }}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endif

  <section id="" class="mt-3">
    <div class="container" data-aos="fade-up">
      <header class="section-header">
        <h2>Metode Multi-Objective Optimization by Ratio Analysis</h2>
        <p>4. Cari Barang atau Jasa</p>
      </header>
      <form class="search row" method="POST" action="{{ url('hasil') }}">
      @csrf
        <div class="col-lg-11">
          <input type="text" id="querysearch" name="querysearch" placeholder="Cari barang atau jasa" title="Tuliskan keyword" class="addon-search" style="border:1px solid #dee2e6; padding:15px 25px; width:100%;" @if(isset($searchProduk)) value="{{$searchProduk}}" @endif>
        </div>
        <div class="col-lg-1">
          <button type="submit" title="Search" style="border:1px solid #5667f2; padding:15px 25px; background-color:#5667f2; color:#fff; box-shadow: 0 0 10px 0 rgba(1, 41, 112, 0.15); width:100%;"><i class="bi bi-search"></i></button>
        </div>
      </form>
    </div>
  </section>
  
  @if(isset($data_produk) && count($data_produk) > 0 && empty($message))
  <section id="" class="m-0 mb-5 p-0 row">
    <div class="container text-center col-8 mx-auto" data-aos="fade-up">
      <small>Terima kasih sudah menggunakan SIPLah kami, untuk memberi tahu rekomendasi produk ini kami menggunakan Metode BWM dan Metode MOORA dalam proses pencariannya. Jika ingin mengetahui mengenai proses perhitungan, silahkan tekan tombol di bawah ini.</small>
      <button type="button" class="btn btn-success" style="width:100%;" data-bs-toggle="modal" data-bs-target="#modalDialogScrollable">
        Lihat Perhitungan
      </button>
    </div>
  </section>
  @endif

  <section id="" class="mx-5 p-0">
    <div class="px-3 pb-5" style="width:15%; float:left;">
      <form class="search row" method="POST" action="{{ url('hasil') }}">
        @csrf
        <div class="col-sm">
          <input type="hidden" id="querysearch" name="querysearch" placeholder="Cari barang atau jasa" title="Tuliskan keyword" class="addon-search" style="border:1px solid #dee2e6; padding:15px 25px; width:100%;" @if(isset($searchProduk)) value="{{$searchProduk}}" @endif>
          <div class="">
            <h6 for="request_kt" class="fw-bold m-0 p-0" style="color:#012970;">Kategori Produk</h6>
            @foreach($data_kategori_produk as $key=>$kategori_produk)
              <input type="checkbox" id="request_kt{{ $key }}" value="{{ $kategori_produk->kategori_produk_id }}" name="request_kt[]"
              @if(isset($find_kt) && in_array($kategori_produk->kategori_produk_id, $find_kt)) checked="" @endif>
              <label for="request_kt{{ $key }}">&nbsp; {{ $kategori_produk->sub_kategori_produk }}</label><br>
            @endforeach
          </div>
          <div class="my-4">
            <h6 for="request_st" class="fw-bold m-0 p-0" style="color:#012970;">Satuan Produk</h6>
            @foreach($data_satuan_produk as $key=>$satuan_produk)
              <input type="checkbox" id="request_st{{ $key }}" value="{{ $satuan_produk->satuan_produk_id }}" name="request_st[]"
              @if(isset($find_st) && in_array($satuan_produk->satuan_produk_id, $find_st)) checked="" @endif>
              <label for="request_st{{ $key }}">&nbsp; {{ $satuan_produk->nama }}</label><br>
            @endforeach
          </div>
          <div class="">
            <button type="submit" title="Search" style="border:1px solid #5667f2; background-color:#5667f2; color:#fff; box-shadow: 0 0 10px 0 rgba(1, 41, 112, 0.15); width:100%; border-radius:10px;"><i class="bi bi-search"></i> Filter</button>
          </div>
        </div>
      </form>
    </div>
    
    @if(isset($data_produk) && count($data_produk) > 0 && empty($message))
      @foreach($rank_sorted as $key=>$sorted)
      <div class="container mb-5" style="width:85%; float:right;" data-aos="fade-up">
        <div class="card">
          <header class="section-header p-0 my-3">
            <p class="my-1">{{ \App\Http\Controllers\SupplierController::getSupplierNama($key) }}</p>
            <h2>{{ \App\Http\Controllers\SupplierController::getSupplierAlamat($key) }}</h2>
          </header>
          <div class="card-body">
            <div class="scroll-container">
              @foreach($sorted as $key=>$produk)
              <div class="scroll mb-3">
                <div class="mx-4" style="width:15rem">
                  <div class="">
                    <span class="badge bg-danger block my-2">Rank {{ $produk->rank }}</span>
                    <img @if(isset($produk->foto_produk)) src="{{ asset('produk/'.$produk->foto_produk) }}" @else src="{{ asset('produk/blank.jpg') }}" @endif alt="Foto Produk" width="100%" style="display:block;">
                  </div>
                  <div class="">
                    <p class="fw-bold text-dark block" style="white-space:pre-line;line-height:normal;height:35px;">{{ Str::limit($produk->nama, 41) }}</p>
                    <p class="my-1">Rp {{ number_format($produk->harga) }}</p>
                    <span class="text-warning">
                      @php $rating = explode('.',$produk->rating) @endphp
                      @for($i=0; $i<$rating[0]; $i++)
                        <i class="bi bi-star-fill"></i>
                      @endfor
                      @if($rating[0] < 5)
                      @if($rating[1] > 0)
                        <i class="bi bi-star-half"></i>
                      @else
                        <i class="bi bi-star"></i>
                      @endif
                      @endif
                    </span>
                    <span class="text-secondary mx-1">|</span>
                    <span class="text-secondary">
                      @php
                        $jumlah_terjual[1] = '';
                        if($produk->jumlah_terjual > 9999) {
                          $jumlah_terjual[0] = '10RB+';
                        } else {
                          $jumlah_terjual_format = number_format($produk->jumlah_terjual);
                          $jumlah_terjual = explode(',', $jumlah_terjual_format);
                          if(isset($jumlah_terjual[1])) {
                            $jumlah_terjual[1] = ",".str_replace('00', 'RB', $jumlah_terjual[1]);
                          }
                        }
                      @endphp
                      {{ $jumlah_terjual[0] }}{{ $jumlah_terjual[1] ?? '' }} Terjual
                    </span>
                  </div>
                  <div class="my-2">
                    <!-- <a class="btn btn-primary btn-sm rounded-pill block px-3" href="{{ url('admin/produk/edit/'.$produk->produk_id) }}" target="_blank">Lihat Produk</a> -->
                    <a class="btn btn-primary btn-sm rounded-pill block px-3" href="{{ $produk->url }}" target="_blank">Beli Produk</a>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
      @endforeach
    @else
      <div class="container text-center m-0 p-0 mb-5" data-aos="fade-up">
        <p>{{ $message['data_produk'] ?? 'Tidak ada data ditemukan' }}</p>
        <p>{{ $message['error_c1'] ?? '' }}</p>
        <p>{{ $message['error_c2'] ?? '' }}</p>
        <p>{{ $message['error_c3'] ?? '' }}</p>
        <p>{{ $message['error_c4'] ?? '' }}</p>
      </div>
    @endif
  </section>
@endif

</main><!-- End #main -->


@if(isset($data_produk))
<div class="modal fade" id="modalDialogScrollable" tabindex="-1">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Proses Perhitungan MOORA</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <div class="row my-4 mx-4">
          <div class="card col-sm">
            <div class="card-body">
              <h5><b>Dengan keterangan sebagai berikut</b></h5>
              <span>C1 : {{ $data_solver->c1 ?? ''}}</span><br>
              <span>C2 : {{ $data_solver->c2 ?? ''}}</span><br>
              <span>C3 : {{ $data_solver->c3 ?? ''}}</span><br>
              <span>C4 : {{ $data_solver->c4 ?? ''}}</span><br>
            </div>
          </div>
        </div>

        <div class="row my-4 mx-4">
          <div class="card col-sm">
            <div class="card-body mt-3">
              <div class="mb-3 text-center">
                <h3><b>DATA AWAL</b></h3>
              </div>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama Produk</th>
                    <th>Nama Supplier</th>
                    @foreach($data_kriteria as $key=>$kriteria)
                    <th>C{{ $key+1 }}</th>
                    @endforeach
                  </tr>
                </thead>
                <tbody>
                  @foreach($data_produk as $key=>$produk)
                  <tr>
                    <td>{{ ($key+1)."." }}</td>
                    <td>{{ $produk->nama }}</td>
                    <td>{{ $produk->supplier->nama }}</td>
                    <td>{{ $produk->harga }}</td>
                    <td>{{ $produk->jarak->jarak }}</td>
                    <td>{{ number_format($produk->rating, 2, '.', '') }}</td>
                    <td>{{ $produk->jumlah_terjual }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="row my-4 mx-4">
          <div class="card col-sm">
            <div class="card-body mt-3">
              <div class="mb-3 text-center">
                <h3><b>NORMALISASI MATRIKS</b></h3>
              </div>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th colspan="3" class="text-primary">Pembagi</th>
                    <th class="text-primary">{{ number_format($bagi_nilai_harga, 3, '.', '') }}</th>
                    <th class="text-primary">{{ number_format($bagi_nilai_jarak, 3, '.', '') }}</th>
                    <th class="text-primary">{{ number_format($bagi_nilai_rating, 3, '.', '') }}</th>
                    <th class="text-primary">{{ number_format($bagi_nilai_jt, 3, '.', '') }}</th>
                  </tr>
                </thead>
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama Produk</th>
                    <th>Nama Supplier</th>
                    @foreach($data_kriteria as $key=>$kriteria)
                    <th>C{{ $key+1 }}</th>
                    @endforeach
                  </tr>
                </thead>
                <tbody>
                  @foreach($data_produk as $key=>$produk)
                  <tr>
                    <td>{{ ($key+1)."." }}</td>
                    <td>{{ $produk->nama }}</td>
                    <td>{{ $produk->supplier->nama }}</td>
                    <td>{{ number_format($produk->nm_harga, 3, '.', '') }}</td>
                    <td>{{ number_format($produk->nm_jarak, 3, '.', '') }}</td>
                    <td>{{ number_format($produk->nm_rating, 3, '.', '') }}</td>
                    <td>{{ number_format($produk->nm_jt, 3, '.', '') }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="row my-4 mx-4">
          <div class="card col-sm">
            <div class="card-body mt-3">
              <div class="mb-3 text-center">
                <h3><b>OPTIMASI NILAI ATRIBUT</b></h3>
              </div>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th colspan="3" class="text-primary">Bobot</th>
                    <th class="text-primary">{{ number_format($data_solver->weight_c1, 3, '.', '') }}</th>
                    <th class="text-primary">{{ number_format($data_solver->weight_c2, 3, '.', '') }}</th>
                    <th class="text-primary">{{ number_format($data_solver->weight_c3, 3, '.', '') }}</th>
                    <th class="text-primary">{{ number_format($data_solver->weight_c4, 3, '.', '') }}</th>
                  </tr>
                </thead>
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama Produk</th>
                    <th>Nama Supplier</th>
                    @foreach($data_kriteria as $key=>$kriteria)
                    <th>C{{ $key+1 }}</th>
                    @endforeach
                  </tr>
                </thead>
                <tbody>
                  @foreach($data_produk as $key=>$produk)
                  <tr>
                    <td>{{ ($key+1)."." }}</td>
                    <td>{{ $produk->nama }}</td>
                    <td>{{ $produk->supplier->nama }}</td>
                    <td>{{ number_format($produk->op_harga, 3, '.', '') }}</td>
                    <td>{{ number_format($produk->op_jarak, 3, '.', '') }}</td>
                    <td>{{ number_format($produk->op_rating, 3, '.', '') }}</td>
                    <td>{{ number_format($produk->op_jt, 3, '.', '') }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="row my-4 mx-4">
          <div class="card col-sm">
            <div class="card-body mt-3">
              <div class="mb-3 text-center">
                <h3><b>MENENTUKAN NILAI YI(MAX-MIN)</b></h3>
              </div>
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama Produk</th>
                    <th>Nama Supplier</th>
                    <th>Max</th>
                    <th>Min</th>
                    <th>Max-Min</th>
                    <th>Rank</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($data_produk as $key=>$produk)
                  <tr>
                    <td>{{ ($key+1)."." }}</td>
                    <td>{{ $produk->nama }}</td>
                    <td>{{ $produk->supplier->nama }}</td>
                    <td>{{ number_format($produk->max, 3, '.', '') }}</td>
                    <td>{{ number_format($produk->min, 3, '.', '') }}</td>
                    <td>{{ number_format($produk->maxmin, 3, '.', '') }}</td>
                    <td>
                      <?php
                        $array_maxmin = array();
                        foreach ($rank as $key => $row) {
                          $array_maxmin[$key] = $row[1];
                        }
                        array_multisort($array_maxmin, SORT_DESC, $rank);
                        
                        foreach($rank as $key=>$value) {
                          if($value[0] == $produk->produk_id) {
                            echo $key+1;
                          }
                        }
                      ?>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endif

@endsection