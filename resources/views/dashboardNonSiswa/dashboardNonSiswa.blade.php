@extends('layouts.user_type.auth')
@section('title', 'Kemara-ES | Dashboard')
@section('content')
    <style>
      /* Base styles */
.chart-canvas {
    display: block;
    width: 100%;
    height: 300px;
    z-index: 1;
}

.osis-card {
    margin-bottom: 1.25rem;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 0.5rem;
    overflow: hidden;
    transition: transform 0.3s ease;
}

.osis-card:hover {
    transform: scale(1.05);
}

.osis-card img {
    width: 80%;
    height: auto;
    max-height: 400px;
    object-fit: cover;
}

.osis-card .caption {
    padding: 0.5rem;
    background-color: #f8f9fa;
}

.osis-card p {
    margin: 0.3125rem 0;
}

.vote-button {
    margin-top: 1rem;
}

.card:hover {
    transform: translateY(-0.625rem);
    transition: transform 0.3s ease;
}

.icon {
    font-size: 2rem;
    color: #fff;
}

.numbers h5 {
    font-size: 1.5rem;
}

/* Responsive breakpoints */
@media screen and (max-width: 1200px) {
    .osis-card img {
        width: 90%;
        max-height: 350px;
    }
}

@media screen and (max-width: 992px) {
    .osis-card img {
        width: 95%;
        max-height: 300px;
    }
    
    .numbers h5 {
        font-size: 1.25rem;
    }
    
    .icon {
        font-size: 1.75rem;
    }
}

@media screen and (max-width: 768px) {
    .chart-canvas {
        height: 250px;
    }
    
    .osis-card img {
        width: 100%;
        max-height: 250px;
    }
    
    .col-4.text-center {
        width: 100%;
        margin-bottom: 1rem;
    }
}

@media screen and (max-width: 576px) {
    .chart-canvas {
        height: 200px;
    }
    
    .osis-card {
        margin-bottom: 1rem;
    }
    
    .osis-card img {
        max-height: 200px;
    }
    
    .numbers h5 {
        font-size: 1rem;
    }
    
    .icon {
        font-size: 1.5rem;
    }
}

/* Fix untuk spacing */
.col-4.text-center {
    padding: 0.5rem !important;
}
    </style>
    <div class="row mt-2">
        <div class="col-lg-12 mb-lg-0 mb-4"> <!-- Lebar kolom diperbesar dari col-lg-7 menjadi col-lg-9 -->
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex flex-column h-100">
                                <h5 class="font-weight-bolder">Kemara-ES | Dashboard </h5>
                                <p class="mb-1 pt-2 text-bold">Selamat datang Calon Siswa Baru di Sistem Informasi Akademik SMAK Kesuma
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


  
  
  <style>
      .card:hover {
          transform: translateY(-10px);
          transition: transform 0.3s ease;
      }
      .icon {
          font-size: 32px;  /* Ukuran ikon lebih besar */
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
  <br>
  
  <form method="POST" action="{{ route('dashboardNonSiswa.store') }}" id="Form" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <!-- Bagian kiri -->
      <div class="col-md-4">
          <div class="osis-card">
              <div class="image view view-first">
                  <br>
                  <img src="{{ auth()->check() && optional(auth()->user()->Siswa)->foto 
                        ? asset('storage/fotosiswa/' . auth()->user()->Siswa->foto) 
                        : asset('storage/fotosiswa/we.jpg') }}"
                        alt="Foto">
              </div>
              <br>
              <div class="caption">
                  <p><strong>Nama Lengkap:</strong> {{ e(optional(auth()->user())->Siswa->NamaLengkap ?? '') }}</p>
                  <p><strong>Username:</strong> {{ e(optional(auth()->user())->username ?? '') }}</p>
                  <div class="form-check text-center">
                      {{-- <input type="checkbox" name="osis_id[]" value="{{ $osis->id }}"> Pilih --}}
                  </div>
              </div>
          </div>
          <br>
      </div>
  
      <!-- Bagian kanan -->
      <div class="col-md-8">
        <div class="card mb-4">
          <div class="card-header pb-0">
              {{-- <h6>Role & Hak Akses</h6> --}}
              <h6><i class="fas fa-user-shield"></i> Bukti Pembayaran</h6>

          </div>
          <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                  <table class="table align-items-center mb-0"id="usersa-table">
                      <thead>
                          <tr>
                              <th
                                  class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                  No.</th>
                               <th
                                  class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                  Nama Siswa</th>
                              <th
                                  class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                  Upload Bukti</th>
                              <th
                                  class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                  Status</th>
                              <th
                                  class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                  Tanggal Pembuatan Akun</th>
                              <th
                                  class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                  Tanggal Upload</th>
                              <th
                                  class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                  Action</th>
                              <th>
                             
                              </th>
                          </tr>
                      </thead>
                  </table>
              </div>
          </div>
      </div>
      </div>
  </div>

</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function() {
      $('#usersa-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('pembayaran.pembayaran') }}", // Ganti dengan route untuk fungsi `getPembayaran`
          columns: [
            {
            data: 'id',
            name: 'id',
            className: 'text-center',
            render: function (data, type, row, meta) {
                return meta.row + 1; 
            },
        },
          { data: 'NamaLengkap', name: 'NamaLengkap', className: 'text-center' },
            { data: 'foto', name: 'foto', className: 'text-center' },
            { data: 'status', name: 'status', className: 'text-center' },
            { data: 'created_at', name: 'created_at', className: 'text-center' },
            // { data: 'tanggalbukti', name: 'tanggalbukti', className: 'text-center' },
            { 
    data: 'tanggalbukti', 
    name: 'tanggalbukti', 
    className: 'text-center',
    render: function(data, type, row) {
        return data ? data : 'kosong'; // Jika `data` kosong/null, tampilkan string kosong
    }
},

            { data: 'action', name: 'action', orderable: false, searchable: false,  className: 'text-center' }
           
          ]
      });
  });
</script>

{{-- <img src="{{ asset('storage/fotosiswa/' . $siswa->foto) }}"
    alt="Foto {{ $osis->siswa->NamaLengkap }}" /> --}}
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
                                    <th>
                                   
                                    </th>
                                </tr>
                            </thead>
                        </table>
                     
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="alert alert-secondary mx-4" role="alert">
      <span class="text-black">
          <strong>Keterangan</strong> <br>
      </span>
      <span class="text-black">-
          {{-- <strong class="fa fa-lock"></strong> --}}
          <strong>
              <i class="fas fa-user-edit" style="color: black;"></i>
            </strong>
            <strong>  Jika ingin mengupdate biodata, silahkan ke menu sidebar profile dan edit profile anda.</strong><br>-
            <strong>  Silahkan menekan icon tersebut di tabel bukti pembayaran agar anda bisa mengupload foto pembayaran.</strong><br>

      </span>
  </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   
    <script>
    $(document).ready(function() {
    let table = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('pengumumannonsiswa.data') }}',
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        columns: [
          {
            data: 'id',
            name: 'id',
            className: 'text-center',
            render: function (data, type, row, meta) {
                return meta.row + 1; 
            },
        },
          { data: 'pengumuman', name: 'pengumuman', className: 'text-center' },
            { data: 'deskripsi', name: 'deskripsi', className: 'text-center' },
            { data: 'created_at', name: 'created_at', className: 'text-center' },
            { data: 'action', name: 'action', orderable: false, searchable: false,  className: 'text-center' }
        ]
    });
    

    $('#select-all').on('click', function() {
              let checkboxes = $('.user-checkbox');
              let allChecked = checkboxes.filter(':checked').length === checkboxes.length; 
              checkboxes.prop('checked', !allChecked);
          });
          $(document).on('mouseenter', '[data-bs-toggle="tooltip"]', function() {
              $(this).tooltip();
          });

    // Delete Selected Users
    $('#delete-selected').on('click', function() {
        let selectedIds = $('.user-checkbox:checked').map(function() {
            return $(this).val();
        }).get();

        if (selectedIds.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Tidak Ada Pengumuman Yang Dipilih',
                text: 'Tolong Pilih Salah Satu.'
            });
            return;
        }

        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Tidak Bisa Diubah Lagi Jika di di Delete!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Iya, Delete!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route('pengumuman.delete') }}',
                    method: 'POST',
                    data: {
                        ids: selectedIds,
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire(
                                'Deleted!',
                                response.message,
                                'success'
                            );
                            table.ajax.reload();
                        } else {
                            Swal.fire(
                                'Failed!',
                                'Gagal delete pengumuman.',
                                'error'
                            );
                        }
                    },
                    error: function(xhr) {
                        Swal.fire(
                            'Error!',
                            'An error occurred while deleting pengumuman.',
                            'error'
                        );
                        console.error(xhr.responseText);
                    }
                });
            }
        });
        
    });
    
});

   </script>
       

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
@endsection

