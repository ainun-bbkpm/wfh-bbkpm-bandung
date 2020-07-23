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


                <h1 class="mt-4">Data WFH/SiRAMAH</h1>

                <a href="<?php echo site_url('dashboard/wfh/tambah') ?>" class="btn btn-success btn-sm">Tambah
                    WFH/SiRAMAH</a>


                <div class="table-responsive mt-4">
                    <table id="example" class="table table-striped table-bordered table-sm" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tgl Absen</th>
                                <th>Nama</th>
                                <th>Jam absen hadir</th>
                                <th>Jam absen pertengahan</th>
                                <th>Jam absen pulang</th>
                                <th>Nilai Kinerja</th>

                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data_wfh->result() as $wfh) {
                                # code...

                            ?>
                                <tr>
                                    <td><?php echo $wfh->id_wfh ?></td>
                                    <td><?php echo $wfh->tgl_absen ?></td>
                                    <td><?php echo $wfh->nama_pegawai ?></td>
                                    <td><?php echo $wfh->jam_absen_hadir ?></td>
                                    <td><?php echo $wfh->jam_absen_pertengahan ?></td>
                                    <td><?php echo $wfh->jam_absen_pulang ?></td>
                                    <td><?php echo $wfh->nilai_kinerja ?></td>


                                    <td>
                                        <div class="btn-group" role="group" aria-label="...">
                                            <a href="<?php echo site_url("dashboard/wfh/edit?id=$wfh->id_wfh&token=" . sha1($wfh->id_wfh))  ?>" class="btn btn-primary btn-sm">Edit</a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus" data-id="<?php echo $wfh->id_wfh ?>" data-link="<?php echo site_url('wfh/hapus')  ?>">Hapus</button>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>

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

    <?php $this->load->view('_includes/js.php'); ?>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "order": [
                    [1, "desc"],


                ]
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
    </script>



</body>

</html>