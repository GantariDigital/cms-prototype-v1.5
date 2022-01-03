<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Gantari Bawana @yield('title-page')</title>
  <link rel="icon" href="{{ asset('assets/img/logo-gantari.png') }}">
  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  
  <!-- CSS Libraries -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css" />
  <link rel="stylesheet" href="{{ asset('assets/library/izitoast/css/iziToast.min.css') }}" />
  @yield('css-libraries')
  
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
  
  @yield('css')
  
  <style>
    .custom-pagination-scroll-h {
      display: inline-block;
      overflow: auto;
      overflow-y: hidden;
      white-space: nowrap;
    }
    .menu-layout .layout-item {
      padding: 0.5rem 1rem;
      cursor: pointer;
      transition: box-shadow 0.2s ease-in-out;
    }
    /* .menu-layout .layout-item:hover {
      box-shadow: 0 .2rem .5rem rgba(0,0,0,.15)!important;
    } */
    .menu-layout .layout-item.active {
      border-bottom: 2px solid #007bff!important;
    }
    .custom-pagination-scroll-h>.page-item {
      display: inline-block;
    }
    .card-link {
      cursor: pointer;
    }
    .card-link:hover {
      color: #0056b3;
    }
    .swal2-confirm.swal2-styled {
      /* box-shadow: 0 2px 6px #acb5f6; */
      background-color: #6777ef;
    }
    .swal2-cancel.swal2-styled {
      color: #555;
      background-color: #efefef;
    }
    
    .custom-fa-10x {
      font-size: 10em;
    }
    
    .custom-fa-1x-2 {
      font-size: 1.2em;
    }
    .fa-1x-3 {
      font-size: 1.3rem;
    }
    .custom-bg-folder {
      color: #FFE8A1;
    }
    
    .custom-bg-red-pdf {
      color: #df3c33;
    }
    
    .custom-article-header-pdf {
      height: 170px !important;
    }
    .folder-event {
      cursor: pointer;
    }
    .custom-card-folder {
      transition: box-shadow 0.2s ease-in-out;
    }
    .custom-card-folder:hover {
      box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }
    .custom-color-inherit {
      color: inherit;
    }
    .custom-border-y {
      border-top: 1px solid #dee2e6!important;
      border-bottom: 1px solid #dee2e6!important;
    }
    
    .article .article-header .article-top-badge {
      position: absolute;
      top: 10px;
      padding-left: 10px;
      padding-right: 10px;
    }
    
    .custom-article-badge {
      padding: 10px 10px;
      left: 0 !important;
      cursor: pointer;
      bottom: 0 !important;
    }
    .custom-article-badge>.article-badge-item {
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .custom-bg-transparent-white {
      background-color: #ffffffe6;
      color: #6c757d !important;
      border: 1px #efefef solid;
    }
    
    .common-section-title {
      margin-bottom: 5px;
      font-size: 16px;
      color: #191d21;
      font-weight: 600;
      position: relative;
    }
    
    body.layout-3 .navbar-bg {
      height: 70px;
    }
    body.layout-3 .main-content {
      padding-top: 130px;
    }
    .custom-card-overlay {
      border-radius: 0.25rem;
      -webkit-align-items: center;
      -ms-flex-align: center;
      align-items: center;
      background-color: rgba(255,255,255,.7);
      display: -webkit-flex;
      display: -ms-flexbox;
      display: flex;
      -webkit-justify-content: center;
      -ms-flex-pack: center;
      justify-content: center;
      z-index: 50;
      height: calc(100% - 30px);
      left: 15px;
      right: 15px;
      position: absolute;
      top: 0;
      width: calc(100% - 30px);
    }
    .fa-3x {
      font-size: 3em;
    }
  </style>
  
  <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="layout-3">
  <div id="app">
    <div class="main-wrapper container">
      <div class="navbar-bg"></div>
      
      @include('layouts.dashboard.navbar')
      
      {{-- @include('layouts.dashboard.navbar_menu') --}}
      
      <!-- Main Content -->
      <div class="main-content">
        {{$slot}}
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          PT GANTARI BAWANA &copy; 2021 <div class="bullet"></div>
        </div>
        <div class="footer-right">
          v.1.0.0
        </div>
      </footer>
    </div>
  </div>
  
  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{ asset('assets/js/stisla.js') }}"></script>
  
  <!-- JS Libraies -->
  <script src="{{ asset('assets/library/wheelzoom/wheelzoom.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>
  <script src="{{ asset('assets/library/izitoast/js/iziToast.min.js') }}"></script>
  @stack('script-libraries')
  
  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>
  @livewireScripts
  @stack('script')
</body>
</html>
