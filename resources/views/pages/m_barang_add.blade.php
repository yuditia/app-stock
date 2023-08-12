<!DOCTYPE html>
<html lang="en">

<head>

@include('partials.head')
<title>Add Barang - Stok App</title>

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
                        <li class="breadcrumb-item"><a href="/barang">barang</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah barang</li>
                    </ol>
                </nav>

                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">

                                <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="img_barang" class="form-label fw-bold">Image barang</label>
                                        <input type="file" name="img_barang" accept="image/*" class="form-control"
                                            id="img_barang" aria-describedby="img_barang">
                                            <div class="form-text">recomended image 1990px x 800px</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="nm_barang" class="form-label fw-bold">Nama Barang</label>
                                        <input type="text" id="nm_barang" name="nm_barang" class="form-control"
                                        aria-describedby="nm_barang">
                                    </div>

                                    <div class="mb-3">
                                        <label for="wr_barang" class="form-label fw-bold">Warna Barang</label>
                                        <input type="text" id="wr_barang" name="wr_barang" class="form-control"
                                        aria-describedby="wr_barang">
                                    </div>

                                    <div class="mb-3">
                                        <label for="stok_barang" class="form-label fw-bold">QTY</label>
                                        <input type="text" id="stok_barang" class="form-control"
                                        aria-describedby="stok_barang">
                                        <input type="hidden" name="stok_barang" id="stok">
                                    </div>

                                    <div class="mb-3">
                                        <select class="form-select" aria-label="Default select example" name="satuan" id="satuan">
                                            <option selected>Satuan</option>
                                            <option value="1">Meter</option>
                                            <option value="2">Pasang</option>
                                            <option value="3">Blek</option>
                                            <option value="4">Galon</option>
                                            <option value="5">Kodi</option>
                                            <option value="6">Pc</option>
                                            <option value="7">Jeriken</option>
                                          </select>

                                    </div>

                                    <div class="mb-3">
                                        <label for="harga" class="form-label fw-bold">Harga</label>
                                        <input type="text" id="harga" class="form-control"
                                        aria-describedby="harga">
                                        <input type="hidden" name="harga" id="harga_asli">
                                    </div>





                                    <button type="submit" class="btn btn-primary his-btn">Submit</button>
                                </form>

                                <div class="row">
                                    <a href="/barang" class="btn btn-outline-primary mx-w100"> <i class="bi bi-arrow-left"></i> Kembali</a>
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

<script>

    $('#stok_barang').on('change', function(){
        var qty = $('#stok_barang').val()
        $('#stok').val(qty)
        //$('#stok_barang').val(new Intl.NumberFormat("id-ID").format(qty))
    })


    $('#harga').on('change', function(){

        var qty = $('#stok').val()
        var harga = $('#harga').val()
        $('#harga_asli').val(harga)


        $('#harga').val('Rp. ' + new Intl.NumberFormat("id-ID").format(harga))
    })
</script>
