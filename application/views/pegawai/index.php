<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Remunerasi</title>

    <link rel="shortcut icon" href="<?php echo site_url('assets/images/fav.png') ?>" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="<?php //echo  base_url('assets/mdb/css/mdb.min.css') 
                                        ?>"> -->
    <link rel="stylesheet" href="<?php echo site_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="<?php echo site_url('assets/fontawesome/css/all.css') ?>">

    <!-- Vendor -->
    <link rel="stylesheet" href="<?php echo site_url('assets/vendor/toastr/css/toastr.min.css') ?>">
    <link rel="stylesheet" href="<?php echo site_url('assets/vendor/datatables/css/dataTables.bootstrap4.min.css') ?>">



    <!-- Custom page -->
    <link rel="stylesheet" href="<?php echo site_url('assets/css/custom.css') ?>">

</head>

<body>
    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <?php $this->load->view('_includes/sidebar.php'); ?>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <!-- Header Start -->
            <?php $this->load->view('_includes/header.php'); ?>
            <!-- Header End -->

            <div class="container-fluid mt-4">

                <!-- Notif Start -->
                <?php $this->load->view('_includes/notif.php'); ?>
                <!-- Notif end -->


                <h1 class="mt-4">Data pegawai</h1>

                <a href="<?php echo site_url('dashboard/pegawai/tambah') ?>" class="btn btn-success btn-sm">Tambah
                    pegawai</a>


                <div class="table-responsive mt-4">
                    <table id="example" class="table table-striped table-bordered table-sm" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>No. Abs</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Unit Kerja</th>
                                <th>Jabatan</th>
                                <th>Grading</th>
                                <th>Jab Value</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($pegawai_all->result() as $pegawai) {
                                # code...

                            ?>
                                <tr>
                                    <td><?php echo $pegawai->nip ?></td>
                                    <td><?php echo $pegawai->no_abs ?></td>
                                    <td>
                                        <a class="btn btn-secondary btn-sm" href="<?php echo site_url('dahsboard/pegawai/biodata?id=') . $pegawai->nip . "&token=" . md5(sha1(md5($pegawai->nip))) ?>"><?php echo $pegawai->nama_pegawai ?></a>

                                    </td>
                                    <td><?php echo $pegawai->nik ?></td>
                                    <td><?php echo $pegawai->nama_unit_kerja ?></td>
                                    <td><?php echo $pegawai->nama_jabatan ?></td>
                                    <td><?php echo $pegawai->grading ?></td>
                                    <td><?php echo $pegawai->jab_value ?></td>

                                    <td>



                                        <a class="nav-link dropdown-toggle btn btn-primary btn-sm" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Aksi
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right p-2" aria-labelledby="navbarDropdown">


                                            <a href="<?php echo site_url("dashboard/pegawai/atasan?id=$pegawai->nip&token=" . sha1($pegawai->nip))  ?>" class="btn btn-info btn-sm">Atasan</a>

                                            <a href="<?php echo site_url("dashboard/remun?id=$pegawai->nip&token=" . sha1($pegawai->nip)) ?>" class="btn btn-dark btn-sm">Remunasi
                                                <?php //echo  $han 
                                                ?>

                                            </a>

                                            <a href="<?php echo site_url("dashboard/pegawai/edit?id=$pegawai->nip&token=" . sha1($pegawai->nip))  ?>" class="btn btn-primary btn-sm">Edit</a>

                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus" data-id="<?php echo $pegawai->nip ?>" data-link="<?php echo site_url('pegawai/hapus')  ?>">Hapus</button>
                                            <!-- cek ke tabel atasan -->
                                            <?php
                                            // $CIatasan = &get_instance();

                                            // $CIatasan->load->model('Atasan_m', 'atasan');

                                            // $dataatasan = $CIatasan->atasan->getAllByNipPegawai($pegawai->nip)->row();
                                            // if ($dataatasan) {
                                            //     $han = 1;
                                            // } else {
                                            //     $han = 0;
                                            // }

                                            $datalogin = $this->db->query("SELECT nip, nama_pegawai, id_login FROM pegawai LEFT JOIN login ON pegawai.`nip`=login.`nip_pegawai` WHERE pegawai.`nip`='$pegawai->nip'")->row();
                                            if ($datalogin->id_login) {
                                                // echo "Adad";
                                            } else {
                                                // echo "Gada";
                                                // tampilkan button geenerate
                                                echo "<button type=\"button\" class=\"btn btn-success btn-sm\" onclick=\"return generate(this)\" data-id=\"$pegawai->nip\" >Generate Akun</button>";
                                            }

                                            ?>







                                        </div>


                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>No Abs</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Unit Kerja</th>
                                <th>Jabatan</th>
                                <th>Grading</th>
                                <th>Jab Value</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                    <small>
                        Menampilkan halaman dalam <strong>{elapsed_time}</strong> detik.
                    </small>
                </div>

            </div>




        </div>
        <!-- /#page-content-wrapper -->
    </div>

    <footer class="footer bg-light border-right pl-4">
        <h5>BBKPM BANDUNG @ 2019</h5>
    </footer>



    <!-- Modal Start -->
    <?php $this->load->view('_includes/modal.php'); ?>

    <!-- Modal ENd -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo site_url('assets/vendor/jquery/jquery-3.4.1.min.js') ?>">
    </script>
    <script src="<?php echo site_url('assets/js/bootstrap.bundle.min.js') ?>">
    </script>
    <script src="<?php echo site_url('assets/js/bootstrap.min.js') ?>">
    </script>


    <!-- Vendor -->
    <script src="<?php echo site_url('assets/vendor/toastr/js/toastr.min.js') ?>">
    </script>


    <script src="<?php echo site_url('assets/vendor/datatables/js/jquery.dataTables.min.js') ?>">
    </script>
    <script src="<?php echo site_url('assets/vendor/datatables/js/dataTables.bootstrap4.min.js') ?>">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <?php $this->load->view('_includes/js.php'); ?>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                'language': {
                    'emptyTable': '<i class="fa fa-folder-open fa-3x"></i>'
                }
            });

            $('#hapus').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var id = button.data('id') // Extract info from data-* attributes
                var link = button.data('link') // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)

                modal.find('.modal-body #id_hapus').val(id)
                modal.find('#form_hapus').attr('action', link)
            })



        });

        function generate(gen) {
            var id = gen.getAttribute("data-id");
            var link = gen.getAttribute("data-link");
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "Generate Akun",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes,',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    // alert(id)
                    var form = new FormData();
                    form.append("nip_pegawai", id);

                    var settings = {
                        "url": "<?php echo base_url('api/login') ?>",
                        "method": "POST",
                        "timeout": 0,

                        "processData": false,
                        "mimeType": "multipart/form-data",
                        "contentType": false,
                        "data": form
                    };

                    $.ajax(settings).done(function(response) {
                        // console.log(response);
                        location.reload();
                    });
                    swalWithBootstrapButtons.fire(
                        'Generated!',
                        'akun berhasil dibuat.',
                        'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        // 'Your imaginary file is safe ',
                        'error'
                    )
                }
            })
        }
    </script>



</body>

</html>