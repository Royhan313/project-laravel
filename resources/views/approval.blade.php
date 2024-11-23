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
                <a class="navbar-brand" href="">Royhan.Magang.Admin</a>
                <a class="navbar-brand hidden" href="">M</a>
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
                        <a href="{{ route('profile') }}">Profile</a>
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
                    <h3>Data Pengajuan Lembur</h3>
                    <!-- Tabel Data Lembur -->
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Divisi</th>
                                <th>Tanggal</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Durasi Lembur (Jam)</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lemburData as $lembur)
                                <tr>
                                    <td>{{ $lembur->id }}</td>
                                    <td>{{ $lembur->name }}</td>
                                    <td>{{ $lembur->division }}</td>
                                    <td>{{ $lembur->tanggal }}</td>
                                    <td>{{ $lembur->jam_mulai }}</td>
                                    <td>{{ $lembur->jam_selesai }}</td>
                                    <td>{{ $lembur->jml_lembur }}</td>
                                    <td>{{ $lembur->keterangan }}</td>
                                    <td>{{ $lembur->status }}</td>
                                    <td>
                                        <!-- Tombol Approve -->
                                        <a href="{{ route('approveLembur', $lembur->id) }}" class="btn btn-success btn-sm" onclick="return confirm('Apakah Anda yakin ingin menyetujui lembur ini?')">Approve</a>

                                        <!-- Tombol Reject -->
                                        <a href="{{ route('rejectLembur', $lembur->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menolak lembur ini?')">Reject</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
    </div>

 
</body>
</html>