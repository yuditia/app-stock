<!DOCTYPE html>
<html lang="en">

<head>

    @include('partials.head')
    <title>Edit Barang - Stok App</title>

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

                                <form action="/barang/{{ $barang->id }}" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="img_barang" class="form-label fw-bold">Image barang</label>
                                        <input type="file" name="img_barang" accept="image/*" class="form-control"
                                            id="img_barang" aria-describedby="img_barang">
                                            <div class="form-text">recomended image 1990px x 800px</div>
                                    </div>

                                    <img src="{{ asset('barang_img/'.$barang->foto_barang) }}" alt="{{ $barang->nm_barang }}" style="height: 100px; width: 100px" class="mb-3">

                                    <div class="mb-3">
                                        <label for="nm_barang" class="form-label fw-bold">Nama Barang</label>
                                        <input type="text" id="nm_barang" name="nm_barang" class="form-control"
                                        aria-describedby="nm_barang" value="{{ $barang->nm_barang }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="wr_barang" class="form-label fw-bold">Warna Barang</label>
                                        <input type="text" id="wr_barang" name="wr_barang" class="form-control"
                                        aria-describedby="wr_barang" value="{{ $barang->wr_barang }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="stok_barang" class="form-label fw-bold">Stok Barang</label>
                                        <input type="text" id="stok_barang" name="stok_barang" class="form-control"
                                        aria-describedby="stok_barang" value="{{ number_format($barang->stok_barang,2,",",".") }}">
                                        <input type="hidden" name="stok_barang" id="stok" value="{{ $barang->stok_barang }}">
                                    </div>



                                    <div class="mb-3">
                                        <select class="form-select" aria-label="Default select example" name="satuan" id="satuan">
                                            <option value="0">Satuan</option>
                                            <option value="1" {{ $barang->satuan == 1 ? 'selected' : '' }}>Meter</option>
                                            <option value="2" {{ $barang->satuan == 2 ? 'selected' : '' }}>Pasang</option>
                                            <option value="3" {{ $barang->satuan == 3 ? 'selected' : '' }}>Blek</option>
                                            <option value="4" {{ $barang->satuan == 4 ? 'selected' : '' }}>Galon</option>
                                            <option value="5" {{ $barang->satuan == 5 ? 'selected' : '' }}>Kodi</option>
                                            <option value="6" {{ $barang->satuan == 6 ? 'selected' : '' }}>Pc</option>
                                            <option value="7" {{ $barang->satuan == 6 ? 'selected' : '' }}>Jeriken</option>
                                          </select>

                                    </div>

                                    <div class="mb-3">
                                        <label for="harga" class="form-label fw-bold">Harga</label>
                                        <input type="text" id="harga" class="form-control"
                                        aria-describedby="harga" value="Rp. {{ number_format($barang->harga,0,",",".") }}">
                                        <input type="hidden" name="harga" id="harga_asli" value="{{ $barang->harga }}">
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


       // $('#stok_barang').val(new Intl.NumberFormat("id-ID").format(qty))


        var harga_asli = $('#harga_asli').val()
        var qty_asli =  $('#stok_barang').val()

        $('#stok').val(qty_asli)



    })


    $('#harga').on('change', function(){

        var qty = $('#stok').val()
        var harga = $('#harga').val()
        $('#harga_asli').val(harga)


        $('#harga').val('Rp. ' + new Intl.NumberFormat("id-ID").format(harga))
    })
</script>
