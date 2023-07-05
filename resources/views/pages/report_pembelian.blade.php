<!DOCTYPE html>
<html lang="en">

    <head>
        @include('partials.head')
        <title>Reporting pembelian</title>
        <link rel="stylesheet" href="{{ asset('/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
        <style>
            div.dt-button, a.dt-button, input.dt-button {
                border-radius: 50%
            }
        </style>
    </head>

    <body>
        <div class="main-wrapper">
            @include('partials.sidebar')

            <div class="page-wrapper">

                @include('partials.navbar')
                @include('sweetalert::alert')

                <div class="page-content">
                    <nav class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                            User
                            </li>
                        </ol>
                    </nav>

                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">


                                    <h6 class="card-title">Halaman Reporting pembelian</h6>
                                    <div class="row">
                                        <div class="col-md-3 col-sm-5 rev-padding mb-3">
                                            <label for="inputState">Start Date</label>
                                            <div class="input-group">
                                                <input type="text" name="start" id="start" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-sm-3">
                                            <label for="inputState">End Date</label>
                                            <div class="input-group ">
                                                <input type="text" name="end" id="end" class="form-control  w-refrence2">
                                                <div class="input-group-append2">
                                                    <button class="btn btn-primary mkr-4 btn-md ms-3" onclick="apply()" type="button" id="filter">Apply</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">

                                            <div class="col-md-6 col-sm-5 rev-padding mb-3">
                                                <label for="inputState">Nama Barang</label>
                                                <div class="input-group">
                                                    <select class="js-example-basic-single" name="nm_barang" id="nm_barang">
                                                        @foreach ($barang as $item)
                                                            <option value="{{ $item->id }}">{{ $item->nm_barang }} - {{ $item->wr_barang }}</option>
                                                        @endforeach
                                                      </select>
                                                      <div class="input-group-append2">
                                                        <button class="btn btn-primary mkr-4 btn-xs ms-3" onclick="filter()" type="button" id="filter">Apply</button>
                                                    </div>
                                                </div>
                                            </div>

                                    </div>



                                    <div class="table-responsive">

                                        <table id="report-stock" class="table img-view-hostory">
                                            <thead>
                                                <tr>

                                                    <th>No Transaksi</th>
                                                    <th>Nama Barang</th>
                                                    <th>Warna Barang</th>
                                                    <th>Jumlah Barang</th>
                                                    <th>Tgl pembelian</th>
                                                    <th>Suplier</th>
                                                    <th>Harga</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($data as $item)
                                                <tr>

                                                    <td>{{ $item->no_transaksi }}</td>
                                                    @foreach ($item->barang as $item2)

                                                        <td>{{ $item2->nm_barang }}</td>
                                                        <td>{{ $item2->wr_barang }}</td>

                                                        <td>{{ number_format($item->qty,2,",",".") }}
                                                            @if ($item2->satuan == 1)
                                                                Meter
                                                            @elseif ($item2->satuan == 2)
                                                                Pasang
                                                            @elseif ($item2->satuan == 3)
                                                                Blek
                                                            @elseif ($item2->satuan == 4)
                                                                Galon
                                                            @elseif ($item2->satuan == 5)
                                                                Kodi
                                                            @elseif ($item2->satuan == 6)
                                                                Pc
                                                            @endif
                                                        </td>

                                                                @foreach ($item->pembelian as $item3)
                                                                    <td>{{ date("d-m-Y",strtotime($item3->tgl_pembelian)) }}</td>
                                                                    <td>{{ $item3->suplier }}</td>
                                                                @endforeach
                                                        <td>Rp. {{ number_format($item2->harga,0,",",".") }}</td>
                                                        <td>
                                                        Rp. {{ number_format($item->qty * $item2->harga,0,",",".") }}
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
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



<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#nm_barang').select2({
            'width': '50%'
        })

        $('#start').datepicker({
            "format": "dd-mm-yyyy",
            autoclose: true
        });

        $('#end').datepicker({
            "format": "dd-mm-yyyy",
            autoclose: true
        });


    })
</script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    </script>
<script>
    $('#report-stock').DataTable({
        dom: 'Bfrtip',
        "paging": true,
        "pageLength": 10,
        lengthMenu: [[ 10, 25, 50, -1 ], [10, 25, 50, "All"]],
        buttons: [
        'pageLength',
                                {
                                    extend:    'copy',
                                    text:      '<i class="bi bi-clipboard-check mr-2"></i> Copy',
                                    titleAttr: 'Copy'
                                },
                                {
                                    extend:    'excel',
                                    text:      '<i class="bi bi-file-excel mr-2"></i> Excel',
                                    titleAttr: 'Excel'
                                },
                                {
                                    extend:    'print',
                                    text:      '<i class="bi bi-printer-fill mr-2"></i> Print',
                                    titleAttr: 'PDF'
                                }
                            ],
    });

</script>

<script>
    function apply()
    {
        var start = $('#start').val();
        var end = $('#end').val();

        $.get('filter-pembelian/'+start +'/'+end, function(data){
            console.log(data.data)

            $('#report-stock').DataTable().destroy();
            $('#report-stock').DataTable({
                dom: 'Bfrtip',
                "paging": true,
                "pageLength": 10,
                lengthMenu: [[ 10, 25, 50, -1 ], [10, 25, 50, "All"]],
                buttons: [
                    'pageLength',
                    {
                        extend:    'copy',
                        text:      '<i class="bi bi-clipboard-check mr-2"></i> Copy',
                        titleAttr: 'Copy'
                    },
                    {
                        extend:    'excel',
                        text:      '<i class="bi bi-file-excel mr-2"></i> Excel',
                        titleAttr: 'Excel'
                    },
                    {
                        extend:    'print',
                        text:      '<i class="bi bi-printer-fill mr-2"></i> Print',
                        titleAttr: 'PDF'
                    }
                            ],
                "data" : data.data,
                "columns" : [

                {data: 'no_transaksi', name: 'no_transaksi'},
                {data: 'nm_barang', name: 'nm_barang'},
                {data: 'wr_barang', name: 'wr_barang'},
                {data: null, name: 'qty',render:function(data, type, row, meta){
                    function change(e){
                        if(e == 1){
                            return 'Meter';
                        }else if(e == 2){
                            return 'Pasang';
                        }else if(e == 3){
                            return 'Blek';
                        }else if(e == 4){
                            return 'Galon';
                        }else if(e == 5){
                            return 'Kodi';
                        }else{
                            return 'Pc';
                        }
                    }

                    const price = data.qty
                    const rupiah = new Intl.NumberFormat("id-ID",{maximumFractionDigits: 2,
                        minimumFractionDigits: 0,}).format(price);

                    return rupiah + ' ' + change(data.satuan)
                }},
                {data: 'tgl_pembelian', name: 'tgl_pembelian',render: DataTable.render.datetime('DD-MM-YYYY')},
                {data: 'suplier', name: 'suplier'},
                {data: 'harga', name: 'harga',render: $.fn.dataTable.render.number( '.', '.', 0, 'Rp ' )},
                {data: null, name: 'total',render: function(data, type, row, meta)
                {
                    const rupiah = (number)=>{
                        return new Intl.NumberFormat("id-ID", {

                          style: "currency",
                          currency: "IDR",
                          maximumFractionDigits: 2,
                          minimumFractionDigits: 0,
                        }).format(number);
                      }

                    return rupiah(data.qty * data.harga)
                }
                }, //perkalian dari qty * harga
            ],

            columnDefs:[
                {
                    "targets": "7",
                    "defaultContent": "-"
                }
            ]


            })
        })
    }


    function filter(){
        var barang_id = $('#nm_barang').val();

        $.get('filter-pembelian-barang/'+barang_id , function(data){
            console.log(data.data)

            $('#report-stock').DataTable().destroy();
            $('#report-stock').DataTable({
                dom: 'Bfrtip',
                "paging": true,
                "pageLength": 10,
                lengthMenu: [[ 10, 25, 50, -1 ], [10, 25, 50, "All"]],
                buttons: [
                    'pageLength',
                    {
                        extend:    'copy',
                        text:      '<i class="bi bi-clipboard-check mr-2"></i> Copy',
                        titleAttr: 'Copy'
                    },
                    {
                        extend:    'excel',
                        text:      '<i class="bi bi-file-excel mr-2"></i> Excel',
                        titleAttr: 'Excel'
                    },
                    {
                        extend:    'print',
                        text:      '<i class="bi bi-printer-fill mr-2"></i> Print',
                        titleAttr: 'PDF'
                    }
                            ],
                "data" : data.data,
                "columns" : [

                {data: 'no_transaksi', name: 'no_transaksi'},
                {data: 'nm_barang', name: 'nm_barang'},
                {data: 'wr_barang', name: 'wr_barang'},
                {data: null, name: 'qty',render:function(data, type, row, meta){
                    function change(e){
                        if(e == 1){
                            return 'Meter';
                        }else if(e == 2){
                            return 'Pasang';
                        }else if(e == 3){
                            return 'Blek';
                        }else if(e == 4){
                            return 'Galon';
                        }else if(e == 5){
                            return 'Kodi';
                        }else{
                            return 'Pc';
                        }
                    }

                    const price = data.qty
                    const rupiah = new Intl.NumberFormat("id-ID",{maximumFractionDigits: 2,
                        minimumFractionDigits: 0,}).format(price);

                    return rupiah + ' ' + change(data.satuan)
                }},
                {data: 'tgl_pembelian', name: 'tgl_pembelian',render: DataTable.render.datetime('DD-MM-YYYY')},
                {data: 'suplier', name: 'suplier'},
                {data: 'harga', name: 'harga',render: $.fn.dataTable.render.number( '.', '.', 0, 'Rp ' )},
                {data: null, name: 'total',render: function(data, type, row, meta)
                {
                    const rupiah = (number)=>{
                        return new Intl.NumberFormat("id-ID", {

                          style: "currency",
                          currency: "IDR",
                          maximumFractionDigits: 2,
                          minimumFractionDigits: 0,
                        }).format(number);
                      }

                    return rupiah(data.qty * data.harga)
                }
                }, //perkalian dari qty * harga
            ],

            columnDefs:[
                {
                    "targets": "7",
                    "defaultContent": "-"
                }
            ]


            })
        })
    }
</script>

<style>
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 10px;
    }
</style>
