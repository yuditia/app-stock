<!DOCTYPE html>
<html lang="en">

    <head>
        @include('partials.head')
        <title>Edit Pembelian - CV. Sumber Berkah</title>
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
                        <li class="breadcrumb-item"><a href="#">Pembelian</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Pembelian</li>
                    </ol>
                </nav>

                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">

                                <form action="/pembelian/{{ $data->id }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="no_transaksi" class="form-label fw-bold">No Transaksi</label>
                                        <input type="text" id="no_transaksi" name="no_transaksi" class="form-control"
                                        aria-describedby="no_transaksi" value="{{ $data->no_transaksi }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="nm_barang" class="form-label fw-bold">Nama Barang</label>
                                        @foreach ($data->barang as $item)
                                        <input type="text" id="nm_barang" name="nm_barang" class="form-control"
                                        aria-describedby="nm_barang" value="{{ $item->nm_barang }}" disabled>

                                        @endforeach
                                    </div>



                                    <div class="mb-3">
                                        <label for="tgl_pembelian" class="form-label fw-bold">Tgl Pembelian</label>
                                        @foreach ($data->pembelian as $item)
                                            <input type="date" id="tgl_pembelian" name="tgl_pembelian" class="form-control"
                                            aria-describedby="tgl_pembelian" value="{{ $item->tgl_pembelian }}" required>
                                        @endforeach
                                    </div>


                                    <div class="mb-3">
                                        <label for="suplier" class="form-label fw-bold">Suplier</label><br>
                                        <select class="form-select form-control" name="suplier" aria-label="Default select example" id="suplier" disabled>
                                            @foreach ($sup as $item)
                                                @foreach ($data->pembelian as $item2)
                                                    <option value="{{ $item->nm_suplier }}" {{ $item->nm_suplier == $item2->suplier ? 'selected' : '' }} >{{ $item->nm_suplier }}</option>
                                                @endforeach
                                            @endforeach
                                          </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="stok_barang" class="form-label fw-bold">QTY</label>
                                        <input type="text" id="stok_barang" class="form-control"
                                        aria-describedby="stok_barang" value="{{ number_format($data->qty,0,",",".") }}">
                                        <input type="hidden" name="qty" id="stok">
                                        <input type="hidden" name="old_qty" value="{{ $data->qty }}">
                                    </div>


                                    <button type="submit" class="btn btn-primary his-btn">Submit</button>
                                </form>

                                <div class="row">
                                    <a href="/pembelian" class="btn btn-outline-primary mx-w100"> <i class="bi bi-arrow-left"></i> Kembali</a>
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

<script>


        $('#stok_barang').on('change',function(){

            var qty = $('#stok_barang').val()
            $('#stok_barang').val(new Intl.NumberFormat("id-ID").format(qty))

            var qty_asli =  $('#stok_barang').val()
            var qty = qty_asli.replaceAll('.','')
            $('#stok').val(qty)

        })
</script>
