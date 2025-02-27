@extends('app2') 
@section('content')
@section('title', 'List Alumni - SMA KATOLIK KESUMA MATARAM')

@section('meta_description', 'Para Alumni SMAK Kesuma Mataram')

@section('meta_keywords', 'Alumni SMAK Kesuma Mataram')

<style>
.container {
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    padding: 2rem;
    width: 100%;
    max-width: 100%;
    margin: 0 auto;
    overflow-x: hidden;
}

/* Responsive Typography */
:root {
    --h1-font-size: clamp(1.5rem, 4vw, 2.2rem);
    --body-font-size: clamp(0.875rem, 2vw, 0.9rem);
}

/* .container h1 {
    color: var(--primary-color);
    margin-bottom: 20px;
    text-align: center;
    font-size: 2rem;
} */
.container h1 {
    color: #2c3e50;
    font-weight: 600;
    font-size: var(--h1-font-size);
    margin-bottom: 2rem;
    text-align: center;
    padding: 0 1rem;
    word-wrap: break-word;
}
.table-responsive {
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: thin;
    margin-bottom: 1rem;
    border-radius: 10px;
}
.table-responsive::-webkit-scrollbar {
    height: 6px;
}

.table-responsive::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.table-responsive::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 3px;
}

/* Table Styles */
.table {
    width: 100%;
    min-width: 800px; /* Minimum width before horizontal scroll */
}

.table th,
.table td {
    white-space: nowrap;
    padding: clamp(0.5rem, 2vw, 1rem);
    font-size: var(--body-font-size);
}

/* Responsive Images */
.table img {
    max-width: 100px;
    height: auto;
    width: clamp(50px, 15vw, 100px);
    object-fit: cover;
    border-radius: 8px;
}

/* DataTables Responsive Styling */
.dataTables_wrapper {
    width: 100%;
    max-width: 100%;
}

.dataTables_length,
.dataTables_filter,
.dataTables_info,
.dataTables_paginate {
    padding: 1rem;
    font-size: var(--body-font-size);
}
@media screen and (max-width: 1200px) {
    .container {
        padding: 1rem;
    }
    
    .table thead th {
        padding: 0.75rem;
    }
}
@media screen and (max-width: 992px) {
    .dataTables_wrapper {
        display: flex;
        flex-direction: column;
    }
    
    .dataTables_length,
    .dataTables_filter {
        text-align: left;
        margin-bottom: 1rem;
    }
    
    .dataTables_paginate {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 0.5rem;
    }
}

@media screen and (max-width: 768px) {
    .container {
        border-radius: 10px;
        margin: 0.5rem;
    }
    
    .table-responsive {
        border-radius: 8px;
    }
    
    .dataTables_length select,
    .dataTables_filter input {
        width: 100%;
        max-width: 200px;
    }
}

/* Stack Layout for Mobile */
@media screen and (max-width: 576px) {
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate {
        float: none;
        text-align: center;
    }
    
    .dataTables_wrapper .dataTables_filter input {
        margin-left: 0;
    }
    
    .container h1:after {
        width: 60px;
    }
}

/* Print Media Styles */
@media print {
    .container {
        box-shadow: none;
        padding: 0;
    }
    
    .table img {
        max-width: 60px;
    }
    
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter,
    .dataTables_wrapper .dataTables_paginate {
        display: none;
    }
}

.slider-wrapper {
    background-color: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: var(--soft-shadow);
}

.slider {
    min-height: 700px; 
    display: flex;
    align-items: center;
    justify-content: center;
}


.slider-item {
    display: none;
}

.slider-item img.slider-image {
    width: 120%; 
    max-height: 100vh;
    height: auto;
    width: auto;
    object-fit: contain;
    transition: transform 0.3s ease;
}


.slider-item img.slider-image:hover {
    transform: scale(5.02);
}

.slider-nav {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 15px;
}

.slider-nav button {
    background-color: var(--secondary-color);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.slider-nav button:hover {
    background-color: var(--primary-color);
    transform: translateY(-2px);
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.slider-content {
    padding: 20px;
    line-height: 1.6;
}

.slider-content p {
    margin-bottom: 1em;
    text-align: justify;
    color: var(--text-color);
}

.author-info {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid #eee;
}

.author-info p {
    font-size: 14px;
    color: #555;
    margin-bottom: 5px;
}

.author-info strong {
    color: var(--primary-color);
}

@media (max-width: 768px) {
    .container {
        padding: 10px;
    }
    
    .slider-wrapper {
        padding: 15px;
    }
    
    .slider-item img.slider-image {
        max-height: 300px;
    }
    
    .slider-nav button {
        padding: 8px 15px;
        font-size: 14px;
    }
}
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    position: relative;
}

.container h1 {
    color: var(--primary-color);
    margin-bottom: 1.5rem;
    text-align: center;
    font-size: clamp(1.8rem, 4vw, 2.5rem);
    font-weight: 700;
    letter-spacing: -0.5px;
    position: relative;
    padding-bottom: 1rem;
}

.container h1::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
    border-radius: 2px;
}

/* Modern Slider Wrapper */
.slider-wrapper {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.slider-wrapper:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}

/* Modern Slider Component */
.slider {
    position: relative;
    margin-bottom: 2rem;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

.slider-item {
    display: none;
    animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.98); }
    to { opacity: 1; transform: scale(1); }
}

.slider-item img.slider-image {
    width: 100%;
    height: 500px;
    object-fit: cover;
    border-radius: 12px;
    transition: all 0.5s ease;
}

.slider-item:hover img.slider-image {
    transform: scale(1.03);
    filter: brightness(1.05);
}

/* Modern Slider Navigation */
.slider-nav {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-top: 1.5rem;
}

.slider-nav button {
    background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
    color: white;
    border: none;
    padding: 0.8rem 1.5rem;
    border-radius: 50px;
    cursor: pointer;
    font-weight: 600;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.slider-nav button:hover {
    background: linear-gradient(135deg, var(--accent-color), var(--secondary-color));
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

/* Modern Content Section */
.slider-content {
    padding: 2rem;
    line-height: 1.8;
}

.slider-content p {
    margin-bottom: 1.5rem;
    text-align: justify;
    color: var(--text-color);
    font-size: 1.1rem;
    opacity: 0.9;
}

/* Modern Author Information */
.author-info {
    margin-top: 2rem;
    padding: 1.5rem;
    background: linear-gradient(to right, rgba(var(--primary-color-rgb), 0.05), rgba(var(--accent-color-rgb), 0.05));
    border-radius: 12px;
    border: 1px solid rgba(var(--primary-color-rgb), 0.1);
}

.author-info p {
    font-size: 0.95rem;
    color: var(--text-color);
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.author-info strong {
    color: var(--primary-color);
    font-weight: 600;
}

/* Glass Morphism Effect */
.glass-effect {
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 16px;
}

/* Loading Skeleton Animation */
@keyframes shimmer {
    0% { background-position: -1000px 0; }
    100% { background-position: 1000px 0; }
}

.loading {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 1000px 100%;
    animation: shimmer 2s infinite;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .container {
        padding: 1.5rem;
    }
    
    .slider-item img.slider-image {
        height: 400px;
    }
}

@media (max-width: 768px) {
    .container {
        padding: 1rem;
    }
    
    .slider-wrapper {
        padding: 1rem;
    }
    
    .slider-item img.slider-image {
        height: 300px;
    }
    
    .slider-nav button {
        padding: 0.6rem 1.2rem;
        font-size: 0.9rem;
    }
    
    .slider-content p {
        font-size: 1rem;
    }
}

@media (max-width: 480px) {
    .slider-item img.slider-image {
        height: 250px;
    }
    
    .author-info {
        padding: 1rem;
    }
}

/* Print Styles */
@media print {
    .slider-nav {
        display: none;
    }
    
    .slider-wrapper {
        box-shadow: none;
    }
    
    .slider-item {
        page-break-inside: avoid;
    }
}

    .alumni-card {
        border-radius: 20px;
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .alumni-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    .alumni-img {
        height: 250px;
        object-fit: cover;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        filter: invert(1);
    }
    @media (max-width: 768px) {
        .alumni-img {
            height: 200px;
        }
    }
    /* Modern Search Box Styles */
.search-container {
    position: relative;
    max-width: 600px;
    margin: 2rem auto;
    padding: 0 1rem;
}

.search-box {
    width: 100%;
    padding: 1rem 1.5rem 1rem 3.5rem;
    border: 2px solid rgba(37, 99, 235, 0.1);
    border-radius: 1rem;
    font-size: 1rem;
    background: var(--white);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
                0 2px 4px -2px rgba(0, 0, 0, 0.05);
}

.search-box:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1),
                0 10px 15px -3px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
}

.search-icon {
    position: absolute;
    left: 2rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--primary-color);
    pointer-events: none;
    transition: all 0.3s ease;
}

.search-box:focus + .search-icon {
    color: var(--secondary-color);
    transform: translateY(-50%) scale(1.1);
}

/* Search Animation */
@keyframes searchPulse {
    0% { box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.2); }
    70% { box-shadow: 0 0 0 10px rgba(37, 99, 235, 0); }
    100% { box-shadow: 0 0 0 0 rgba(37, 99, 235, 0); }
}

.search-box:focus {
    animation: searchPulse 2s infinite;
}

/* Search Results Highlight */
.search-highlight {
    background: linear-gradient(120deg, rgba(37, 99, 235, 0.2) 0%, rgba(96, 165, 250, 0.2) 100%);
    padding: 0.2em 0;
    border-radius: 3px;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .search-container {
        padding: 0 1rem;
    }
    
    .search-box {
        padding: 0.875rem 1.25rem 0.875rem 3rem;
        font-size: 0.95rem;
    }
    
    .search-icon {
        left: 1.75rem;
    }
}
/* Tombol navigasi slider modern */
.carousel-control-prev, .carousel-control-next {
    width: 60px;
    height: 60px;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(0, 0, 0, 0.6);
    border-radius: 50%;
    transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
}

.carousel-control-prev:hover, .carousel-control-next:hover {
    background-color: rgba(0, 0, 0, 0.8);
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 12px 20px rgba(0, 0, 0, 0.3);
}

/* Icon panah dengan warna putih dan ukuran lebih besar */
.carousel-control-prev-icon, .carousel-control-next-icon {
    background-size: 100%, 100%;
    width: 30px;
    height: 30px;
    filter: invert(1);
}

/* Efek bayangan halus saat tombol ditekan */
.carousel-control-prev:active, .carousel-control-next:active {
    transform: translateY(-50%) scale(0.95);
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
}
/* Styling Search Box */
.dataTables_filter input {
    width: 250px; /* Lebar input */
    padding: 8px;
    border-radius: 5px;
    border: 1px solid #ccc;
    outline: none;
}

/* Styling Dropdown Length Menu */
.dataTables_length select {
    padding: 5px;
    border-radius: 5px;
    border: 1px solid #ccc;
    background-color: #fff;
}
.text-center {
            text-align: center;
        }
</style>

 <div class="container my-5">
    <h1 class="text-center mb-4">🎓 Alumni SMAKERZ 🎓</h1>
    <div class="card-body px-0 pt-0 pb-2">
        {{-- <div class="mb-2">
            <label for="filter-tahun" class="block text-sm font-medium text-gray-700">Filter Tahun Masuk:</label>
            <select id="filter-tahun" class="form-select mt-1 block w-1/4 border-gray-300 rounded-md shadow-sm">
                <option value="">Semua Tahun</option>
                @foreach ($tahunMasuk as $tahun)
                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                @endforeach
            </select>
        </div> --}}
        <div class="mb-2">
            <label for="filter-tahun" class="block text-sm font-semibold text-gray-800 mb-2">
                🎓 Filter Tahun Masuk:
            </label>
            <select id="filter-tahun" 
                    class="form-select mt-1 block w-full sm:w-1/3 border-gray-300 rounded-lg shadow-md p-2 bg-white focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200 ease-in-out hover:border-blue-400">
                <option value="">Semua Tahun</option>
                @foreach ($tahunMasuk as $tahun)
                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                @endforeach
            </select>
        </div>
        <style>
        #filter-tahun {
            width: 100%;
            max-width: 300px;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            background-color: #fff;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        #filter-tahun:hover {
            border-color: #3b82f6;
        }
        
        #filter-tahun:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5);
        }
        
        label[for="filter-tahun"] {
            font-weight: 600;
            color: #1f2937;
        }
    </style> 
        <div class="table-responsive p-0">
            <table class="table align-items-center mb-0"id="users-table">
                <thead>
                    <tr>
                        <th
                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            No.</th>
                        <th
                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Foto</th>
                        <th
                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                            Nama Lengkap</th>
                            
                        <th
                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Tahun Masuk</th>
                        <th
                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Tahun Lulus</th>
                        
                        <th
                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Testimoni</th>
                          
                       
                    </tr>
                </thead>
            </table>
           
        

        </div>
    </div>
 </div>
 {{-- <div id="imageModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close">&times;</span>
        <iframe id="imageFrame" width="100%" height="400px"></iframe>
    </div>
</div> --}}

<style>
/* .modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-content {
    background-color: #fff;
    padding: 20px;
    width: 50%;
    max-width: 600px; 
    border-radius: 10px;
    text-align: center;
    position: relative;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

.close {
    position: absolute;
    top: 10px;
    right: 20px;
    font-size: 24px;
    cursor: pointer;
} */

/* Responsif untuk Tablet */
@media screen and (max-width: 768px) {
    .modal-content {
        width: 80%; /* Lebih besar di tablet */
    }
}

/* Responsif untuk HP */
@media screen and (max-width: 480px) {
    .modal-content {
        width: 90%; /* Hampir full screen di HP */
        padding: 15px;
    }
    .close {
        font-size: 20px; /* Ukuran tombol close lebih kecil */
    }
}

</style>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 {{-- <script>
    $(document).ready(function() {
    let table = $('#users-table').DataTable({
        processing: true,
        responsive: true,

        serverSide: true,
        ajax: '{{ route('alumni.alumni') }}',
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
        {
                          data: 'foto',
                          name: 'foto',
                          className: 'text-center',
                          render: function(data, type, full, meta) {
                              if (data) {
                                  return '<img src="' + '{{ asset('storage/alumni') }}/' + data +
                                      '" width="100" />';
                              } else {
                                  return '<span>Foto tidak tersedia</span>';
                              }
                          },
                      },
        { data: 'NamaLengkap', name: 'NamaLengkap', className: 'text-center' },
          { data: 'TahunMasuk', name: 'TahunMasuk', className: 'text-center' },
          { data: 'TahunLulus', name: 'TahunLulus', className: 'text-center' },
          { data: 'Testimoni', name: 'Testimoni', className: 'text-center' }
        ]
    });
});
</script> --}}
<script>
$(document).ready(function() {
    let table = $('#users-table').DataTable({
        processing: true,
        responsive: true,
        serverSide: true,
        ajax: {
            url: '{{ route("alumni.alumni") }}',
            data: function(d) {
                d.TahunMasuk = $('#filter-tahun').val();
            }
        },
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
            {
                data: 'foto',
                name: 'foto',
                className: 'text-center',
                render: function(data, type, full, meta) {
                    let imageUrl = data ? `{{ asset('storage/alumni') }}/${data}` : `{{ asset('storage/alumni/we.jpg') }}`;
                    return `<a href="#" class="open-image-modal" data-src="${imageUrl}">
                                <img src="${imageUrl}" width="100" style="cursor:pointer;" />
                            </a>`;
                }
            },
            { data: 'NamaLengkap', name: 'NamaLengkap', className: 'text-center' },
            { data: 'TahunMasuk', name: 'TahunMasuk', className: 'text-center' },
            { data: 'TahunLulus', name: 'TahunLulus', className: 'text-center' },
            { data: 'Testimoni', name: 'Testimoni', className: 'text-center' }
        ]
    });

    $('#filter-tahun').change(function() {
        table.ajax.reload();
    });

    // // Event klik untuk membuka modal dengan gambar dalam iframe
    // $(document).on('click', '.open-image-modal', function(e) {
    //     e.preventDefault();
    //     let imageUrl = $(this).data('src');
        
    //     $('#imageFrame').attr('src', imageUrl);
    //     $('#imageModal').fadeIn();
    // });

    // // Tutup modal saat klik tombol close atau di luar modal
    // $('.close, #imageModal').on('click', function() {
    //     $('#imageModal').fadeOut();
    // });
   // Handler untuk image modal
$(document).on('click', '.open-image-modal', function(e) {
    e.preventDefault();
    let imgSrc = $(this).data('src');
    Swal.fire({
        imageUrl: imgSrc,
        imageAlt: 'Alumni Photo',
        showConfirmButton: false,
        showCloseButton: true, // Tambahkan tombol close (X)
        width: 'auto'
    });
});

});
</script>

@endsection
