<!doctype html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Royhan.magang</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-icon.png">
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
                <div class="user-info">
                    <h3>Data Akun</h3>
                    <!-- Tabel Data Lembur -->
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Divisi</th>
                                <th>Role</th>
                                <th>Update Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roledata as $role)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->email }}</td>
                                    <td>{{ $role->devisi }}</td>   
                                    <td>
                                        <form action="{{ route('update.role', $role->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <select name="role" class="form-select form-select-sm" style="width: auto;">
                                                <option value="" {{ is_null($role->role) ? 'selected' : '' }}>-- Pilih Role --</option>
                                                <option value="IT Head" {{ $role->role === 'IT Head' ? 'selected' : '' }}>IT Head</option>
                                                <option value="IT test" {{ $role->role === 'IT test' ? 'selected' : '' }}>IT test</option>
                                                <option value="User" {{ $role->role === 'User' ? 'selected' : '' }}>User</option>
                                            </select>
                                    </td>
                                    <td>
                                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Apakah Anda yakin ingin mengubah role?')">Update</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>
            </div>
    </div>
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