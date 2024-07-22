@extends('front.layout')
@section('content')

<main id="main" class="pt-5">

  <section id="contact" class="contact mt-3">
    <div class="container" data-aos="fade-up">
      <header class="section-header">
        <h2>Profil</h2>
        <p>Data Satuan Pendidikan</p>
      </header>
      <div class="row gy-4">
        <div class="col-lg-6">
          <div class="p-4">
            <div class="img text-center">
              <img @if(isset($data_profil->foto_profil)) src="{{ asset('user/'.$data_profil->foto_profil) }}" @else src="{{ asset('user/blank.jpg') }}" @endif class="rounded-circle" alt="Foto Profil" width="300rem">
              <h4 style="color:#012970;" class="mt-3">{{ $data_profil->user->nama ?? '' }}</h4>
              <small>{{ $data_profil->tentang ?? '' }}</small>
            </div>
            <div class="mt-3 mx-3">
              <p class="m-2">
                <span class="mx-2"><i class="bi bi-geo-alt"></i></span>
                {{ $data_profil->alamat.',' ?? '' }}
                {{ $data_profil->kecamatan->kecamatan.',' ?? '' }}
                {{ $data_profil->kota->kota ?? '' }}
                {{ $data_profil->kode_pos ?? '' }}
              </p>
              <p class="m-2">
                <span class="mx-2"><i class="bi bi-telephone"></i></span>
                {{ $data_profil->nomor_telepon ?? '' }}
              </p>
              <p class="m-2">
                <span class="mx-2"><i class="bi bi-envelope"></i></span>
                {{ $data_profil->user->email ?? '' }}
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
        @if(!isset($data_profil))
          <form method="POST" action="{{ url('profil/store') }}" enctype="multipart/form-data">
        @elseif(isset($data_profil))
          <form method="POST" action="{{ url('profil/update/'.$data_profil->profil_id ) }}" enctype="multipart/form-data">
            @csrf {{ method_field('PUT') }}
        @endif
            <div class="row p-4" style="background:#fafbff;">
              <div class="col-md-12">
                <h6 for="tentang" class="fw-bold m-0 p-0" style="color:#012970;">Foto Profil</h6>
                <input class="form-control" type="file" id="foto_profil" name="foto_profil" value="{{ $data->foto_profil ?? '' }}">
              </div>
              <div class="col-md-12">
                <h6 for="nama" class="fw-bold m-0 p-0" style="color:#012970;">Nama</h6>
                <input name="nama" type="text" class="form-control" id="nama" value="{{ $data_profil->user->nama ?? '' }}">
              </div>
              <div class="col-md-12">
                <h6 for="tentang" class="fw-bold m-0 p-0" style="color:#012970;">Tentang</h6>
                <textarea name="tentang" class="form-control" id="tentang" style="height:100px">{{ $data_profil->tentang ?? '' }}</textarea>
              </div>
              <div class="col-md-12">
                <h6 for="kota" class="fw-bold m-0 p-0" style="color:#012970;">Kota</h6>
                <select class="form-select" aria-label="Default select example" id="kota" name="kota">
                <option selected="true" disabled="disabled">Pilih Kota</option>
                  @foreach($data_kota as $key=>$kota)
                    <option value="{{ $kota->kota_id }}" @if(isset($data_profil->kota_id)) {{ ($kota->kota_id == $data_profil->kota_id) ? 'Selected' : ''}} @endif>{{ $kota->kota }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-12">
                <h6 for="kecamatan" class="fw-bold m-0 p-0" style="color:#012970;">Kecamatan</h6>
                <select class="form-select" aria-label="Default select example" id="kecamatan" name="kecamatan" disabled>
                  <option selected="true" disabled="disabled">Pilih Kecamatan</option>
                </select>
              </div>
              <div class="col-md-12">
                <h6 for="alamat" class="fw-bold m-0 p-0" style="color:#012970;">Alamat Lengkap</h6>
                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $data_profil->alamat ?? '' }}">
              </div>
              <div class="col-md-6">
                <h6 for="kode_pos" class="fw-bold m-0 p-0" style="color:#012970;">Kode Pos</h6>
                <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="{{ $data_profil->kode_pos ?? '' }}">
              </div>
              <div class="col-md-6">
                <h6 for="nomor_telepon" class="fw-bold m-0 p-0" style="color:#012970;">Nomor Telepon</h6>
                <input name="nomor_telepon" type="text" class="form-control" id="nomor_telepon" value="{{ $data_profil->nomor_telepon ?? '' }}">
              </div>
              
              <div class="col-md-12">
                <button type="submit" class="btn btn-sm px-2 py-1" style="background-color:#012970;color:#fff;">
                  <span>Simpan</span>
                </button>
              </div>
            </div>
          </form>
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

  @if(isset($data_profil))
  $(window).on('load', function() {
    let kota_id = $('#kota').val();
    var kecamatan_id = {{ $data_profil->kecamatan_id }};
    console.log(kecamatan_id);
    $("#kecamatan").attr("disabled", false);
    $.ajax({
      type: 'POST',
      url: "{{route('selectKecamatan')}}",
      data: {kota_id:kota_id},
      cache: false,
      success: function(message) {
        $('#kecamatan').html(message);
        $('#kecamatan').val(kecamatan_id);
      },
      error: function(data) {
        console.log('error: ', data);
      }
    })
  });
  @endif

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
      },
      error: function(data) {
        console.log('error: ', data);
      }
    })
  });
</script>

@endsection