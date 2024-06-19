@extends('admin.layout')
@section('content')

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Data Kategori Produk</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('admin') }}"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item">Data Master</li>
        <li class="breadcrumb-item"><a href="{{ url('admin/kategoriproduk') }}">Kategori Produk</a></li>
        <li class="breadcrumb-item active">
          @if($keterangan == 'baru')
            Buat Kategori Produk Baru
          @elseif($keterangan == 'edit')
            Edit Kategori Produk
          @elseif($keterangan == 'detail')
            Detail Kategori Produk
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
              Form Kategori Produk Baru
            @elseif($keterangan == 'edit')
              Form Edit Kategori Produk
            @elseif($keterangan == 'detail')
              Form Detail Kategori Produk
            @endif
            </h5>
            <!-- General Form Elements -->
            @if($keterangan == 'baru')
            <form method="POST" action="{{ url('admin/kategoriproduk/store') }}">
              @csrf
            @elseif($keterangan == 'edit')
            <form method="POST" action="{{ url('admin/kategoriproduk/update/'.$data->kategori_produk_id) }}">
              @csrf {{ method_field('PUT') }}
            @endif
              <div class="row mb-3">
                <label for="kategori_produk" class="col-sm-2 col-form-label">Kategori Produk</label>
                <div class="col-sm-10">
                  <select class="form-select" aria-label="Default select example" id="kategori_produk" name="kategori_produk">
                  <option selected="true" disabled="disabled">Pilih Kategori Produk</option>
                  <option value="Barang" @if($keterangan != 'baru') {{ ($data->kategori_produk == 'Barang') ? 'Selected' : ''}} @endif>Barang</option>
                  <option value="Jasa" @if($keterangan != 'baru') {{ ($data->kategori_produk == 'Jasa') ? 'Selected' : ''}} @endif>Jasa</option>
                  </select>
                </div>
              </div>
              <div class="row mb-3">
                <label for="sub_kategori_produk" class="col-sm-2 col-form-label">Sub Kategori Produk</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="sub_kategori_produk" name="sub_kategori_produk" @if($keterangan != 'baru') value="{{ $data->sub_kategori_produk ?? '' }}" @endif>
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