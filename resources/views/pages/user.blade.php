<!DOCTYPE html>
<html lang="en">

    <head>
        @include('partials.head')
        <title>User - CV. Subur makmur</title>
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
                            User
                            </li>
                        </ol>
                    </nav>

                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">


                                    <h6 class="card-title">Halaman View User</h6>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="{{ route('user.create') }}" class="btn btn-primary my-3">Tambah User</a>
                                        </div>
                                    </div>

                                    <div class="table-responsive">

                                        <table id="dataTableExample" class="table img-view-hostory">
                                            <thead>
                                                <tr>
                                                    <th>Nomor</th>
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                    <th>Password</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($user as $item)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td><p class="clamp-3">{{ $item->email }}</p></td>
                                                    <td>{{ $item->password }}</td>
                                                    <td>
                                                        <a href="/user/{{ $item->id }}/edit" class="btn btn-primary"> Edit </a>

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
    $(function(){
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
                        url: "/user" + '/' + id,
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
    })
</script>
