<!DOCTYPE html>
<html lang="en">

    <head>
        @include('partials.head')
        <title>Reporting Stok</title>
        {{--  <link rel="stylesheet" href="{{ asset('/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">  --}}
        <link href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-html5-2.3.6/fc-4.2.2/fh-3.3.2/r-2.4.1/datatables.min.css" rel="stylesheet"/>
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


                                    <h6 class="card-title">Halaman Reporting Stok</h6>


                                    <div class="table-responsive">

                                        <table id="report-stock" class="table img-view-hostory">
                                            <thead>
                                                <tr>
                                                    <th>Nomor</th>
                                                    <th>Foto Barang</th>
                                                    <th>Nama Barang</th>
                                                    <th>Warna Barang</th>
                                                    <th>QTY</th>
                                                    <th>Harga</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($data as $item)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td><img src="{{ asset('barang_img/'.$item->foto_barang) }}" width="100px" height="100px"></td>
                                                    <td>{{ $item->nm_barang }}</td>
                                                    <td><p class="clamp-3">{{ $item->wr_barang }}</p></td>
                                                    <td>{{ number_format($item->stok_barang,0,",",".") }}
                                                        @if ($item->satuan == 1)
                                                            Meter
                                                        @elseif ($item->satuan == 1)
                                                            Pasang
                                                        @elseif ($item->satuan == 2)
                                                            Blek
                                                        @elseif ($item->satuan == 3)
                                                            Galon
                                                        @elseif ($item->satuan == 4)
                                                            Kodi
                                                        @elseif ($item->satuan == 5)
                                                            Pc
                                                        @endif
                                                    </td>
                                                    <td>Rp. {{ number_format($item->harga,0,",",".") }}</td>
                                                    <td>
                                                       Rp. {{ number_format($item->stok_barang * $item->harga,0,",",".") }}
                                                    </td>
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

