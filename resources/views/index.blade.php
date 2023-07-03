<html lang="en">
<head>
   @include('partials.head')
   @include('sweetalert::alert')
   <title>Login - Stok App</title>
</head>
<body>

    <div class="main-wrapper" style="background-image: url({{ asset('/images/bg-account.jpg') }});">
        <div class="page-wrapper full-page bg-maps">
            <div class="page-content d-flex align-items-center justify-content-center">
                <div class="row w-100 mx-0 auth-page">
                    <div class="col-md-8 col-xl-6 mx-auto">
                        <div class="card br-login-5">
                            <div class="row">
                                <div class="col-md-4 pe-md-0">
                                    <div class="auth-side-wrapper"></div>
                                </div>
                                <div class="col-md-8 ps-md-0">
                                    <div class="auth-form-wrapper px-4 py-5">
                                        <a href="#" class="noble-ui-logo d-block mb-2">CV. Subur makmur</span></a>
                                       <marquee>
                                            <h5 class="text-muted fw-normal mb-4">
                                                Selamat Datang di Halaman Admin Stok App
                                            </h5>
                                        </marquee>

                                        <form class="forms-sample" method="post" id="loginForm">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="email" class="form-label">email</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="email" />
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="password" name="password"
                                                    autocomplete="current-password" placeholder="Password" />
                                            </div>

                                            <br>
                                            <div>
                                                <button type="submit" class="btn btn-primary btn-block mx-w200 btn btn-primary mb-2 mb-md-0 text-white mx-auto d-block">Log In</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    $("#loginForm").submit(function (event) {

        event.preventDefault();

        var formData = new FormData(this);
                $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });


                $.ajax({
                    type: "POST",
                    url: "{{ route('do.login') }}",
                    cache: false,
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'JSON',


                    success: function (data) {
                        console.log('data',data)

                        if (data.response == 200) {
                            swal.fire(  data.message,
                                "   ",
                                "success");

                            setTimeout(function () {
                                window.location.href = "{{ route('dashboard')}}";
                                }, 3000);

                        } else {
                            swal.fire(  data.message,
                                "   ",
                                "error");

                        }


                    },
                    error: function (data, jqXHR, textStatus, errorThrown) {
                        console.log('data',data);
                        console.log(textStatus);
                    },
                });


    });
</script>
