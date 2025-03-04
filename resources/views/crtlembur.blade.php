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
                <a class="navbar-brand" href="{{ route('dashboard') }}">{{ Auth::user()->name }}</a>
            </div>
 
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                    <a href="{{ route('dashboard') }}">Home</a>
                    </li>
                    <li>
                    <a href="{{ route('profile') }}">Profile</a>
                    </li>
                    <li>
                    <a href="{{ route('crtlembur') }}">Pengajuan Lembur</a>
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
                        <div class="form-inline">
                        </div>
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
            PENGAJUAN LEMBUR
        </div>

        <!-- Main Content -->
        <div class="container mt-4">
            <div class="user-info">
            <form action="{{ route('crtlembur') }}" method="POST" class="shadow p-4 bg-white rounded" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Nama Karyawan</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" readonly>
                </div>
                <br>
                <div class="form-group">
                    <label for="division">Divisi</label>
                    <select class="form-control" id="division" name="division" disabled>
                        <option value="Admin" {{ Auth::user()->devisi == 'Admin' ? 'selected' : '' }}>Admin</option>
                        <option value="Digital" {{ Auth::user()->devisi == 'Digital' ? 'selected' : '' }}>Digital</option>
                        <option value="IT" {{ Auth::user()->devisi == 'IT' ? 'selected' : '' }}>IT</option>
                    </select>
                    <!-- Input hidden untuk divisi yang akan dikirim -->
                    <input type="hidden" name="division" value="{{ Auth::user()->devisi }}">
                </div>

                <br>
                <div class="form-group">
                    <label for="date">Tanggal Pengajuan Lembur</label>
                    <input type="date" class="form-control" id="date" name="tanggal" required>
                </div>
                <br>

                <div class="form-group">
                    <label for="time_in">Jam Masuk</label>
                    <input type="time" class="form-control" id="time_in" name="jam_masuk" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="time_out">Jam Pulang</label>
                    <input type="time" class="form-control" id="time_out" name="jam_pulang" required>
                </div>

                <div class="form-group">
                    <label for="time_mulai">Jam Mulai Lembur</label>
                    <input type="time" class="form-control" id="time_mulai" name="jam_mulai" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="time_selesai">Jam Selesai Lembur</label>
                    <input type="time" class="form-control" id="time_selesai" name="jam_selesai" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="overtime_duration">Durasi Lembur (Jam)</label>
                    <input type="number" class="form-control" id="overtime_duration" name="jml_lembur" step="0.1" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="reason">Pekerjaan</label>
                    <textarea class="form-control" id="reason" name="pekerjaan" required></textarea>
                </div>
                <br>
                <div class="form-group">
                    <label for="hasil_lembur">Hasil Lembur</label>
                    <textarea class="form-control" id="hasil_lembur" name="hasil_lembur" required></textarea>
                </div>
                <br>

                <!-- Kondisi jika ada file sebelumnya -->
               
                <div class="form-group">
                    <label for="upload_doc">Dokumentasi Lembur</label>
                    @if(isset($lembur) && $lembur->upload_doc)
                        <a href="{{ asset('storage/' . $lembur->upload_doc) }}" target="_blank">Lihat File</a>
                    @endif
                    <input type="file" class="form-control" id="upload_doc" name="upload_doc" accept=".pdf,.docx,.jpg,.png">
                    @if ($errors->has('upload_doc'))
                        <small class="text-danger">{{ $errors->first('upload_doc') }}</small>
                    @endif
                </div>
             
                 
                <div class="form-group">
                    <label for="lokasi">Lokasi</label>
                    <input type="text" class="form-control" id="lokasi" name="lokasi" >
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Ajukan Lembur</button>
            </form>

            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil elemen input
        const timeIn = document.getElementById('time_mulai');
        const timeOut = document.getElementById('time_selesai');
        const overtimeDuration = document.getElementById('overtime_duration');

        // Fungsi untuk menghitung durasi lembur
        function calculateOvertime() {
            // Ambil nilai jam mulai dan jam selesai
            const start = timeIn.value;
            const end = timeOut.value;

            // Pastikan kedua waktu ada sebelum melakukan perhitungan
            if (start && end) {
                const [startHour, startMinute] = start.split(':').map(Number);
                const [endHour, endMinute] = end.split(':').map(Number);

                // Convert waktu ke menit
                const startTimeInMinutes = startHour * 60 + startMinute;
                const endTimeInMinutes = endHour * 60 + endMinute;

                // Hitung selisih dalam menit
                let diffInMinutes = endTimeInMinutes - startTimeInMinutes;

                // Jika selisihnya negatif (jam selesai lebih awal), tambahkan 24 jam (1440 menit)
                if (diffInMinutes < 0) {
                    diffInMinutes += 1440;
                }

                // Hitung durasi lembur dalam jam dengan format decimal (misal 2.5 jam)
                const durationInHours = diffInMinutes / 60;

                // Setkan nilai durasi lembur ke input
                overtimeDuration.value = durationInHours.toFixed(1);
            }
        }

        // Event listener untuk mengupdate durasi lembur saat waktu berubah
        timeIn.addEventListener('change', calculateOvertime);
        timeOut.addEventListener('change', calculateOvertime);
    });
</script>

</body>
</html>