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
              <!-- <th>Action</th> -->
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
              <!-- <td>
                <a href="{{ url('admin/alternatif/edit/'.$produk->id) }}" type="button" class="btn btn-warning mx-1" style="float:left;"><i class="bi bi-pencil-square"></i></a>
                <form action="{{ url('admin/alternatif/delete/'.$produk->id.'/') }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data ini?')" style="float:left;" class="mx-1">
                  @csrf
                  <input type="hidden" name="_method" value="DELETE">
                  <button type="submit" class="btn btn-danger">
                    &nbsp;<i class="bi bi-trash-fill"></i>&nbsp;
                  </button>
                </form>
              </td> -->
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
    
  </section>
</main><!-- End #main -->

@endsection