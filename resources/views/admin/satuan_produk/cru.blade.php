@extends('admin.layout')
@section('content')

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Data Satuan Produk</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('admin') }}"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item">Data Master</li>
        <li class="breadcrumb-item"><a href="{{ url('admin/satuanproduk') }}">Satuan Produk</a></li>
        <li class="breadcrumb-item active">
          @if($keterangan == 'baru')
            Buat Satuan Produk Baru
          @elseif($keterangan == 'edit')
            Edit Satuan Produk
          @elseif($keterangan == 'detail')
            Detail Satuan Produk
          @endif
        </li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-sm">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">
            @if($keterangan == 'baru')
              Form Satuan Produk Baru
            @elseif($keterangan == 'edit')
              Form Edit Satuan Produk
            @elseif($keterangan == 'detail')
              Form Detail Satuan Produk
            @endif
            </h5>
            <!-- General Form Elements -->
            @if($keterangan == 'baru')
            <form method="POST" action="{{ url('admin/satuanproduk/store') }}">
              @csrf
            @elseif($keterangan == 'edit')
            <form method="POST" action="{{ url('admin/satuanproduk/update/'.$data->satuan_produk_id) }}">
              @csrf {{ method_field('PUT') }}
            @endif
              <div class="row mb-3">
                <label for="nama" class="col-sm-2 col-form-label">Nama Satuan Produk</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="nama" name="nama" @if($keterangan != 'baru') value="{{ $data->nama ?? '' }}" @endif>
                </div>
              </div>

              <div class="row mb-3" style="float:right;">
                <div class="col-sm">
                  <button type="submit" class="btn btn-dark">Submit Form</button>
                </div>
              </div>
            </form><!-- End General Form Elements -->
          </div>
        </div>
      </div>
    </div>
  </section>
</main><!-- End #main -->

@endsection