@extends('admin.layout')
@section('content')

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">
        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            <img @if(isset($data_profil->foto_profil)) src="{{ asset('user/'.$data_profil->foto_profil) }}" @else src="{{ asset('user/blank.jpg') }}" @endif class="rounded-circle" alt="Foto Profil" width="350px" class="mb-10">
            <h2>{{ $data_profil->user->nama ?? '-' }}</h2>
            <h3>{{ $data_profil->alamat ?? '-' }}, {{ $data_profil->kecamatan->kecamatan ?? '-' }}, {{ $data_profil->kota->kota ?? '-' }}</h3>
            <!-- <div class="social-links mt-2">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div> -->
          </div>
        </div>
      </div>

      <div class="col-xl-8">
        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">
              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li>
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
              </li>
              <!-- <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
              </li> -->
            </ul>

            <div class="tab-content pt-2">
              
              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <h5 class="card-title">Tentang</h5>
                <p class="small fst-italic">{{ $data_profil->tentang ?? '-' }}</p>
                <h5 class="card-title">Detail Profil</h5>
                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Nama</div>
                  <div class="col-lg-9 col-md-8">{{ $data_profil->user->nama ?? '-' }}</div>
                </div>
                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Alamat</div>
                  <div class="col-lg-9 col-md-8">{{ $data_profil->alamat ?? '-' }}, {{ $data_profil->kota->kota ?? '-' }}, {{ $data_profil->kecamatan->kecamatan ?? '-' }} {{ $data_profil->kode_pos ?? '-' }}</div>
                </div>
              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                <!-- Profile Edit Form -->
                @if(!isset($data_profil))
                <form method="POST" action="{{ url('admin/profil/store') }}" enctype="multipart/form-data">
                  @csrf
                    @if(isset($data_profil_latest))
                    <input type="text" id="profil_id" name="profil_id" value="{{ $data_profil_latest->profil_id+1 }}">
                    @else
                    <input type="text" id="profil_id" name="profil_id" value="1">
                    @endif
                @elseif(isset($data_profil))
                <form method="POST" action="{{ url('admin/profil/update/'.$data_profil->profil_id ) }}" enctype="multipart/form-data">
                  @csrf {{ method_field('PUT') }}
                @endif
                  <div class="row mb-3">
                    <label for="profileImage" class="col-sm-2 col-form-label">Foto Profil</label>
                    <div class="col-sm-10">
                      @if(isset($data_profil->foto_profil))
                      <img src="{{ asset('user/'.$data_profil->foto_profil ?? '') }}" alt="Foto Profil" width="350px" class="mb-2">
                      @endif
                      <input class="form-control" type="file" id="foto_profil" name="foto_profil" value="{{ $data->foto_profil ?? '' }}">
                      <!-- <div class="">
                        <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                        <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                      </div> -->
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                      <input name="nama" type="text" class="form-control" id="nama" value="{{ $data_profil->user->nama ?? '' }}">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="tentang" class="col-sm-2 col-form-label">Tentang</label>
                    <div class="col-sm-10">
                      <textarea name="tentang" class="form-control" id="tentang" style="height:100px">{{ $data_profil->tentang ?? '' }}</textarea>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="kota" class="col-sm-2 col-form-label">Kota</label>
                    <div class="col-sm-10">
                      <select class="form-select" aria-label="Default select example" id="kota" name="kota">
                      <option selected="true" disabled="disabled">Pilih Kota</option>
                        @foreach($data_kota as $key=>$kota)
                          <option value="{{ $kota->kota_id }}" @if(isset($data_profil->kota_id)) {{ ($kota->kota_id == $data_profil->kota_id) ? 'Selected' : ''}} @endif>{{ $kota->kota }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>
                    <div class="col-sm-10">
                      <select class="form-select" aria-label="Default select example" id="kecamatan" name="kecamatan" disabled>
                        <option selected="true" disabled="disabled">Pilih Kecamatan</option>
                      </select>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $data_profil->alamat ?? '' }}">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="kode_pos" class="col-sm-2 col-form-label">Kode Pos</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="{{ $data_profil->kode_pos ?? '' }}">
                    </div>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                  </div>
                </form><!-- End Profile Edit Form -->
              </div>

              <!-- <div class="tab-pane fade pt-3" id="profile-change-password">
                <form>
                  <div class="row mb-3">
                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="password" type="password" class="form-control" id="currentPassword">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="newpassword" type="password" class="form-control" id="newPassword">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                    </div>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                  </div>
                </form>
              </div> -->

            </div><!-- End Bordered Tabs -->
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