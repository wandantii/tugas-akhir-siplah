@extends('admin.layout')
@section('content')

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Data Metode BWM</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('admin') }}"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item">Data Perhitungan</li>
        <li class="breadcrumb-item active">Metode BWM</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section">

    <div class="card">
      <div class="card-body row pb-0">
        <table class="col-sm m-4">
          <tr style="vertical-align:top;">
            <th style="width:13%;">Langkah Pertama</th>
            <th style="width:2%;">:</th>
            <td style="width:85%;">
              Download template BWM Solver melalui tombol di bawah ini.<br>
              <a class="btn btn-success" href="{{ url('admin/metode-bwm/download-template') }}">Download Template BWM Solver</a><br>
              Buka dan lakukan penyesuaian. Anda hanya diperbolehkan untuk <strong>mengubah kolom-kolom yang berwarna hijau</strong> saja.
            </td>
          </tr>
          <tr>
            <th>Langkah Kedua</th>
            <th>:</th>
            <td>Pilih <strong>Select the Best</strong> sesuai keinginan.</td>
          </tr>
          <tr>
            <th>Langkah Ketiga</th>
            <th>:</th>
            <td>Pilih <strong>Select the Worst</strong> sesuai keinginan</td>
          </tr>
          <tr>
            <th>Langkah Keempat</th>
            <th>:</th>
            <td>Pilih nilai untuk <strong>Best to Others</strong> sesuai keinginan</td>
          </tr>
          <tr>
            <th>Langkah Kelima</th>
            <th>:</th>
            <td>Pilih nilai untuk <strong>Others to the Worst</strong> sesuai keinginan</td>
          </tr>
          <tr>
            <th>Langkah Keenam</th>
            <th>:</th>
            <td>Klik tab <strong>Data</strong> pada menu, kemudian pilih <strong>Solver</strong></td>
          </tr>
          <tr>
            <th>Langkah Ketujuh</th>
            <th>:</th>
            <td>Klik <strong>Solver</strong> pada bagian bawah, kemudian pilih <strong>OK</strong></td>
          </tr>
          <tr>
            <th>Langkah kedelapan</th>
            <th>:</th>
            <td>Silahkan input file excel yang telah diperbarui sebelumnya pada tombol input di bawah ini, lalu klik <strong>Submit</strong></td>
          </tr>
        </table>
      </div>
    </div>

    <div class="card">
      <div class="card-body row pb-0">
        <h5 class="card-title mx-4 mb-0 pb-0">Input Excel BWMSolver</h5>
        <form class="col-sm m-3" method="POST" action="{{ url('admin/metode-bwm') }}" enctype="multipart/form-data">
        @csrf
          <div class="row">
            <div class="col-4">
              <input class="form-control" type="file" id="solver" name="solver">
            </div>
            <button class="col-2 btn btn-primary" type="submit" title="Search">Submit</button>
            <small class="text-secondary">*) Pastikan data sudah sesuai dan hanya mengubah kolom berwarna hijau saja</small>
          </div>
        </form>
      </div>
    </div>

    @if(isset($solver))
    <div class="card">
      <div class="card-body">
        <h5 class="card-title text-center">Metode BWM dengan BWMSolver</h5>
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
            <td class="bg-warning">{{ $solver->c1 ?? '' }}</td>
            <td class="bg-warning">{{ $solver->c2 ?? '' }}</td>
            <td class="bg-warning">{{ $solver->c3 ?? '' }}</td>
            <td class="bg-warning">{{ $solver->c4 ?? '' }}</td>
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
            <td class="bg-success text-light">{{ $solver->type_c1 ?? '' }}</td>
            <td class="bg-success text-light">{{ $solver->type_c2 ?? '' }}</td>
            <td class="bg-success text-light">{{ $solver->type_c3 ?? '' }}</td>
            <td class="bg-success text-light">{{ $solver->type_c4 ?? '' }}</td>
          </tr>
        </table>
        <table class="table table-bordered text-center" style="width:50%;">
          <tr>
            <th style="width:60%;">Best Criteria</th>
            <td class="bg-success text-light" style="width:40%;">{{ $solver->best ?? '' }}</td>
          </tr>
        </table>
        <table class="table table-bordered text-center" style="width:50%;">
          <tr>
            <th style="width:60%;">Worst Criteria</th>
            <td class="bg-success text-light" style="width:40%;">{{ $solver->worst ?? '' }}</td>
          </tr>
        </table>
        <table class="table table-bordered text-center">
          <tr>
            <th>Best to Others</th>
            <th>{{ $solver->c1 ?? '' }}</th>
            <th>{{ $solver->c2 ?? '' }}</th>
            <th>{{ $solver->c3 ?? '' }}</th>
            <th>{{ $solver->c4 ?? '' }}</th>
          </tr>
          <tr>
            <th>{{ $solver->best ?? '' }}</th>
            <td class="bg-success text-light">{{ $solver->best_to_c1 ?? '' }}</td>
            <td class="bg-success text-light">{{ $solver->best_to_c2 ?? '' }}</td>
            <td class="bg-success text-light">{{ $solver->best_to_c3 ?? '' }}</td>
            <td class="bg-success text-light">{{ $solver->best_to_c4 ?? '' }}</td>
          </tr>
        </table>
        <table class="table table-bordered text-center" style="width:50%;">
          <tr>
            <th>Others to the Worst</th>
            <th>{{ $solver->worst ?? '' }}</th>
          </tr>
          <tr>
            <th>{{ $solver->c1 ?? '' }}</th>
            <td class="bg-success text-light">{{ $solver->c1_to_worst ?? '' }}</td>
          </tr>
          <tr>
            <th>{{ $solver->c2 ?? '' }}</th>
            <td class="bg-success text-light">{{ $solver->c2_to_worst ?? '' }}</td>
          </tr>
          <tr>
            <th>{{ $solver->c3 ?? '' }}</th>
            <td class="bg-success text-light">{{ $solver->c3_to_worst ?? '' }}</td>
          </tr>
          <tr>
            <th>{{ $solver->c4 ?? '' }}</th>
            <td class="bg-success text-light">{{ $solver->c4_to_worst ?? '' }}</td>
          </tr>
        </table>
        <table class="table table-bordered text-center">
          <tr style="vertical-align:middle;">
            <th rowspan="2">Weights</th>
            <th>{{ $solver->c1 ?? '' }}</th>
            <th>{{ $solver->c2 ?? '' }}</th>
            <th>{{ $solver->c3 ?? '' }}</th>
            <th>{{ $solver->c4 ?? '' }}</th>
          </tr>
          <tr>
            <td class="bg-warning">{{ $solver->weight_c1 ?? '' }}</td>
            <td class="bg-warning">{{ $solver->weight_c2 ?? '' }}</td>
            <td class="bg-warning">{{ $solver->weight_c3 ?? '' }}</td>
            <td class="bg-warning">{{ $solver->weight_c4 ?? '' }}</td>
          </tr>
        </table>
        <table class="table table-bordered text-center" style="width:50%;">
          <tr>
            <th style="width:60%;">Ksi*</th>
            <td class="bg-warning" style="width:40%;">{{ $solver->ksi ?? '' }}</td>
          </tr>
        </table>
      </div>
    </div>
    @endif
    
  </section>
</main><!-- End #main -->

@endsection