<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BurgerTime</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- home CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/home/animate.css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/home/aos/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/home/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/home/boxicons/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/home/glightbox/css/glightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/home/swiper/swiper-bundle.min.css') }}">


    <!-- Template Home CSS File -->
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    <!-- cart -->
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">

</head>

<body>

    <!-- ======= Top Bar ======= -->
    <div id="topbar" class="d-flex align-items-center fixed-top">
        <div class="container d-flex justify-content-center justify-content-md-between">

            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-phone d-flex align-items-center"><span>+1 5589 55488 55</span></i>
                <i class="bi bi-clock d-flex align-items-center ms-4"><span> Mon-Sat: 11AM - 23PM</span></i>
            </div>

            <div class="languages d-none d-md-flex align-items-center">
                <ul>
                    <li>En</li>
                    <li><a href="#">De</a></li>
                </ul>
            </div>
        </div>
    </div>

   


    <header id="header" class="fixed-top d-flex align-items-cente">
        @include('includes.navbar')
    </header>

    <!-- hero -->
    @include('includes.home.hero')

     <!-- toast -->
    @include('includes.toast')
    

    <main id="main">
        @yield('content')
    </main>

    <footer id="footer">
        @include('includes.footer')
    </footer>

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>

    <!-- Home JS Files -->
    <script src="assets/home/aos/aos.js"></script>
    <script src="{{ asset('/assets/home/aos/aos.js') }}"></script>
    <script src="{{ asset('/assets/home/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('/assets/home/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('/assets/home/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Template home JS File -->
    <script src="{{ asset('js/home.js') }}"></script>

    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


</body>

</html>