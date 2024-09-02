<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SPK SIPLah</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Favicons -->
  <link href="{{ asset('img/favicon.png') }}" rel="icon">
  <link href="{{ asset('img/logo.png') }}" rel="logo">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('css/frontstyle.css') }}" rel="stylesheet">
  <link href="{{ asset('css/addon.css') }}" rel="stylesheet">

  <style>
    div.scroll-container {
      overflow: auto;
      white-space: nowrap;
      width:100%;
    }
    div.scroll-container div.scroll {
      display: inline-block;
    }
    ::-webkit-scrollbar {
      height: 3px;
    }
    ::-webkit-scrollbar-track {
      box-shadow: grey; 
    }
    ::-webkit-scrollbar-thumb {
      background: #4154f1; 
    }
    ::-webkit-scrollbar-thumb:hover {
      background: #6776f4; 
    }
  </style>

  <!-- Untuk AJAX Javascript -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <img src="{{ asset('img/logo.png') }}" alt="Logo">
        <span>SPK SIPLah</span>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a></li>
          <li><a class="nav-link {{ request()->is('profil') ? 'active' : '' }}" href="{{ url('profil') }}">Profil</a></li>
          <li><a class="nav-link {{ request()->is('hasil') ? 'active' : '' }}" href="{{ url('hasil') }}">Cari Produk</a></li>
          <li><a class="nav-link {{ request()->is('metodebwm') ? 'active' : '' }}" href="{{ url('metodebwm') }}">Metode BWM</a></li>
          <li><a class="nav-link {{ request()->is('metodemoora') ? 'active' : '' }}" href="{{ url('metodemoora') }}">Metode MOORA</a></li>
          <li><a class="nav-link scrollto" href="#footer">Kontak Kami</a></li>
          @if(Session::has('loginId'))
          <li>
            <form class="getstarted" method="POST" action="{{ url('logout') }}">
              @csrf
              <button class="dropdown-item d-flex align-items-center" type="submit">
                <strong>LogOut</strong>
              </button>
            </form>    
          </li>
          @else
          <li><a class="getstarted" href="{{ url('login') }}">LogIn</a></li>
          @endif
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  @yield('content')

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-5 col-md-12 footer-info">
            <a href="{{ url('/') }}" class="logo d-flex align-items-center">
              <img src="{{ asset('/img/logo.png') }}" alt="">
              <span>SPK SIPLah</span>
            </a>
            <p>Situs Informasi Pengadaan (SIP) barang dan jasa satuan pendidikan sebagai solusi modern untuk membantu satuan pendidikan menemukan pemasok terbaik dalam satu wilayah.</h2></p>
            <div class="social-links mt-3">
              <a href="" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
          <div class="col-lg-2 col-6 footer-links">
            <h4>Navigasi</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="">Home</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="">Profil</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="">Cari Produk</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="">Metode BWM</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="">Metode MOORA</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="">Kontak Kami</a></li>
            </ul>
          </div>
          <div class="col-lg-2 col-6 footer-links">
            <h4>Produk</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="">Barang</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="">Jasa</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
            <h4>Kontak Saya</h4>
            <p>
              Fakultas Teknik<br>
              Universitas Bhayangkara<br>
              Surabaya<br><br>
              <strong>Phone:</strong> +62 898 8778 8778<br>
              <strong>Email:</strong> imam_musthofa@example.com<br>
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Imam Musthofa</span></strong>. All Rights Reserved
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('js/frontmain.js') }}"></script>

</body>

</html>