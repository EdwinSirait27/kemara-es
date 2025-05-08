{{-- @extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Dashboard Siswa')

@section('content')
<style>
  .text-center {
      text-align: center;
  }
</style>
@if(session('warning'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: '{{ session('warning') }}',
        });
    </script>
@endif
 --}}
 @extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Dashboard Guru')
@section('content')
    <style>
        .chart-canvas {
            display: block;
            width: 100%;
            height: 300px;
            z-index: 1;
        }
    </style>
    <div class="row mt-2">
        <div class="col-lg-12 mb-lg-0 mb-4"> <!-- Lebar kolom diperbesar dari col-lg-7 menjadi col-lg-9 -->
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex flex-column h-100">
                                <h5 class="font-weight-bolder">Kemara-ES | Dashboard Guru</h5>
                                <p class="mb-1 pt-2 text-bold">Selamat datang di Sistem Informasi Akademik SMAK Kesuma
                                    Mataram</p>
                                <p class=" mb-4" style="text-align: justify;">
                                    Sistem Informasi Akademik Kemara-ES adalah platform yang dirancang khusus untuk
                                    memfasilitasi data
                                    di lembaga pendidikan sekolah. Dengan menggunakan teknologi informasi dan komunikasi,
                                    sistem ini bertujuan
                                    untuk meningkatkan efisiensi dalam proses pendataan dan manajemen sekolah serta
                                    mendorong transparansi
                                    dan
                                    akuntabilitas dalam pengelolaan pendidikan. Dengan Sistem Informasi Akademik Kemara-ES,
                                    sekolah dapat
                                    mengoptimalkan proses akademik, meningkatkan kualitas pendidikan, dan memperkuat
                                    hubungan antara siswa,
                                    dan pihak sekolah.
                                </p>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row mt-4">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total User Aktif</p>
                                <h5 class="font-weight-bolder mb-0 text-primary">
                                    {{ $totaluser }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-center d-flex justify-content-center align-items-center">
                            <div class="icon icon-shape bg-gradient-info shadow-sm text-center border-radius-md p-3">
                                <i class="ni ni-money-coins text-lg opacity-10"
                                    aria-hidden="true"style="position: relative; top: -20px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Siswa Laki-Laki</p>
                                <h5 class="font-weight-bolder mb-0 text-success">
                                    {{ e($totallaki) }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-center d-flex justify-content-center align-items-center">
                            <div class="icon icon-shape bg-gradient-warning shadow-sm text-center border-radius-md p-3">
                                <i class="ni ni-world text-lg opacity-10"
                                    aria-hidden="true"style="position: relative; top: -20px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Siswa Perempuan</p>
                                <h5 class="font-weight-bolder mb-0 text-danger">
                                    {{ $totalperempuan }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-center d-flex justify-content-center align-items-center">
                            <div class="icon icon-shape bg-gradient-danger shadow-sm text-center border-radius-md p-3">
                                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"
                                    style="position: relative; top: -20px;"></i>
                                {{-- <i class="ni ni-circle-08 text-lg opacity-10" aria-hidden="true" style="position: relative; top: -20px;"></i> --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Guru</p>
                                <h5 class="font-weight-bolder mb-0 text-info">
                                    {{ $totalguru }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-center d-flex justify-content-center align-items-center">
                            <div class="icon icon-shape bg-gradient-secondary shadow-sm text-center border-radius-md p-3">
                                <i class="ni ni-circle-08 text-lg opacity-10" aria-hidden="true"
                                    style="position: relative; top: -20px;"></i>

                                {{-- <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card:hover {
            transform: translateY(-10px);
            transition: transform 0.3s ease;
        }

        .icon {
            font-size: 32px;
            /* Ukuran ikon lebih besar */
            color: #fff;
        }

        .numbers h5 {
            font-size: 1.5rem;
        }

        .col-4.text-center {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
    </style>


    <div class="row mt-4">
        <div class="col-lg-5 mb-lg-0 mb-4">
            <div class="card z-index-2">
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                @if (session('success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: '{{ session('success') }}',
                            confirmButtonText: 'OK',
                        });
                    </script>
                @endif

                @if (session('error'))
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: '{{ session('error') }}',
                            confirmButtonText: 'OK',
                        });
                    </script>
                @endif


            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card z-index-2">
            <div class="card-header pb-0">
                <h6>Grafik Siswa Berdasarkan Agama</h6>

            </div>
            <div class="card-body p-3">
                <div class="chart">
                    <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                </div>
            </div>
        </div>
        {{-- </div> --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Data untuk chart
            const data = {
                labels: ['Katolik', 'Kristen Protestan', 'Islam', 'Hindu', 'Buddha', 'Konghucu'], // Kategori agama
                datasets: [{
                    label: 'Jumlah Siswa',
                    data: [{{ $katolik }}, {{ $kristen }}, {{ $islam }}, {{ $hindu }},
                        {{ $buddha }}, {{ $kong }}
                    ], // Jumlah siswa berdasarkan agama
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Warna isi bar
                    borderColor: 'rgba(75, 192, 192, 1)', // Warna border
                    borderWidth: 1 // Ketebalan border
                }]
            };

            // Konfigurasi chart
            const config = {
                type: 'bar', // Jenis chart (bar, line, pie, dll)
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            enabled: true
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true // Dimulai dari nol
                        }
                    }
                }
            };

            // Render chart
            const ctx = document.getElementById('chart-line').getContext('2d');
            new Chart(ctx, config);
        </script>
    </div>

    {{-- disini --}}
    <div class="row mt-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    {{-- <h6>Role & Hak Akses</h6> --}}
                    <h6><i class="fas fa-user-shield"></i> Pengumuman Sekolah</h6>

                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0"id="users-table">
                            <thead>
                                <tr>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        No.</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Penngumuman</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Diupload Oleh</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tanggal Dibuat</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Action</th>

                                </tr>
                            </thead>
                        </table>
                        {{-- <button type="button" id="delete-selected" class="btn btn-danger btn-sm">
                              Delete
                          </button> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            let table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('pengumumansemua.data') }}',
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                columns: [{
                        data: 'id',
                        name: 'id',
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        },
                    },
                    {
                        data: 'pengumuman',
                        name: 'pengumuman',
                        className: 'text-center'
                    },
                    {
                        data: 'deskripsi',
                        name: 'deskripsi',
                        className: 'text-center'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        className: 'text-center'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    }

                ]
            });
        });
    </script>
    @if(session('warning'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Waduhh...',
            text: '{{ session('warning') }}',
        });
    </script>
@endif
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
        });
    </script>
@endif
    @if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('error') }}',
        });
    </script>
@endif

@endsection

