@extends('front.layout')
@section('content')

<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">
  <div class="container">
    <div class="row" style="padding-top:50px;">
      <div class="col-lg-6 d-flex flex-column justify-content-center">
        <h1 data-aos="fade-up">Situs Informasi Pengadaan Barang dan Jasa Satuan Pendidikan</h1>
        <hr>
        <p data-aos="fade-up" data-aos-delay="400">Kami menawarkan solusi modern untuk membantu Anda menemukan pemasok terbaik dalam satu wilayah</p>
        @if(!Session::has('loginId'))
        <div data-aos="fade-up" data-aos-delay="600">
          <div class="text-center text-lg-start">
            <a href="{{ url('login') }}" class="btn-get-started d-inline-flex align-items-center justify-content-center align-self-center">
              <span>Mulai</span>
              <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>
        @endif
      </div>
      <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
        <img src="{{ asset('img/hero-img.png') }}" class="img-fluid" alt="">
      </div>
    </div>
  </div>
</section><!-- End Hero -->

<main id="main">

  <!-- ======= Counts Section ======= -->
  <section id="counts" class="counts">
    <div class="container" data-aos="fade-up">
      <div class="row gy-4">
        <div class="col-lg-3 col-md-6">
          <div class="count-box">
            <i class="bi bi-emoji-smile"></i>
            <div>
              <span data-purecounter-start="0" data-purecounter-end="25" data-purecounter-duration="1" class="purecounter"></span>
              <p>Supplier Terpercaya</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="count-box">
            <i class="bi bi-journal-richtext" style="color: #ee6c20;"></i>
            <div>
              <span data-purecounter-start="0" data-purecounter-end="500" data-purecounter-duration="1" class="purecounter"></span>
              <p>Produk Terdaftar</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="count-box">
            <i class="bi bi-headset" style="color: #15be56;"></i>
            <div>
              <span data-purecounter-start="0" data-purecounter-end="24" data-purecounter-duration="1" class="purecounter"></span>
              <p>Jam Akses Website</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="count-box">
            <i class="bi bi-people" style="color: #bb0852;"></i>
            <div>
              <span data-purecounter-start="0" data-purecounter-end="1000" data-purecounter-duration="1" class="purecounter"></span>
              <p>Transaksi</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section><!-- End Counts Section -->

  <!-- ======= Values Section ======= -->
  <section id="values" class="values">
    <div class="container" data-aos="fade-up">
      <header class="section-header">
        <h2>Misi Kami</h2>
        <p>Sistem Informasi Pengadaan untuk Satuan Pendidikan</p>
      </header>
      <div class="row">
        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
          <div class="box">
            <img src="assets/img/values-1.png" class="img-fluid" alt="">
            <h3>Lebih Mudah</h3>
            <p>Mempermudah Pencarian Sarana dan Prasarana Pendidikan Indonesia.</p>
          </div>
        </div>
        <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="400">
          <div class="box">
            <img src="assets/img/values-2.png" class="img-fluid" alt="">
            <h3>Supplier Terpercaya</h3>
            <p>Meminimalisir adanya kecurangan transaksi dari supplier.</p>
          </div>
        </div>
        <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="600">
          <div class="box">
            <img src="assets/img/values-3.png" class="img-fluid" alt="">
            <h3>Hemat Tenaga</h3>
            <p>Tidak butuh waktu lama mencari produk yang sesuai dan bagus.</p>
          </div>
        </div>
      </div>
    </div>
  </section><!-- End Values Section -->

</main><!-- End #main -->

@endsection