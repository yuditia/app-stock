<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">CV.<span> Subur makmur</span> </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            {{--  <!-- kategorimain -->  --}}
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                <a href="/" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>

            {{--  <!-- kategoriprofil -->  --}}
            <li class="nav-item nav-category">Master Data</li>
            <li class="nav-item {{ Request::is('barang*') ? 'active' : '' }}">
                <a href="{{ route('barang.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="book-open"></i>
                    <span class="link-title">Master Barang</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('suplier*') ? 'active' : '' }}">
                <a href="{{ route('suplier.index') }}" class="nav-link ">
                    <i class="link-icon" data-feather="sunrise"></i>
                    <span class="link-title">Master Suplier</span>
                </a>
            </li>


            {{--  <!-- kategori akademik -->  --}}
            <li class="nav-item nav-category">Transaksi</li>

            <li class="nav-item {{ Request::is('pengambilan*') ? 'active' : '' }}">
                <a href="{{ route('pengambilan.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="trello"></i>
                    <span class="link-title">Pengambilan Barang</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('pembelian*') ? 'active' : '' }}">
                <a href="{{ route('pembelian.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Pembelian Barang</span>
                </a>
            </li>

            <li class="nav-item nav-category">Reporting</li>




            <li class="nav-item {{ Request::is('report-stok*') ? 'active' : '' }}">
                <a href="{{ route('report-stok') }}" class="nav-link">
                    <i class="link-icon" data-feather="globe"></i>
                    <span class="link-title">Report Stok</span>
                </a>
            </li>

            <li class="nav-item {{ Request::is('report-pengambilan*') ? 'active' : '' }}">
                <a href="{{ route('report-pengambilan') }}" class="nav-link">
                    <i class="link-icon" data-feather="map"></i>
                    <span class="link-title">Report Pengambilan</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('report-pembelian*') ? 'active' : '' }}">
                <a href="{{ route('report-pembelian') }}" class="nav-link">
                    <i class="link-icon" data-feather="map"></i>
                    <span class="link-title">Report Pembelian</span>
                </a>
            </li>

            {{--  <!-- Role -->  --}}
            <li class="nav-item nav-category">Akun</li>
            <li class="nav-item">
                <a href="{{ route('user.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="user"></i>
                    <span class="link-title">Akun</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="logout()">
                    <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18"
		                                height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
		                                stroke-linecap="round" stroke-linejoin="round">
		                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
		                                <polyline points="16 17 21 12 16 7"></polyline>
		                                <line x1="21" y1="12" x2="9" y2="12"></line>
		                            </svg>
                    <span class="link-title">Logout</span>
                </a>
            </li>
        </ul>
    </div>
</nav>



<script>

    function logout() {

        var formData = { 'logout' : 'logout'};

            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

            $.ajax({
                type: "POST",
                url: "{{ route('logout') }}",
                cache: false,
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'JSON',


                success: function (data) {

                        swal.fire(  data.message,
                            "   ",
                            "success");
                setTimeout(function () {
                    window.location.href = "{{ route('login')}}";
                    }, 3000);





                },
                error: function (data, jqXHR, textStatus, errorThrown) {

                     swal.fire(  "Harap cek semua data",
                            "   ",
                            "error");
                },
            });

    }
</script>
