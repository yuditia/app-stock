<!DOCTYPE html>
<html lang="en">

<head>

    @include('partials.head')
    <title>Edit Suplier - Stok App</title>

</head>

<body>
    <div class="main-wrapper">

        @include('partials.sidebar')


        <div class="page-wrapper">

            @include('partials.navbar')

            <div class="page-content">
                <nav class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/barang">Barang</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit barang</li>
                    </ol>
                </nav>

                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">

                                <form action="/suplier/{{ $suplier->id }}" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    @method('PUT')


                                    <div class="mb-3">
                                        <label for="nm_suplier" class="form-label fw-bold">Stok Barang</label>
                                        <input type="text" id="nm_suplier" name="nm_suplier" class="form-control"
                                        aria-describedby="nm_suplier" value="{{ $suplier->nm_suplier }}">
                                    </div>

                                    <button type="submit" class="btn btn-primary his-btn">Submit</button>
                                </form>

                                <div class="row">
                                    <a href="/suplier" class="btn btn-outline-primary mx-w100"> <i class="bi bi-arrow-left"></i> Kembali</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>



            </div>

            @include('partials.footer')

        </div>
    </div>

    @include('partials.script')

</body>

</html>
