<html lang="en">

<head>
    <title>Dashboard - Stok Barang App</title>
    @include('partials.head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
</head>

<body>
    <div class="main-wrapper">

    @include('partials.sidebar')

        <div class="page-wrapper">

            @include('partials.navbar')

            <div class="page-content">
                <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                    <div>
                        <h4 class="mb-3 mb-md-0">
                            Selamat Datang di Halaman Admin CV. Subur makmur
                        </h4>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Banner Frontpage</h5>

                                <div class="swiper bannerDashboard">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <img src="{{ asset('../images/bg-login.jpg') }}"
                                                alt="" class="mx-auto d-block img-fluid" />
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="{{ asset('../images/bg-2.jpg') }}"
                                                alt="" class="mx-auto d-block img-fluid" />
                                        </div>
                                    </div>
                                    <div class="gradient-bn"></div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            @include('partials.footer')

        </div>
    </div>
</body>

</html>
@include('partials.script')
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".bannerDashboard", {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
        },
    });
</script>
