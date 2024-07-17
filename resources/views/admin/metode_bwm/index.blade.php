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
      <div class="card-body row">
        <div class="col-sm">
          <p>
            <strong>Step 1 :</strong> Download template BWM Solver melalui tombol di bawah ini<br>
            <a class="btn btn-success" href="{{ url('admin/metode-bwm/download-template') }}">Download Template BWM Solver</a><br>
            <strong>Step 2 :</strong> Pilih <strong>Select the Best</strong> sesuai keinginan<br>
            <strong>Step 3 :</strong> Pilih <strong>Select the Worst</strong> sesuai keinginan<br>
            <strong>Step 4 :</strong> Pilih nilai untuk <strong>Best to Others</strong> sesuai keinginan<br>
            <strong>Step 5 :</strong> Pilih nilai untuk <strong>Others to the Worst</strong> sesuai keinginan<br>
          </p>
        </div>
      </div>
    </div><!-- End Search Bar -->

    <div class="card">
      <div class="card-body">
        <div class="search-bar row py-3">
          <div class="row mx-3">
            <form class="row" method="POST" action="{{ url('admin/metode-bwm') }}" enctype="multipart/form-data">
            @csrf
              <div class="col-4">
                <input class="form-control" type="file" id="solver" name="solver">
              </div>
              <button class="col-2 btn btn-primary" type="submit" title="Search">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div><!-- End Search Bar -->

    @if(isset($solver))
    <div class="card">
      <div class="card-body">
        <div class="search-bar text-center row py-3">
          {{ $solver }}
        </div>
      </div>
    </div>
    @endif
    
  </section>
</main><!-- End #main -->

@endsection