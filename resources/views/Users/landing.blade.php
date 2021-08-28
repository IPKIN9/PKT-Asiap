<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Si-Notif Interface</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('web/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('web/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('web/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/vendor/venobox/venobox.css') }}" rel="stylesheet">
    <link href="{{ asset('web/assets/vendor/aos/aos.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('web/assets/css/style.css') }}" rel="stylesheet">

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top ">
        <div class="container-fluid">

            <div class="row justify-content-center">
                <div class="col-xl-9 d-flex align-items-center">
                    <h1 class="logo mr-auto"><a>Si-Notif</a></h1>
                    <!-- Uncomment below if you prefer to use an image logo -->
                    <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

                    <nav class="nav-menu d-none d-lg-block">
                        <ul>
                            <li class="active"><a href="#hero">Cek Resi</a></li>
                            <li><a href="#about">Tentang</a></li>

                        </ul>
                    </nav><!-- .nav-menu -->
                </div>
            </div>

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">

        <div class="container-fluid" data-aos="fade-up">
            <div class="row justify-content-center">
                <div
                    class="col-xl-5 col-lg-6 pt-3 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <h1>Paketmu Aman Cari Posisinya</h1>
                    <h2>Masukkan NOMOR RESI atau AWB atau KODE BOOKING</h2>
                    <br>
                    <div class="form-group">
                        <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                            aria-describedby="search-addon" id="search" />
                        <a href="#" type="button" id="tb-search" class="btn-get-started scrollto">Cek Resi</a>
                    </div>
                </div>
            </div>
        </div>

    </section><!-- End Hero -->

    <main id="main">
        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <div id="table-search">

                    </div>
                </div>
            </div>
        </section><!-- End Portfolio Section -->

        <section id="about" class="about">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Tentang Aplikasi</h2>
                    <p>Aplikasi Sistem Informasi Pengiriman Barang Menggunakan Notification Whatsapp ini dibuild
                        menggunakan FrameWork Laravel 7 dan bootstrap</p>
                </div>

            </div>

            </div>
        </section>
    </main><!-- End #main -->

    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('web/assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('web/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('web/assets/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('web/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('web/assets/vendor/waypoints/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('web/assets/vendor/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('web/assets/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('web/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('web/assets/vendor/venobox/venobox.min.js') }}"></script>
    <script src="{{ asset('web/assets/vendor/aos/aos.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('web/assets/js/main.js') }}"></script>
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('body').on('click','#tb-search',function()
            {
                let resi = $('#search').val();
                if (resi === '') {
                    alert("Input tidak boleh kosong");
                } else {
                    let url = 'search/'+resi;
                    $.get(url, function(result)
                    {
                        if (!$.trim(result.no_resi)) {
                            $('#table-search').html('<h4>Data tidak di temukan</h4>');
                            $('#search').val('');
                            $('html, body').animate({
                                scrollTop: $("#table-search").offset().top-200
                            }, 2000, function(){$( "#table-search" ).focus();});
                        } else {
                            $('#table-search').html('');
                            $('#table-search').append(`
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12 footer-contact">
                                            <h3>No Resi: `+ result.no_resi +`</h3>
                                            <p>
                                                <strong>Nama Penerima: </strong>`+ result.pengirim_rol.nama +`<br>
                                                <strong>Barang: </strong>`+ result.pengirim_rol.barang +`<br>
                                                <strong>Alamat: </strong>`+ result.alamat +`<br>
                                                <strong>Status: </strong>`+ result.status_rol.status_pengiriman +`<br><br>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            `);
                            $('html, body').animate({
                                scrollTop: $("#table-search").offset().top-200
                            }, 2000, function(){$( "#table-search" ).focus();}); 
                        }
                    });
                }
                let url = "search/"+resi;
            });
        });
    </script>

</body>

</html>