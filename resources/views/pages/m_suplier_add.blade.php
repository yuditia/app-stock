<!DOCTYPE html>
<html lang="en">

<head>

@include('partials.head')
<title>Add Suplier - Stok App</title>

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
                        <li class="breadcrumb-item"><a href="/suplier">suplier</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah suplier</li>
                    </ol>
                </nav>

                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">

                                <form action="{{ route('suplier.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="nm_suplier" class="form-label fw-bold">Nama Suplier</label>
                                        <input type="text" id="nm_suplier" name="nm_suplier" class="form-control"
                                        aria-describedby="nm_suplier">
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
