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
                @foreach($data_kriteria as $key=>$kriteria)
                <span>C{{ $key+1 }} : {{ $kriteria->nama ?? ''}}</span><br>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    @foreach($rank_sorted as $key=>$sorted)
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">{{ $key }}</h5>  
        <div class="scroll-container">
          @foreach($sorted as $key=>$produk)
            <div class="scroll">
              <div class="mx-2 text-center" style="width:15rem">
                <img @if(isset($produk->foto_produk)) src="{{ asset('produk/'.$produk->foto_produk) }}" @else src="{{ asset('produk/blank.jpg') }}" @endif alt="Foto Produk" width="100%" style="display:block;">
                <span class="badge bg-primary block m-2">Rank {{ $produk->rank }}</span>
                <p class="fw-bold text-dark block" style="white-space:pre-line;line-height:normal;height:30px;">{{ Str::limit($produk->nama, 40) }}</p>
                <span class="block">Rp {{ number_format($produk->harga, 2, ",", ".") }}</span>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
    @endforeach
    
  </section>
</main><!-- End #main -->

@endsection