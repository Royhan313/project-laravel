<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Royhan.magang</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-icon.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="{{ asset('style/assets/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/scss/style.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <style>
                /* Membungkus tabel dengan scroll untuk layar kecil */
        .user-info {
            overflow-x: auto; /* Memungkinkan scroll horizontal */
        }

        .user-info table {
            width: 100%; /* Membuat tabel sesuai lebar container */
            border-collapse: collapse; /* Menghilangkan spasi antar sel */
        }

        .user-info th, 
        .user-info td {
            text-align: left; /* Menjadikan teks rata kiri */
            padding: 8px; /* Menambah jarak dalam sel */
            word-wrap: break-word; /* Memastikan teks panjang terpotong sesuai */
        }

        .user-info thead th {
            background-color: #f8f9fa; /* Warna background untuk header tabel */
            position: sticky; /* Membuat header tetap di atas saat scrolling */
            top: 0;
            z-index: 2; /* Supaya header tetap di atas */
        }

        /* Tambahkan media query untuk layar kecil */
        @media (max-width: 768px) {
            .user-info table {
                font-size: 14px; /* Memperkecil ukuran font tabel */
            }

            .user-info th, 
            .user-info td {
                white-space: nowrap; /* Memastikan teks tidak memanjang ke bawah */
            }
        }

        /* Style tambahan untuk table cards */
        .card {
            margin-bottom: 16px; /* Menambah jarak antar card */
            border-radius: 8px; /* Membuat sudut card lebih lembut */
            border: 1px solid #e1e1e1; /* Memberi batas pada card */
        }

        .card h5 {
            font-weight: bold; /* Memberikan efek tebal pada judul card */
        }

        .card p {
            font-size: 20px; /* Membuat teks pada card lebih jelas */
            font-weight: 600;
            color: #495057; /* Warna teks */
        }
    </style>
</head>
<body>
    
    <script src="{{ asset('style/assets/js/vendor/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('style/assets/js/main.js') }}"></script>
 
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
              <a class="navbar-brand" href="{{ route('dashboard') }}">{{ Auth::user()->role }}</a>

                <a class="navbar-brand hidden" href=""></a>
            </div>
 
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                    <a href="{{ route('dashboard') }}">Home</a>
                    </li>
                    <li>
                    <a href="{{ route('profileadmin') }}">Profile</a>
                    </li>
                    <li>
                    <a href="{{ route('approval') }}">Persetujuan Lembur</a>
                    </li>
                    <li>
                    <a href="{{ route('register') }}">Buat Akun</a>
                    </li>
                    <li>
                    <a href="{{ route('role') }}">Role</a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->
 
    <div id="right-panel" class="right-panel">
        <header id="header" class="header">
            <div class="header-menu">
                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                    </div>
                </div>
 
                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="{{ asset('style/images/admin.jpg') }}">
                        </a>
                        <div class="user-menu dropdown-menu">
                        <a href="{{ route('profileadmin') }}">Profile</a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger w-100 mt-2">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
 
        </header><!-- /header -->
 
        <div class="content">
        <!-- Header -->
        <div class="header">
            <span>Welcome </span><span>{{ Auth::user()->name }} </span>
        </div>

        <!-- Main Content -->
        <div class="container mt-4">
           <!-- Info Cards -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Lembur</h5>
                            <p class="card-text" id="ttl-lembur">{{ $lemburCount }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Menunggu Persetujuan</h5>
                            <p class="card-text" id="ttl-">{{ $lemburCountP }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ditolak</h5>
                            <p class="card-text">{{ $lemburCountR }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Disetujui</h5>
                            <p class="card-text">{{ $lemburCountS }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Data Pengajuan Lembur -->
            <div class="container mt-4">
                <div class="user-info">
                    <h3>Data Pengajuan Lembur</h3>
                    <!-- Tabel Data Lembur -->
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Nama</th>
                                <th>Divisi</th>
                                <th>Tanggal</th>
                                <th>Jam Masuk</th>
                                <th>Jam Pulang</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Durasi Lembur (Jam)</th>
                                <th>Pekerjaan</th>
                                <th>Hasil Lembur</th>
                                <th>File Upload</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                                </tr>
                        </thead>
                        <tbody>
                            @foreach ($lemburData as $lembur)
                                <tr>
                                    <td  id="seq"></td>
                                    <td>{{ $lembur->name }}</td>
                                    <td>{{ $lembur->division }}</td>
                                    <td>{{ $lembur->tanggal }}</td>
                                    <td>{{ $lembur->jam_masuk }}</td>
                                    <td>{{ $lembur->jam_pulang }}</td>
                                    <td>{{ $lembur->jam_mulai }}</td>
                                    <td>{{ $lembur->jam_selesai }}</td>
                                    <td>{{ $lembur->jml_lembur }}</td>
                                    <td>{{ $lembur->pekerjaan }}</td>
                                    <td>{{ $lembur->hasil_lembur }}</td>
                                    <td>
                                        <a href="{{ route('privew', $lembur->id) }}" class="btn btn-success btn-sm" >Preview</a>
                                    </td>
                                 <!--   <td>{{ $lembur->upload_doc }}</td> -->
                                    <td>{{ $lembur->lokasi }}</td>
                                    <td>{{ $lembur->status }}</td>
                                   
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
    @if(session('success'))
<script>
    Swal.fire({
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        icon: 'success',
        confirmButtonText: 'OK'
    });
</script>
@endif
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('table tbody tr');
        rows.forEach((row, index) => {
            row.querySelector('td#seq').textContent = index + 1;
        });
    });
</script>
 
</body>
</html>