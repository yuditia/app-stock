<!DOCTYPE html>
<html lang="en">

    <head>
        @include('partials.head')
        <title>Pengambilan - CV. Subur makmur</title>
        <link rel="stylesheet" href="{{ asset('/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
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
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                            Pengambilan
                            </li>
                        </ol>
                    </nav>

                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">


                                    <h6 class="card-title">Halaman View Pengambilan</h6>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="{{ route('pengambilan.create') }}" class="btn btn-primary my-3">Tambah Pengambilan</a>
                                        </div>
                                    </div>

                                    <div class="table-responsive">

                                        <table id="example2" class="table img-view-hostory">
                                            <thead>
                                                <tr>
                                                    <th>Nomor</th>
                                                    <th>No Transaksi</th>
                                                    <th>Nama Barang</th>
                                                    <th>Warna Barang</th>
                                                    <th>Jumlah Barang</th>
                                                    <th>Tgl Pengambilan</th>
                                                    <th>Suplier</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($data as $item)
                                                <tr>
                                                    <td></td>
                                                    <td>{{ $item->no_transaksi }}</td>
                                                        @foreach ($item->barang as $item2)
                                                            <td>{{ $item2->nm_barang }}</td>
                                                            <td>{{ $item2->wr_barang }}</td>

                                                            <td>
                                                                {{ number_format($item->qty,2,",",".") }}

                                                                @if ($item->satuan == 1)
                                                                    Meter
                                                                @elseif ($item->satuan == 2)
                                                                    Pasang
                                                                @elseif ($item->satuan == 3)
                                                                    Blek
                                                                @elseif ($item->satuan == 4)
                                                                    Galon
                                                                @elseif ($item->satuan == 5)
                                                                    Kodi
                                                                @elseif ($item->satuan == 6)
                                                                    Pc
                                                                @endif
                                                            </td>
                                                            @endforeach
                                                        @foreach ($item->pengambilan as $item2)
                                                            <td>{{  date("d-m-Y",strtotime($item2->tgl_pengambilan)) }}</td>
                                                            <td>{{ $item2->suplier }}</td>
                                                        @endforeach
                                                    <td>
                                                        <a href="/pengambilan/{{ $item->id }}/edit" class="btn btn-primary"> Edit </a>

                                                        <a href="#" class="btn btn-danger delete"  data-id="{{ $item->id }}">Delete</a></td>
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
<script src="{{ asset('/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('/js/data-table.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    </script>
<script>
    $(document).ready(function(){



                    $('.delete').on('click',function(){

                        var id = $(this).data("id")

                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                            confirmButton: 'btn btn-success',
                            cancelButton: 'btn btn-danger'
                            },
                            buttonsStyling: false
                        })

                        swalWithBootstrapButtons.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, delete it!',
                            cancelButtonText: 'No, cancel!',
                            reverseButtons: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "DELETE",
                                    url: "/pengambilan" + '/' + id,
                                    cache: false,
                                    data: id,
                                    processData: false,
                                    contentType: false,
                                    dataType: 'JSON',


                                    success: function (data) {

                                        swalWithBootstrapButtons.fire(
                                            'Deleted!',
                                            'Your file has been deleted.',
                                            'success'
                                        )

                                    setTimeout(function () {
                                        location.reload();
                                        }, 3000);

                                    },
                                    error: function (data, jqXHR, textStatus, errorThrown) {
                                        console.log('data',data);
                                        console.log(textStatus);
                                    },
                                });

                            } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                            ) {
                            swalWithBootstrapButtons.fire(
                                'Cancelled',
                                'Your imaginary file is safe :)',
                                'error'
                            )
                            }
                        })

                    })



                const table = new DataTable('#example2', {
                    columnDefs: [
                        {
                            searchable: false,
                            orderable: false,
                            targets: 0
                        }
                    ],
                    order: [[1, 'asc']]
                });

                table
                    .on('order.dt search.dt', function () {
                        let i = 1;

                        table
                            .cells(null, 0, { search: 'applied', order: 'applied' })
                            .every(function (cell) {
                                this.data(i++);
                            });
                    })
                    .draw();


    })
</script>
