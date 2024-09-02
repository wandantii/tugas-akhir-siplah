@extends('front.layout')
@section('content')

<main id="main" class="pt-5">

@if(!isset($data_profil))

  <section id="" class="mt-3">
    <div class="container" data-aos="fade-up">
      <header class="section-header">
        <h2>Metode Best-Worst Method</h2>
        <p>Aduh! Maaf ya...</p>
        <small>{{ $message['data_profil'] ?? '' }}</small>
      </div>
    </div>
  </section>

@else

  <section id="values" class="values mt-3">
    <div class="container" data-aos="fade-up">
      <header class="section-header">
        <h2>Metode Best-Worst Method</h2>
        <p>Masukkan Kriteria Produk</p>
        <small class="text-secondary">Harap ikuti langkah-langkah di bawah ini agar sistem dapat menampilkan produk yang cocok untuk Anda.</small>
      </header>
      <div class="row">
        <div class="col-6 col-lg-6 col-md-12" data-aos="fade-up" data-aos-delay="200">
          <div class="box">
            <h3>Step 1</h3>
            <p class="pb-0 mb-0">Download template BWM Solver melalui tombol di bawah ini</p>
            <a class="btn btn-success mt-0" href="{{ url('metodebwm/download-template') }}">Download Template BWM Solver</a>
          </div>
        </div>
        <div class="col-6 col-lg-6 col-md-12" data-aos="fade-up" data-aos-delay="200">
          <div class="box">
            <h3>Step 2</h3>
            <p>Buka dan lakukan penyesuaian. Anda hanya diperbolehkan untuk <strong>mengubah kolom-kolom yang berwarna hijau</strong> saja.</p>
          </div>
        </div>
        <div class="col-6 col-lg-6 col-md-12" data-aos="fade-up" data-aos-delay="200">
          <div class="box">
            <h3>Step 3</h3>
            <p>Pilih <strong>Select the Best</strong> sesuai keinginan</p>
          </div>
        </div>
        <div class="col-6 col-lg-6 col-md-12" data-aos="fade-up" data-aos-delay="200">
          <div class="box">
            <h3>Step 4</h3>
            <p>Pilih <strong>Select the Worst</strong> sesuai keinginan</p>
          </div>
        </div>
        <div class="col-6 col-lg-6 col-md-12" data-aos="fade-up" data-aos-delay="200">
          <div class="box">
            <h3>Step 5</h3>
            <p>Pilih nilai untuk <strong>Best to Others</strong> sesuai keinginan</p>
          </div>
        </div>
        <div class="col-6 col-lg-6 col-md-12" data-aos="fade-up" data-aos-delay="200">
          <div class="box">
            <h3>Step 6</h3>
            <p>Pilih nilai untuk <strong>Others to the Worst</strong> sesuai keinginan</p>
          </div>
        </div>
        <div class="col-6 col-lg-6 col-md-12" data-aos="fade-up" data-aos-delay="200">
          <div class="box">
            <h3>Step 7</h3>
            <p>Klik tab <strong>Data</strong> pada menu, kemudian pilih <strong>Solver</strong></p>
          </div>
        </div>
        <div class="col-6 col-lg-6 col-md-12" data-aos="fade-up" data-aos-delay="200">
          <div class="box">
            <h3>Step 8</h3>
            <p>Klik <strong>Solver</strong> pada bagian bawah, kemudian pilih <strong>OK</strong></p>
          </div>
        </div>
        <div class="col-6 col-lg-6 col-md-12" data-aos="fade-up" data-aos-delay="200">
          <div class="box">
            <h3>Step 9</h3>
            <p>Silahkan input file excel yang telah diperbarui sebelumnya pada form di bawah ini, lalu klik <strong>Submit</strong></p>
          </div>
        </div>
        <div class="col-6 col-lg-6 col-md-12" data-aos="fade-up" data-aos-delay="200">
          <div class="box">
            <h3>Step 10</h3>
            <p>Lihat hasil perhitungan produk yang sesuai dengan kebutuhan Anda pada halaman <strong>Cari Produk</strong></p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="" class="" style="background:#fafbff;">
    <div class="">
      <div class="container">
        <div class="row justify-content-center">
          <header class="section-header">
            <p>Form BWMSolver</p>
            <small class="text-secondary">Pastikan excel yang Anda ubah sudah sesuai keperluan dan ketentuan sistem<br>Hal ini diperlukan agar sistem bisa melakukan perhitungan dan menampilkan produk yang sesuai</small>
          </header>
          <div class="col-lg-6">
            <form class="row p-0" method="POST" action="{{ url('metodebwm') }}" enctype="multipart/form-data">
            @csrf
              <input class="form-control" style="border-radius:0px;width:70%;float:left;" type="file" id="solver" name="solver">
              <button class="btn btn-primary" style="border-radius:0px;width:30%;float:right;" type="submit" title="Search">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  @if(isset($data_solver))
  <section id="values" class="values">
    <div class="container" data-aos="fade-up">
      <header class="section-header">
        <h2>Hasil Solver</h2>
        <p>Metode BWM dengan BWMSolver</p>
      </header>
      <div class="row">
        <div class="col-lg-12" data-aos="fade-up" data-aos-delay="200">
          <div class="box">
            <table class="table table-bordered text-center">
              <tr>
                <th>Criteria Number</th>
                <th>Criterion 1</th>
                <th>Criterion 2</th>
                <th>Criterion 3</th>
                <th>Criterion 4</th>
              </tr>
              <tr>
                <th>Names of Criteria</th>
                <td class="bg-warning">{{ $data_solver->c1 ?? '' }}</td>
                <td class="bg-warning">{{ $data_solver->c2 ?? '' }}</td>
                <td class="bg-warning">{{ $data_solver->c3 ?? '' }}</td>
                <td class="bg-warning">{{ $data_solver->c4 ?? '' }}</td>
              </tr>
              <tr>
                <th>Code of Criteria</th>
                <td class="bg-warning">C1</td>
                <td class="bg-warning">C2</td>
                <td class="bg-warning">C3</td>
                <td class="bg-warning">C4</td>
              </tr>
              <tr>
                <th>Types of Criteria</th>
                <td class="bg-success text-light">{{ $data_solver->type_c1 ?? '' }}</td>
                <td class="bg-success text-light">{{ $data_solver->type_c2 ?? '' }}</td>
                <td class="bg-success text-light">{{ $data_solver->type_c3 ?? '' }}</td>
                <td class="bg-success text-light">{{ $data_solver->type_c4 ?? '' }}</td>
              </tr>
            </table>
            <table class="table table-bordered text-center" style="width:50%;">
              <tr>
                <th style="width:60%;">Best Criteria</th>
                <td class="bg-success text-light" style="width:40%;">{{ $data_solver->best ?? '' }}</td>
              </tr>
            </table>
            <table class="table table-bordered text-center" style="width:50%;">
              <tr>
                <th style="width:60%;">Worst Criteria</th>
                <td class="bg-success text-light" style="width:40%;">{{ $data_solver->worst ?? '' }}</td>
              </tr>
            </table>
            <table class="table table-bordered text-center">
              <tr>
                <th>Best to Others</th>
                <th>{{ $data_solver->c1 ?? '' }}</th>
                <th>{{ $data_solver->c2 ?? '' }}</th>
                <th>{{ $data_solver->c3 ?? '' }}</th>
                <th>{{ $data_solver->c4 ?? '' }}</th>
              </tr>
              <tr>
                <th>{{ $data_solver->best ?? '' }}</th>
                <td class="bg-success text-light">{{ $data_solver->best_to_c1 ?? '' }}</td>
                <td class="bg-success text-light">{{ $data_solver->best_to_c2 ?? '' }}</td>
                <td class="bg-success text-light">{{ $data_solver->best_to_c3 ?? '' }}</td>
                <td class="bg-success text-light">{{ $data_solver->best_to_c4 ?? '' }}</td>
              </tr>
            </table>
            <table class="table table-bordered text-center" style="width:50%;">
              <tr>
                <th>Others to the Worst</th>
                <th>{{ $data_solver->worst ?? '' }}</th>
              </tr>
              <tr>
                <th>{{ $data_solver->c1 ?? '' }}</th>
                <td class="bg-success text-light">{{ $data_solver->c1_to_worst ?? '' }}</td>
              </tr>
              <tr>
                <th>{{ $data_solver->c2 ?? '' }}</th>
                <td class="bg-success text-light">{{ $data_solver->c2_to_worst ?? '' }}</td>
              </tr>
              <tr>
                <th>{{ $data_solver->c3 ?? '' }}</th>
                <td class="bg-success text-light">{{ $data_solver->c3_to_worst ?? '' }}</td>
              </tr>
              <tr>
                <th>{{ $data_solver->c4 ?? '' }}</th>
                <td class="bg-success text-light">{{ $data_solver->c4_to_worst ?? '' }}</td>
              </tr>
            </table>
            <table class="table table-bordered text-center">
              <tr style="vertical-align:middle;">
                <th rowspan="2">Weights</th>
                <th>{{ $data_solver->c1 ?? '' }}</th>
                <th>{{ $data_solver->c2 ?? '' }}</th>
                <th>{{ $data_solver->c3 ?? '' }}</th>
                <th>{{ $data_solver->c4 ?? '' }}</th>
              </tr>
              <tr>
                <td class="bg-warning">{{ $data_solver->weight_c1 ?? '' }}</td>
                <td class="bg-warning">{{ $data_solver->weight_c2 ?? '' }}</td>
                <td class="bg-warning">{{ $data_solver->weight_c3 ?? '' }}</td>
                <td class="bg-warning">{{ $data_solver->weight_c4 ?? '' }}</td>
              </tr>
            </table>
            <table class="table table-bordered text-center" style="width:50%;">
              <tr>
                <th style="width:60%;">Ksi*</th>
                <td class="bg-warning" style="width:40%;">{{ $data_solver->ksi ?? '' }}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endif
@endif

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