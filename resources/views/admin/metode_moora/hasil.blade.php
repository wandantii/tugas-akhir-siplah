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
  
    <div class="card">
      <div class="card-body">
        <div class="search-bar text-center row py-3">
          <h5 class="card-title"><strong>CARI BARANG ATAU JASA</strong></h5>
          <form class="search col-sm" method="POST" action="{{ url('admin/metode-moora') }}">
          @csrf
            <input type="text" id="querysearch" name="querysearch" placeholder="Cari barang atau jasa" title="Tuliskan keyword" class="addon-search" style="border:1px solid #dee2e6; padding:15px 25px; border-radius:15px 0px 0px 15px; width:90%;" @if(isset($searchProduk)) value="{{$searchProduk}}" @endif>
            <button type="submit" title="Search" style="border:1px solid #5667f2; padding:15px 25px; border-radius:0px 15px 15px 0px; background-color:#5667f2; color:#fff; box-shadow: 0 0 10px 0 rgba(1, 41, 112, 0.15);"><i class="bi bi-search"></i></button>
          </form>
        </div>
      </div>
    </div><!-- End Search Bar -->

    @foreach($rank_sorted as $key=>$sorted)
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">{{ $key }}</h5>  
        <div class="scroll-container">
          @foreach($sorted as $key=>$produk)
          <div class="scroll mb-3">
            <div class="mx-2 text-center" style="width:15rem">
              <img @if(isset($produk->foto_produk)) src="{{ asset('produk/'.$produk->foto_produk) }}" @else src="{{ asset('produk/blank.jpg') }}" @endif alt="Foto Produk" width="100%" style="display:block;">
              <span class="badge bg-danger block m-2">Rank {{ $produk->rank }}</span>
              <p class="fw-bold text-dark block" style="white-space:pre-line;line-height:normal;height:30px;">{{ Str::limit($produk->nama, 40) }}</p>
              <span style="display:block;">Rp {{ number_format($produk->harga, 2, ",", ".") }}</span>
              <a class="btn btn-primary btn-sm rounded-pill block m-2 px-3" href="{{ $produk->url }}" target="_blank">Lihat Produk</a>
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