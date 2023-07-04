<!DOCTYPE html>
<html lang="en">

    <head>
        @include('partials.head')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <title>Tambah Pengambilan - CV. Subur makmur</title>
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
                        <li class="breadcrumb-item"><a href="#">Pengambilan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Pengambilan</li>
                    </ol>
                </nav>

                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">

                                <form action="{{ route('pengambilan.store') }}" method="POST" >
                                    @csrf
                                    <div class="mb-3">
                                        <label for="no_transaksi" class="form-label fw-bold">No Transaksi</label>
                                        <input type="text" id="no_transaksi" name="no_transaksi" class="form-control"
                                        aria-describedby="no_transaksi" value="{{ $id }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="tgl_pengambilan" class="form-label fw-bold">Tgl Pengambilan</label>
                                        <input type="text" id="tgl_pengambilan" name="tgl_pengambilan" class="form-control" placeholder="dd-mm-yyyy"
                                        aria-describedby="tgl_pengambilan" value="{{  date("d-m-Y",strtotime($now)) }}"
                                        required>
                                    </div>


                                    <div class="mb-3">
                                        <label for="suplier" class="form-label fw-bold">Suplier</label><br>
                                        <select class="form-select form-control" name="suplier" aria-label="Default select example" id="suplier">
                                            @foreach ($sup as $item)
                                            <option value="{{ $item->nm_suplier }}">{{ $item->nm_suplier }}</option>
                                            @endforeach
                                          </select>
                                    </div>

                                    <table class="table table-bordered mb-3" id="item_table">
                                        <thead>
                                            <tr>
                                                <th class="text-left">Barang</th>
                                                <th class="text-center">Qty</th>
                                                <th class="text-center"><button type="button" name="add" class="btn btn-success btn-xs add"><i class="link-icon" data-feather="plus"></i></button></th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>


                                    <button type="submit" class="btn btn-primary his-btn">Submit</button>
                                </form>

                                <div class="row">
                                    <a href="/pengambilan" class="btn btn-outline-primary mx-w100"> <i class="bi bi-arrow-left"></i> Kembali</a>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('/vendors/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('/js/tinymce.js') }}"></script>

<script>
    $(document).ready(function() {


        $('#tgl_pengambilan').datepicker({
            "format": "dd-mm-yyyy",
            autoclose: true
        });

        {{--  function makeid(length) {
            let result = '';
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            const charactersLength = characters.length;
            let counter = 0;
            while (counter < length) {
              result += characters.charAt(Math.floor(Math.random() * charactersLength));
              counter += 1;
            }
            return result;
        }

        $('#no_transaksi').val('TR-' + makeid(10))  --}}


        var count = 0

        $(document).on('click', '.add', function() {

            count++

            var html = ''
            html += '<tr>'
            html += '<td><select name="barang[]" id="barang' + count + '" class="form-control form-select add-barang js-example-basic-single" style="width: 100%" required><option value="">Pilih Barang</option>@foreach ($barang as $item) <option value="{{ $item->id }}">{{ $item->nm_barang }} {{ $item->wr_barang }}</option>@endforeach</select></td>'
            html += '<td><input type="text" name="qty[]" id="qty' + count + '" class="form-control" required></td>'
            html += '<td class="text-center"><button type="button" name="remove" class="btn btn-danger btn-xs remove">Remove</td>'
            html += '</tr>'
            $('#item_table tbody').append(html)
            $('.add-barang').select2({
                width: '100%' // need to override the changed default
            })


        })


        $(document).on('click', '.remove', function() {
            $(this).closest('tr').remove()
        })


    })


</script>

<style>
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 10px;
    }
</style>
