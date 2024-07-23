<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Absensi Siswa</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{asset('assets/img/logo-rev1.png')}}" rel="icon">
    <link href="{{asset('assets/img/logo-rev1.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <!-- Template Main CSS File -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">


</head>

<body>

    @include('tampilan.body.header')

    @include('tampilan.body.sidebar')

    <main id="main" class="main">

        @yield('tampilan')

    </main><!-- End #main -->

    @include('tampilan.body.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <!-- Vendor JS Files 
    -->
    <script src="{{asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/vendor/chart.js/chart.umd.js')}}"></script>
    <script src="{{asset('assets/vendor/echarts/echarts.min.js')}}"></script>
    <script src="{{asset('assets/vendor/quill/quill.js')}}"></script>
    <script src="{{asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
    <script src="{{asset('assets/vendor/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>

    <!-- Template Main JS File -->
    <script src="{{asset('assets/js/main.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/toastr/build/toastr.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('#delete').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const url = this.getAttribute('href');
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons.fire({
                    title: "Apakah anda yakin?",
                    text: "Data tidak akan dikembalikan setelah dihapus!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, hapus data!",
                    cancelButtonText: "Tidak, batalkan!",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                        swalWithBootstrapButtons.fire({
                            title: 'Terhapus!',
                            text: "Data berhasil dihapus.",
                            icon: "success"
                        });
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire({
                            title: "Dibatalkan",
                            text: "Data kembali disimpan",
                            icon: "error"
                        });
                    }
                });
            });
        });
    });
    </script>

    <script>
    const inputFoto_siswa = document.querySelector('#foto_siswa');
    const previewFoto_siswa = document.querySelector('#previewFoto_siswa');

    inputFoto_siswa.addEventListener('change', function() {
        const file = inputFoto_siswa.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            previewFoto_siswa.src = e.target.result;
        }

        reader.readAsDataURL(file);
    });
    </script>

    <script>
    const inputFoto_admin = document.querySelector('#foto_admin');
    const previewFoto_admin = document.querySelector('#previewFoto_admin');

    inputFoto_admin.addEventListener('change', function() {
        const file = inputFoto_admin.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            previewFoto_admin.src = e.target.result;
        }

        reader.readAsDataURL(file);
    });
    </script>


    <script>
    const inputFoto_kepsek = document.querySelector('#foto_kepsek');
    const previewFoto_kepsek = document.querySelector('#previewFoto_kepsek');

    inputFoto_kepsek.addEventListener('change', function() {
        const file = inputFoto_kepsek.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            previewFoto_kepsek.src = e.target.result;
        }

        reader.readAsDataURL(file);
    });
    </script>

    <script>
    const inputFoto_kurikulum = document.querySelector('#foto_kurikulum');
    const previewFoto_kurikulum = document.querySelector('#previewFoto_kurikulum');

    inputFoto_kurikulum.addEventListener('change', function() {
        const file = inputFoto_kurikulum.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            previewFoto_kurikulum.src = e.target.result;
        }

        reader.readAsDataURL(file);
    });
    </script>

    <script>
    const inputFoto_bk = document.querySelector('#foto_bk');
    const previewFoto_bk = document.querySelector('#previewFoto_bk');

    inputFoto_bk.addEventListener('change', function() {
        const file = inputFoto_bk.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            previewFoto_bk.src = e.target.result;
        }

        reader.readAsDataURL(file);
    });
    </script>

    <script>
    const inputFoto_wakel = document.querySelector('#foto_wakel');
    const previewFoto_wakel = document.querySelector('#previewFoto_wakel');

    inputFoto_wakel.addEventListener('change', function() {
        const file = inputFoto_wakel.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            previewFoto_wakel.src = e.target.result;
        }

        reader.readAsDataURL(file);
    });
    </script>



</body>

</html>