@extends('admin.layout')
@section('content')

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Data Supplier</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('admin') }}"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item">Data Master</li>
        <li class="breadcrumb-item"><a href="{{ url('admin/supplier') }}">Supplier</a></li>
        <li class="breadcrumb-item active">
          @if($keterangan == 'baru')
            Buat Supplier Baru
          @elseif($keterangan == 'edit')
            Edit Supplier
          @elseif($keterangan == 'detail')
            Detail Supplier
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
              Form Supplier Baru
            @elseif($keterangan == 'edit')
              Form Edit Supplier
            @elseif($keterangan == 'detail')
              Form Detail Supplier
            @endif
            </h5>
            <!-- General Form Elements -->
            @if($keterangan == 'baru')
            <form method="POST" action="{{ url('admin/supplier/store') }}">
              @csrf
            @elseif($keterangan == 'edit')
            <form method="POST" action="{{ url('admin/supplier/update/'.$data->supplier_id) }}">
              @csrf {{ method_field('PUT') }}
            @endif
              <div class="row mb-3">
                <label for="nama" class="col-sm-2 col-form-label">Nama Supplier</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="nama" name="nama" @if($keterangan != 'baru') value="{{ $data->nama ?? '' }}" @endif>
                </div>
              </div>
              <div class="row mb-3">
                <label for="rating" class="col-sm-2 col-form-label">Rating</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="rating" name="rating" @if($keterangan != 'baru') value="{{ $data->rating ?? '' }}" @endif>
                </div>
              </div>
              <div class="row mb-3">
                <label for="jumlah_pesanan_selesai" class="col-sm-2 col-form-label">Jumlah Pesanan Selesai</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="jumlah_pesanan_selesai" name="jumlah_pesanan_selesai" @if($keterangan != 'baru') value="{{ $data->jumlah_pesanan_selesai ?? '' }}" @endif>
                </div>
              </div>
              <div class="row mb-3">
                <label for="instagram" class="col-sm-2 col-form-label">Instagram</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="instagram" name="instagram" @if($keterangan != 'baru') value="{{ $data->instagram ?? '' }}" @endif>
                </div>
              </div>
              <div class="row mb-3">
                <label for="ecommerce" class="col-sm-2 col-form-label">Ecommerce</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="ecommerce" name="ecommerce" @if($keterangan != 'baru') value="{{ $data->ecommerce ?? '' }}" @endif>
                </div>
              </div>
              <div class="row mb-3">
                <label for="nomor_telepon" class="col-sm-2 col-form-label">Nomor Telepon</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" @if($keterangan != 'baru') value="{{ $data->nomor_telepon ?? '' }}" @endif>
                </div>
              </div>
              <div class="row mb-3">
                <label for="kota" class="col-sm-2 col-form-label">Kota</label>
                <div class="col-sm-10">
                  <select class="form-select" aria-label="Default select example" id="kota" name="kota">
                  <option selected="true" disabled="disabled">Pilih Kota</option>
                    @foreach($data_kota as $key=>$kota)
                      <option value="{{ $kota->kota_id }}" @if($keterangan != 'baru') {{ ($kota->kota_id == $data->kota_id) ? 'Selected' : ''}} @endif>{{ $kota->kota }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="row mb-3">
                <label for="kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>
                <div class="col-sm-10">
                  <select class="form-select" aria-label="Default select example" id="kecamatan" name="kecamatan" disabled>
                  <option selected="true" disabled="disabled">Pilih Kecamatan</option>
                    @if(isset($data->kecamatan_id))
                      @foreach($data_kecamatan as $key=>$kecamatan)
                        <option value="{{ $kecamatan->kecamatan_id }}" @if($keterangan != 'baru') {{ ($kecamatan->kecamatan_id == $data->kecamatan_id) ? 'Selected' : ''}} @endif>{{ $kecamatan->kecamatan }}</option>
                      @endforeach
                    @endif
                  </select>
                </div>
              </div>
              <div class="row mb-3">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="alamat" name="alamat" @if($keterangan != 'baru') value="{{ $data->alamat ?? '' }}" @endif>
                </div>
              </div>
              <div class="row mb-3">
                <label for="kode_pos" class="col-sm-2 col-form-label">Kode Pos</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="kode_pos" name="kode_pos" @if($keterangan != 'baru') value="{{ $data->kode_pos ?? '' }}" @endif>
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

<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('#kota').on('change', function() {
    let kota_id = $('#kota').val();
    $("#kecamatan").attr("disabled", false);
    $.ajax({
      type: 'POST',
      url: "{{route('selectKecamatan')}}",
      data: {kota_id:kota_id},
      cache: false,
      success: function(message) {
        $('#kecamatan').html(message);
        console.log(message);
      },
      error: function(data) {
        console.log('error: ', data);
      }
    })
  });
</script>

@endsection