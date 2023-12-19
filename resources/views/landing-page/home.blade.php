<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link
        href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap"
        rel="stylesheet">

    <title>Website SIPANDU</title>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{ asset('') }}landingpage/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('') }}landingpage/css/font-awesome.css">

    <link rel="stylesheet" href="{{ asset('') }}landingpage/css/templatemo-training-studio.css">
    <link rel="stylesheet" href="{{ url('') }}/assets/datatables/datatables.min.css">

    <style>
        #schedule {
            background-image: url("{{ asset('assets/images/bg-home.svg') }}");
            background-color: rgba(0, 0, 0, 0.8);
            background-blend-mode: overlay;
        }

        #schedule table tbody tr td {
            border-right: 1px solid #dbcece;
            height: 1px;
            color: rgba(0, 0, 0, 0.8)
        }
    </style>

</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->


    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.html" class="logo">SI<em> PANDU</em></a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#top" class="menu active">Home</a></li>
                            <li class="scroll-to-section"><a href="#features" class="menu">About</a></li>
                            <li class="scroll-to-section"><a href="#schedule" class="menu">Schedules</a></li>
                            <li class="main-button"><a href="{{ url('/ortu') }}">Sign In</a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Main Banner Area Start ***** -->
    <div class="main-banner" id="top">
        <video autoplay muted loop id="bg-video">
            <source src="{{ asset('') }}landingpage/images/imun-vitamin.mp4" type="video/mp4" />
        </video>

        <div class="video-overlay header-text">
            <div class="caption">
                <h6>Tetap Jaga Kesehatan Si Kecil</h6>
                <h2>Imunisasi <em> Vitamin </em></h2>
                <div class="main-button scroll-to-section">
                    <a href="#schedule">Yuk Check Up Buah hati</a>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** Our Classes Start ***** -->
    <section class="section" id="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h2>In<em>formasi</em></h2>
                    </div>
                </div>
            </div>
            <div class="row" id="tabs">
                <div class="col-lg-4">
                    <ul>
                        <li><a href='#tabs-1'><img src="assets/images/tabs-first-icon.png" alt="">Posyandu</a>
                        </li>
                        <li><a href='#tabs-2'><img src="assets/images/tabs-first-icon.png" alt="">Imunisasi</a>
                        </li>
                        <li><a href='#tabs-3'><img src="assets/images/tabs-first-icon.png" alt="">Vitamin</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-8">
                    <section class='tabs-content'>
                        <article id='tabs-1'>
                            <img src="{{ asset('assets/images/bg-home4.jpg') }}" alt="First Class">
                            <h4>Posyandu</h4>
                            <p>
                                Pos Pelayanan Terpadu, adalah program kesehatan masyarakat yang diperkenalkan di
                                Indonesia. Program ini bertujuan untuk memberikan layanan kesehatan dasar kepada ibu
                                hamil, ibu menyusui, dan anak-anak di bawah usia lima tahun. Posyandu biasanya
                                beroperasi di tingkat desa atau komunitas, dan umumnya dijalankan oleh relawan kesehatan
                                yang sering kali didukung oleh otoritas kesehatan setempat.
                            </p>
                            <div class="main-button">
                                <a href="#schedule">View Schedule</a>
                            </div>
                        </article>
                        <article id='tabs-2'>
                            <img src="{{ asset('landingpage/images/imunisasi.jpg') }}" alt="Second Training"
                                style="height: 250px;object-fit:cover" class="img-fluid mx-auto w-100">
                            <h4>Imunisasi</h4>
                            <p>
                                Imunisasi anak merupakan salah satu komponen penting dalam upaya pencegahan penyakit dan
                                perlindungan terhadap infeksi yang dapat mengancam jiwa pada masa anak-anak. Imunisasi
                                melibatkan pemberian vaksin yang dirancang untuk menstimulasi sistem kekebalan tubuh
                                agar dapat mengenali dan melawan penyakit tertentu.<br>
                                munisasi anak merupakan investasi penting dalam kesehatan anak-anak, membantu mencegah
                                penyebaran penyakit menular dan melindungi anak dari dampak serius penyakit-penyakit
                                tertentu. Konsultasikan dengan dokter atau tenaga kesehatan untuk informasi yang lebih
                                spesifik dan sesuai dengan kondisi kesehatan anak Anda.
                            </p>
                            <div class="main-button">
                                <a href="#schedule">View Schedule</a>
                            </div>
                        </article>
                        <article id='tabs-3'>
                            <img src="{{ asset('landingpage/images/vitamin.jpg') }}" alt="Third Class"
                                style="height: 250px;object-fit:cover" class="img-fluid mx-auto w-100">
                            <h4>Vitamin</h4>
                            <p>

                                "Berikan yang Terbaik untuk Si Kecil Anda dengan Memberikan Vitamin yang Dibutuhkan
                                untuk Pertumbuhan dan Kesehatan Optimalnya. Vitamin seperti vitamin A, D, C, dan zat
                                besi adalah kunci bagi sistem kekebalan tubuh yang kuat dan perkembangan yang baik.
                                Dengan memberikan suplemen vitamin yang tepat, Anda dapat memastikan bahwa balita
                                mendapatkan nutrisi yang dibutuhkan untuk tulang yang kuat, otak yang cerdas, dan
                                perlindungan dari berbagai penyakit."

                                "Namun, pastikan untuk selalu berkonsultasi dengan dokter atau ahli gizi sebelum
                                memberikan suplemen vitamin kepada balita. Dengan pengetahuan yang tepat tentang
                                kebutuhan spesifik anak Anda, Anda dapat memilih vitamin yang sesuai dengan usia,
                                kondisi kesehatan, dan memastikan bahwa mereka mendapatkan manfaat terbaik tanpa risiko
                                overdosis. Memberikan asupan vitamin yang tepat merupakan langkah penting untuk
                                memastikan masa depan sehat dan berkembangnya Si Kecil Anda."
                            </p>
                            <div class="main-button">
                                <a href="#schedule">View Schedule</a>
                            </div>
                        </article>
                    </section>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Our Classes End ***** -->


    <section class="section" id="schedule">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading dark-bg">
                        <h2>Jadwal <em>Posyandu</em></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="card">
                        <div class="card-body text-dark">
                            <table class="table" id="jadwal-table">
                                <thead>
                                    <tr class="text-dark">
                                        <th class="day-time  text-center">Poyandu</th>
                                        <th class="day-time  text-center">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Fitness Class</td>
                                        <td>Fitness Class</td>
                                    </tr>
                                    <tr>
                                        <td>Fitness Class</td>
                                        <td>Fitness Class</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; 2020 Training Studio

                        - Designed by <a rel="nofollow" href="https://templatemo.com" class="tm-text-link"
                            target="_parent">TemplateMo</a><br>

                        Distributed by <a rel="nofollow" href="https://themewagon.com" class="tm-text-link"
                            target="_blank">ThemeWagon</a>

                    </p>

                    <!-- You shall support us a little via PayPal to info@templatemo.com -->

                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="{{ asset('') }}landingpage/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('') }}landingpage/js/popper.js"></script>
    <script src="{{ asset('') }}landingpage/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="{{ asset('') }}landingpage/js/scrollreveal.min.js"></script>
    <script src="{{ asset('') }}landingpage/js/waypoints.min.js"></script>
    <script src="{{ asset('') }}landingpage/js/jquery.counterup.min.js"></script>
    <script src="{{ asset('') }}landingpage/js/imgfix.min.js"></script>
    <script src="{{ asset('') }}landingpage/js/mixitup.js"></script>
    <script src="{{ asset('') }}landingpage/js/accordions.js"></script>

    <!-- Global Init -->
    {{-- <script src="{{ asset('') }}landingpage/js/custom.js"></script> --}}
    <script src="{{ url('') }}/assets/datatables/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            $(function() {
                $("#tabs").tabs();
            });

            $(window).scroll(function() {
                var scroll = $(window).scrollTop();
                var box = $('.header-text').height();
                var header = $('header').height();

                if (scroll >= box - header) {
                    $("header").addClass("background-header");
                } else {
                    $("header").removeClass("background-header");
                }
            });


            $('.schedule-filter li').on('click', function() {
                var tsfilter = $(this).data('tsfilter');
                $('.schedule-filter li').removeClass('active');
                $(this).addClass('active');
                if (tsfilter == 'all') {
                    $('.schedule-table').removeClass('filtering');
                    $('.ts-item').removeClass('show');
                } else {
                    $('.schedule-table').addClass('filtering');
                }
                $('.ts-item').each(function() {
                    $(this).removeClass('show');
                    if ($(this).data('tsmeta') == tsfilter) {
                        $(this).addClass('show');
                    }
                });
            });


            // Window Resize Mobile Menu Fix
            mobileNav();


            // Scroll animation init
            window.sr = new scrollReveal();


            // Menu Dropdown Toggle
            if ($('.menu-trigger').length) {
                $(".menu-trigger").on('click', function() {
                    $(this).toggleClass('active');
                    $('.header-area .nav').slideToggle(200);
                });
            }


            $(document).ready(function() {
                $(document).on("scroll", onScroll);

                //smoothscroll
                $('.scroll-to-section a[href^="#"]').on('click', function(e) {
                    e.preventDefault();
                    $(document).off("scroll");

                    $('a.menu').each(function() {
                        $(this).removeClass('active');
                    })
                    $(this).addClass('active');

                    var target = this.hash,
                        menu = target;
                    var target = $(this.hash);
                    $('html, body').stop().animate({
                        scrollTop: (target.offset().top) + 1
                    }, 500, 'swing', function() {
                        window.location.hash = target.selector;
                        $(document).on("scroll", onScroll);
                    });
                });
            });

            function onScroll(event) {
                var scrollPos = $(document).scrollTop();
                $('.nav a.menu').each(function() {
                    var currLink = $(this);
                    var refElement = $(currLink.attr("href"));
                    if (refElement.position().top <= scrollPos && refElement.position().top + refElement
                        .height() > scrollPos) {
                        $('.nav ul li a').removeClass("active");
                        currLink.addClass("active");
                    } else {
                        currLink.removeClass("active");
                    }
                });
            }


            // Page loading animation
            $(window).on('load', function() {

                $('#js-preloader').addClass('loaded');

            });


            // Window Resize Mobile Menu Fix
            $(window).on('resize', function() {
                mobileNav();
            });


            // Window Resize Mobile Menu Fix
            function mobileNav() {
                var width = $(window).width();
                $('.submenu').on('click', function() {
                    if (width < 767) {
                        $('.submenu ul').removeClass('active');
                        $(this).find('ul').toggleClass('active');
                    }
                });
            }
            $('#jadwal-table').DataTable({
                dom: "<'row'<'col-sm-12 col-md-12'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",

                ajax: {
                    url: '{{ route('jadwalposyandu.datajadwalposyandu.index') }}',
                    type: "GET",
                    dataSrc: "",
                },
                columns: [{
                        data: 'title'
                    },
                    {
                        data: 'start'
                    },

                ],
                deferRender: true,
                displayLength: 10,
            });
        });
    </script>

</body>

</html>
