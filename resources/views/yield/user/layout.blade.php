<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="shortcut icon" href="{{ asset('images/icon.png') }}" type="image/icon.png">
    <link rel="stylesheet" type="text/css" href="css/vendor.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,700;1,300&family=Roboto:wght@300;400;700&display=swap"rel="stylesheet">
    <script src="js/modernizr.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        {{-- <style>
            .container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        margin: -10px;
    }

    .col-md-6.col-lg-3 {
        flex: 1 0 21%; /* Atur lebar kolom untuk tata letak grid */
        margin: 10px;
        box-sizing: border-box;
    }

    .masonry-item {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s;
        padding: 16px;
    }

    .masonry-item img {
        width: 100%;
        border-radius: 8px;
        object-fit: cover;
    }

    .masonry-item:hover {
        transform: translateY(-10px);
    }
        </style> --}}
</head>
<body data-bs-spy="scroll" data-bs-target="#header-nav" tabindex="0">
    {{-- body --}}
    {{-- navbar --}}
    @include('yield/user/navbar')

    {{-- body --}}
    @yield('body')

    {{-- footer --}}
    @include('yield/user/footer')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script> --}}
{{-- <script>
    document.addEventListener("DOMContentLoaded", function () {
        var elem = document.querySelector('.row');
        new Masonry(elem, {
            itemSelector: '.col-md-6.col-lg-3',
            columnWidth: '.col-md-6.col-lg-3',
            percentPosition: true,
            gutter: 10
        });
    });
</script> --}}

    <script>
        var showContentModal = document.getElementById('showContentModal');

        showContentModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;

            var judul = button.getAttribute('data-judul');
            var username = button.getAttribute('data-username');
            var deskripsi = button.getAttribute('data-deskripsi');
            var image = button.getAttribute('data-image');
            var kategori = button.getAttribute('data-kategori');

            var modalJudul = showContentModal.querySelector('#modal-judul');
            var modalUsername = showContentModal.querySelector('#modal-username');
            var modalDeskripsi = showContentModal.querySelector('#modal-deskripsi');
            var modalImage = showContentModal.querySelector('#modal-image');
            var modalKategori = showContentModal.querySelector('#modal-kategori');

            modalJudul.textContent = judul;
            modalUsername.textContent = username;
            modalDeskripsi.textContent = deskripsi;
            modalKategori.textContent = kategori;
            modalImage.src = image;
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".filter-button").click(function() {
                var value = $(this).attr('data-filter');
                $(".filter-button").removeClass("active");
                $(this).addClass("active");
                if (value == "*") {
                    $('.all, .karya, .game, .fyp, .meme, .foto, .random, .design, .berita, .color, .wallpaper, .animasi').show('1000');
                } else {
                    $('.all, .karya, .game, .fyp, .meme, .foto, .random, .design, .berita, .color, .wallpaper, .animasi').hide('3000');
                    if ($(value).length > 0) {
                        $(value).show('3000');
                    } else {
                        // kosong
                    }
                }
            });
        });
    </script>
    <script src="{{ asset('js/jquery-1.11.0.min.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.7/dist/iconify-icon.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif

        function sweetalert(contentId) {
            Swal.fire({
                title: "Apakah Anda Yakin?",
                text: "Ingin Menghapus Konten ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Delete"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${contentId}`).submit();
                }
            });
        }
    </script>
    <script>
        const kategoriSelect = document.getElementById('kategori');
        const selectedKategoriInput = document.getElementById('selected-kategori');

        kategoriSelect.addEventListener('change', function () {
            const selectedOptions = Array.from(this.selectedOptions).map(option => option.value);
            selectedKategoriInput.value = selectedOptions.join(' ');
        });
    </script>
    <script>
        function tampilkanAlamat() {
            const alamatLengkap = "{{ Auth::user()->alamat }}";
            document.getElementById('alamat').innerHTML = alamatLengkap;
        }
    </script>     
</body>
</html>