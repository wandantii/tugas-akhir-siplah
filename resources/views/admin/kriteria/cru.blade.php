@extends('admin.layout')
@section('content')

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Data Kriteria</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('admin') }}"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item">Data Master</li>
        <li class="breadcrumb-item"><a href="{{ url('admin/kriteria') }}">Kriteria</a></li>
        <li class="breadcrumb-item active">
          @if($keterangan == 'baru')
            Buat Kriteria Baru
          @elseif($keterangan == 'edit')
            Edit Kriteria
          @elseif($keterangan == 'detail')
            Detail Kriteria
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
              Form Kriteria Baru
            @elseif($keterangan == 'edit')
              Form Edit Kriteria
            @elseif($keterangan == 'detail')
              Form Detail Kriteria
            @endif
            </h5>
            <!-- General Form Elements -->
            @if($keterangan == 'baru')
            <form method="POST" action="{{ url('admin/kriteria/store') }}">
              @csrf
            @elseif($keterangan == 'edit')
            <form method="POST" action="{{ url('admin/kriteria/update/'.$data->kriteria_id) }}">
              @csrf {{ method_field('PUT') }}
            @endif
              <div class="row mb-3">
                <label for="nama" class="col-sm-2 col-form-label">Nama Kriteria</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="nama" name="nama" @if($keterangan != 'baru') value="{{ $data->nama ?? '' }}" @endif>
                </div>
              </div>
              <div class="row mb-3">
                <label for="tipe" class="col-sm-2 col-form-label">Tipe Kriteria</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="tipe" name="tipe" @if($keterangan != 'baru') value="{{ $data->tipe ?? '' }}" @endif readonly>
                  <!-- <select class="form-select" aria-label="Default select example" id="tipe" name="tipe">
                    <option value="Benefit" @if($keterangan != 'baru') {{ ($data->tipe === 'Benefit') ? 'Selected' : ''}} @endif>Benefit</option>
                    <option value="Cost" @if($keterangan != 'baru') {{ ($data->tipe === 'Cost') ? 'Selected' : ''}} @endif>Cost</option>
                  </select> -->
                </div>
              </div>
              <div class="row mb-3">
                <label for="nama" class="col-sm-2 col-form-label">Bobot Kriteria</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="bobot" name="bobot" @if($keterangan != 'baru') value="{{ $data->bobot ?? '' }}" @endif>
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