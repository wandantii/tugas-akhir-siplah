@extends('front.layout')
@section('content')

<main id="main" class="pt-5">

  @if(isset($data_solver))
  <section id="" class="mt-3">
    <div class="container" data-aos="fade-up">
      <header class="section-header">
        <h2>Metode MOORA</h2>
        <p>Cari Barang atau Jasa</p>
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
  @else
  <section id="" class="mt-3">
    <div class="container" data-aos="fade-up">
      <header class="section-header">
        <h2>Metode MOORA</h2>
        <p>Aduh! Maaf ya...</p>
        <small>{{ $message['data_solver'] ?? '' }}</small>
      </div>
    </div>
  </section>
  @endif

  
  @if(isset($data_produk))
  <section id="" class="m-0 p-0 row">
    <div class="container text-center col-8 mx-auto" data-aos="fade-up">
      <small>Terima kasih sudah menggunakan SIPLah kami, untuk memberi tahu rekomendasi produk ini kami menggunakan Metode BWM dan Metode MOORA dalam proses pencariannya. Jika ingin mengetahui mengenai proses perhitungan, silahkan tekan tombol di bawah ini.</small>
      <button type="button" class="btn btn-success" style="width:100%;" data-bs-toggle="modal" data-bs-target="#modalDialogScrollable">
        Lihat Perhitungan
      </button>
    </div>
  </section>
  @endif

  @if(isset($data_produk))
  <section id="" class="">
    @foreach($rank_sorted as $key=>$sorted)
    <div class="container mb-5" data-aos="fade-up">
      <div class="card">
        <header class="section-header p-0 my-3">
          <p>{{ \App\Http\Controllers\SupplierController::getSupplierNama($key) }}</p>
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
              @foreach($data_kriteria as $key=>$kriteria)
              <span>C{{ $key+1 }} : {{ $kriteria->nama ?? ''}}</span><br>
              @endforeach
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