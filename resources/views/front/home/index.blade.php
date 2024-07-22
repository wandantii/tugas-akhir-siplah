@extends('front.layout')
@section('content')

<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 d-flex flex-column justify-content-center">
        <h1 data-aos="fade-up">Situs Informasi Pengadaan Barang dan Jasa Satuan Pendidikan</h1>
        <h2 data-aos="fade-up" data-aos-delay="400">Kami menawarkan solusi modern untuk membantu Anda menemukan pemasok terbaik dalam satu wilayah</h2>
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
              <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>
              <p>Happy Clients</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="count-box">
            <i class="bi bi-journal-richtext" style="color: #ee6c20;"></i>
            <div>
              <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
              <p>Projects</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="count-box">
            <i class="bi bi-headset" style="color: #15be56;"></i>
            <div>
              <span data-purecounter-start="0" data-purecounter-end="1463" data-purecounter-duration="1" class="purecounter"></span>
              <p>Hours Of Support</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="count-box">
            <i class="bi bi-people" style="color: #bb0852;"></i>
            <div>
              <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter"></span>
              <p>Hard Workers</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section><!-- End Counts Section -->

  <!-- ======= Services Section ======= -->
  <section id="services" class="services">
    <div class="container" data-aos="fade-up">
      <header class="section-header">
        <h2>Services</h2>
        <p>Veritatis et dolores facere numquam et praesentium</p>
      </header>
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
          <div class="service-box blue">
            <i class="ri-discuss-line icon"></i>
            <h3>Nesciunt Mete</h3>
            <p>Provident nihil minus qui consequatur non omnis maiores. Eos accusantium minus dolores iure perferendis tempore et consequatur.</p>
            <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
          <div class="service-box orange">
            <i class="ri-discuss-line icon"></i>
            <h3>Eosle Commodi</h3>
            <p>Ut autem aut autem non a. Sint sint sit facilis nam iusto sint. Libero corrupti neque eum hic non ut nesciunt dolorem.</p>
            <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
          <div class="service-box green">
            <i class="ri-discuss-line icon"></i>
            <h3>Ledo Markt</h3>
            <p>Ut excepturi voluptatem nisi sed. Quidem fuga consequatur. Minus ea aut. Vel qui id voluptas adipisci eos earum corrupti.</p>
            <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
          <div class="service-box red">
            <i class="ri-discuss-line icon"></i>
            <h3>Asperiores Commodi</h3>
            <p>Non et temporibus minus omnis sed dolor esse consequatur. Cupiditate sed error ea fuga sit provident adipisci neque.</p>
            <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
          <div class="service-box purple">
            <i class="ri-discuss-line icon"></i>
            <h3>Velit Doloremque.</h3>
            <p>Cumque et suscipit saepe. Est maiores autem enim facilis ut aut ipsam corporis aut. Sed animi at autem alias eius labore.</p>
            <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="700">
          <div class="service-box pink">
            <i class="ri-discuss-line icon"></i>
            <h3>Dolori Architecto</h3>
            <p>Hic molestias ea quibusdam eos. Fugiat enim doloremque aut neque non et debitis iure. Corrupti recusandae ducimus enim.</p>
            <a href="#" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </section><!-- End Services Section -->

  <!-- ======= Values Section ======= -->
  <section id="values" class="values">
    <div class="container" data-aos="fade-up">
      <header class="section-header">
        <h2>Our Values</h2>
        <p>Odit est perspiciatis laborum et dicta</p>
      </header>
      <div class="row">
        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
          <div class="box">
            <img src="assets/img/values-1.png" class="img-fluid" alt="">
            <h3>Ad cupiditate sed est odio</h3>
            <p>Eum ad dolor et. Autem aut fugiat debitis voluptatem consequuntur sit. Et veritatis id.</p>
          </div>
        </div>
        <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="400">
          <div class="box">
            <img src="assets/img/values-2.png" class="img-fluid" alt="">
            <h3>Voluptatem voluptatum alias</h3>
            <p>Repudiandae amet nihil natus in distinctio suscipit id. Doloremque ducimus ea sit non.</p>
          </div>
        </div>
        <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="600">
          <div class="box">
            <img src="assets/img/values-3.png" class="img-fluid" alt="">
            <h3>Fugit cupiditate alias nobis.</h3>
            <p>Quam rem vitae est autem molestias explicabo debitis sint. Vero aliquid quidem commodi.</p>
          </div>
        </div>
      </div>
    </div>
  </section><!-- End Values Section -->

</main><!-- End #main -->

@endsection