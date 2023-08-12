<!DOCTYPE html>
<html lang="en">

    <head>
        @include('partials.head')
        <title>Tambah User - CV. Subur makmur</title>
        <link rel="stylesheet" href="{{ asset('/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
    </head>

<body>
    <div class="main-wrapper">

        @include('partials.sidebar')

        <div class="page-wrapper">

            @include('partials.navbar')


            <div class="page-content">

                <nav class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="#">user</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah user</li>
                    </ol>
                </nav>

                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">

                                <form action="{{ route('user.store') }}" method="POST" autocomplete="off">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="youtube" class="form-label fw-bold">Name</label>
                                        <input type="text" id="youtube" name="name" class="form-control"
                                        aria-describedby="youtube">
                                    </div>


                                    <div class="mb-3">
                                        <label for="wa" class="form-label fw-bold">Email</label>
                                        <input type="text" id="wa" name="email" class="form-control"
                                        aria-describedby="wa">
                                    </div>

                                    <div class="mb-3">
                                        <label for="Instagram" class="form-label fw-bold">Password</label>
                                        <input type="text" id="Instagram" name="password" class="form-control"
                                        aria-describedby="Instagram">
                                    </div>


                                    <button type="submit" class="btn btn-primary his-btn">Submit</button>
                                </form>

                                <div class="row">
                                    <a href="/user" class="btn btn-outline-primary mx-w100"> <i class="bi bi-arrow-left"></i> Kembali</a>
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
<script src="{{ asset('/vendors/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('/js/tinymce.js') }}"></script>
