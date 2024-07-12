@extends('admin.layout')
@section('content')

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Data Metode Moora</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('admin') }}"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item">Data Perhitungan</li>
        <li class="breadcrumb-item active">Metode Moora</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section">
  
    <div class="card">
      <div class="card-body">
        <div class="search-bar text-center row py-3">
          <h5 class="card-title"><strong>CARI BARANG ATAU JASA</strong></h5>
          <form class="search col-sm" method="POST" action="{{ url('admin/metode-moora') }}">
          @csrf
            <input type="text" id="querysearch" name="querysearch" placeholder="Cari barang atau jasa" title="Tuliskan keyword" class="addon-search" style="border:1px solid #dee2e6; padding:15px 25px; border-radius:15px 0px 0px 15px; width:90%;" @if(isset($searchProduk)) value="{{$searchProduk}}" @endif>
            <button type="submit" title="Search" style="border:1px solid #5667f2; padding:15px 25px; border-radius:0px 15px 15px 0px; background-color:#5667f2; color:#fff; box-shadow: 0 0 10px 0 rgba(1, 41, 112, 0.15);"><i class="bi bi-search"></i></button>
          </form>
          <hr class="my-5">
          <button type="button" class="btn btn-primary col-4 m-auto" data-bs-toggle="modal" data-bs-target="#modalDialogScrollable">
            Lihat Perhitungan
          </button>
        </div>
      </div>
    </div><!-- End Search Bar -->

    @foreach($rank_sorted as $key=>$sorted)
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">{{ $key }}</h5>  
        <div class="scroll-container">
          @foreach($sorted as $key=>$produk)
          <div class="scroll mb-3">
            <div class="mx-2 text-center" style="width:15rem">
              <img @if(isset($produk->foto_produk)) src="{{ asset('produk/'.$produk->foto_produk) }}" @else src="{{ asset('produk/blank.jpg') }}" @endif alt="Foto Produk" width="100%" style="display:block;">
              <span class="badge bg-danger block m-2">Rank {{ $produk->rank }}</span>
              <p class="fw-bold text-dark block" style="white-space:pre-line;line-height:normal;height:30px;">{{ Str::limit($produk->nama, 40) }}</p>
              <span style="display:block;">Rp {{ number_format($produk->harga, 2, ",", ".") }}</span>
              <a class="btn btn-primary btn-sm rounded-pill block m-2 px-3" href="{{ $produk->url }}" target="_blank">Lihat Produk</a>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
    @endforeach
    
  </section>
</main><!-- End #main -->


<div class="modal fade" id="modalDialogScrollable" tabindex="-1">
  <div class="modal-dialog modal-dialog-scrollable modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Proses Perhitungan MOORA</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="row" style="padding-top:25px;">
                  <div class="col-sm">
                    <h5><b>Dengan keterangan sebagai berikut</b></h5>
                    @foreach($data_kriteria as $key=>$kriteria)
                    <span>C{{ $key+1 }} : {{ $kriteria->nama ?? ''}}</span><br>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-body row" style="padding-top:25px;">
            <div class="col-sm" style="margin-bottom:15px;">
              <h3><b>DATA AWAL</b></h3>
            </div>
            <table class="col-sm table datatable">
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
                  <td>{{ $produk->nilai_harga }}</td>
                  <td>{{ $produk->jarak->nilai_jarak }}</td>
                  <td>{{ number_format($produk->nilai_rating, 2, '.', '') }}</td>
                  <td>{{ $produk->nilai_jt }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <div class="card">
          <div class="card-body row" style="padding-top:25px;">
            <div class="col-sm" style="margin-bottom:15px;">
              <h3><b>NORMALISASI MATRIKS</b></h3>
            </div>
            <table class="col-sm table datatable">
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

        <div class="card">
          <div class="card-body row" style="padding-top:25px;">
            <div class="col-sm" style="margin-bottom:15px;">
              <h3><b>OPTIMASI NILAI ATRIBUT</b></h3>
            </div>
            <table class="col-sm table datatable">
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

        <div class="card">
          <div class="card-body row" style="padding-top:25px;">
            <div class="col-sm" style="margin-bottom:15px;">
              <h3><b>MENENTUKAN NILAI YI(MAX-MIN)</b></h3>
            </div>
            <table class="col-sm table datatable">
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

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection