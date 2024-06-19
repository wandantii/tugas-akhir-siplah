@extends('admin.layout')
@section('content')

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Data Metode Moora</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('admin') }}"><i class="bi bi-house-door"></i></a></li>
        <li class="breadcrumb-item">Data Perhitungan</li>
        <li class="breadcrumb-item active">Metode Moora</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row" style="padding-top:25px;">
              <div class="col-sm">
                <h5><b>Dengan keterangan sebagai berikut</b></h5>
                @php $nomorurut = 1; @endphp
                @foreach($kriteria as $dkriteria)
                <span>C{{ $nomorurut++ }} : {{ $dkriteria->nama ?? ''}}</span><br>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-body" style="margin:auto;">
        <div class="search-bar" style="padding:25px 25px 0px 25px;">
          <form class="search d-flex align-items-center" method="POST" action="{{ url('admin/metode-moora') }}" style="margin:auto;">
          @csrf
            <input type="text" id="querysearch" name="querysearch" placeholder="Cari barang atau jasa" title="Tuliskan keyword" class="addon-search" style="border:1px solid #dee2e6; padding:15px 25px; border-radius:15px 0px 0px 15px; width:25rem;">
            <button type="submit" title="Search" style="border:1px solid #5667f2; padding:15px 25px; border-radius:0px 15px 15px 0px; background-color:#5667f2; color:#fff; box-shadow: 0 0 10px 0 rgba(1, 41, 112, 0.15);"><i class="bi bi-search"></i></button>
          </form>
        </div>
      </div>
    </div><!-- End Search Bar -->
    
  </section>
</main><!-- End #main -->

@endsection