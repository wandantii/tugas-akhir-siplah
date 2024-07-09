@extends('admin.layout')
@section('content')

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Data Produk</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('admin') }}"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item">Data Master</li>
        <li class="breadcrumb-item"><a href="{{ url('admin/produk') }}">Produk</a></li>
        <li class="breadcrumb-item active">
          @if($keterangan == 'baru')
            Buat Produk Baru
          @elseif($keterangan == 'edit')
            Edit Produk
          @elseif($keterangan == 'detail')
            Detail Produk
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
              Form Produk Baru
            @elseif($keterangan == 'edit')
              Form Edit Produk
            @elseif($keterangan == 'detail')
              Form Detail Produk
            @endif
            </h5>
            <!-- General Form Elements -->
            @if($keterangan == 'baru')
            <form method="POST" action="{{ url('admin/produk/store') }}" enctype="multipart/form-data">
              @csrf
            @elseif($keterangan == 'edit')
            <form method="POST" action="{{ url('admin/produk/update/'.$data->produk_id) }}" enctype="multipart/form-data">
              @csrf {{ method_field('PUT') }}
            @endif
              <div class="row mb-3">
                <label for="supplier" class="col-sm-2 col-form-label">Supplier</label>
                <div class="col-sm-10">
                  <select class="form-select" aria-label="Default select example" id="supplier" name="supplier">
                    <option selected="true" disabled="disabled">Pilih Supplier</option>
                    @foreach($data_supplier as $key=>$supplier)
                      <option value="{{ $supplier->supplier_id }}" @if($keterangan != 'baru') {{ ($data->supplier_id == $supplier->supplier_id) ? 'Selected' : ''}} @endif>{{ $supplier->nama }}, {{ $supplier->kecamatan->kecamatan }}, {{ $supplier->kota->kota }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="row mb-3">
                <label for="kategori_produk" class="col-sm-2 col-form-label">Kategori Produk</label>
                <div class="col-sm-10">
                  <select class="form-select" aria-label="Default select example" id="kategori_produk" name="kategori_produk">
                    <option selected="true" disabled="disabled">Pilih Kategori Produk</option>
                    @foreach($data_kategori_produk as $key=>$kategori_produk)
                      <option value="{{ $kategori_produk->kategori_produk_id }}" @if($keterangan != 'baru') {{ ($data->kategori_produk_id == $kategori_produk->kategori_produk_id) ? 'Selected' : ''}} @endif>{{ $kategori_produk->kategori_produk }} - {{ $kategori_produk->sub_kategori_produk }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="row mb-3">
                <label for="satuan_produk" class="col-sm-2 col-form-label">Satuan Produk</label>
                <div class="col-sm-10">
                  <select class="form-select" aria-label="Default select example" id="satuan_produk" name="satuan_produk">
                    <option selected="true" disabled="disabled">Pilih Satuan Produk</option>
                    @foreach($data_satuan_produk as $key=>$satuan_produk)
                      <option value="{{ $satuan_produk->satuan_produk_id }}" @if($keterangan != 'baru') {{ ($data->satuan_produk_id == $satuan_produk->satuan_produk_id) ? 'Selected' : ''}} @endif>{{ $satuan_produk->nama }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="row mb-3">
                <label for="nama" class="col-sm-2 col-form-label">Nama Produk</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="nama" name="nama" @if($keterangan != 'baru') value="{{ $data->nama ?? '' }}" @endif>
                </div>
              </div>
              <div class="row mb-3">
                <label for="nama" class="col-sm-2 col-form-label">Foto Produk</label>
                <div class="col-sm-10">
                  @if($keterangan != 'baru' && isset($data->foto_produk))
                  <img src="{{ asset('produk/'.$data->foto_produk ?? '') }}" alt="Foto Produk" width="250px" class="mb-2">
                  @endif
                  <input class="form-control" type="file" id="foto_produk" name="foto_produk" @if($keterangan != 'baru') value="{{ $data->foto_produk ?? '' }}" @endif>
                </div>
              </div>
              <div class="row mb-3">
                <label for="harga" class="col-sm-2 col-form-label">Harga Produk</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="harga" name="harga" @if($keterangan != 'baru') value="{{ $data->harga ?? '' }}" @endif>
                </div>
              </div>
              <div class="row mb-3">
                <label for="url" class="col-sm-2 col-form-label">Link Produk</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="url" name="url" @if($keterangan != 'baru') value="{{ $data->url ?? '' }}" @endif>
                </div>
              </div>
              <div class="row mb-3">
                <label for="jumlah_terjual" class="col-sm-2 col-form-label">Jumlah Produk Terjual</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="jumlah_terjual" name="jumlah_terjual" @if($keterangan != 'baru') value="{{ $data->jumlah_terjual ?? '' }}" @endif>
                </div>
              </div>
              <div class="row mb-3">
                <label for="rating" class="col-sm-2 col-form-label">Rating Produk</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="rating" name="rating" @if($keterangan != 'baru') value="{{ $data->rating ?? '' }}" @endif>
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