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
        <?php $this->load->view('approval/sidebar.php'); ?>
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


                <h1 class="mt-4">Selamat datang di Sistem Informasi Penilaian Kinerja BBKPM BANDUNG</h1>


                <?php
                // echo $this->session->atasan_ke;
                // print_r($this->session);
                // echo "<bR>";
                // echo "Unit kerja ".$this->session->id_unit_kerja;
                // echo "<bR>";
                // echo "Jabatan ".$this->session->id_jabatan;
                if (($this->session->level == 2)) {
                ?>

                    <br>
                    <br>
                    <h3>
                        List Pegawai bawahan
                    </h3>
                    <div class="table-responsive mt-4">
                        <table id="example" class="table table-striped table-bordered table-sm" style="width:100%">
                            <thead>
                                <tr>

                                    <th>Nama</th>


                                    <th>Status</th>
                                    <th>Approved By</th>
                                    <th>Return By</th>
                                    <th>Tgl Ajuan</th>

                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($detail_remun->result() as $detail) {
                                    # code...

                                ?>
                                    <tr>

                                        <td><?php echo $detail->nama_pegawai ?></td>


                                        <td>
                                            <?php
                                            // echo $detail->STATUS.$detail->nama_approved_by;
                                            if ($detail->STATUS >  $detail->atasan_ke) {

                                                echo "<span class=\"badge badge-primary\">Approved</span>";
                                            }
                                            // elseif ($detail->STATUS >  $detail->atasan_ke) {
                                            //     # code...
                                            //     echo "<span class=\"badge badge-primary\">Approval</span>";
                                            // }
                                            else {
                                                echo "<span class=\"badge badge-danger\">waiting</span>";
                                            }


                                            ?>


                                        </td>
                                        <td>
                                            <span class="badge badge-pill badge-success"><?php echo $detail->nama_approved_by ?></span>

                                        </td>
                                        <td>
                                            <span class="badge badge-pill badge-warning"><?php echo $detail->nama_return_by ?></span>

                                        </td>
                                        <td>
                                            <?php echo $detail->tgl_ajuan ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo site_url("approval/remun?id=$detail->nip_pegawai&token=" . sha1($detail->nip_pegawai)) ?>" class="btn btn-primary btn-sm">Detail Remun</a>
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


                <?php
                }
                ?>


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
                // "order": [
                //     [5, "desc"],
                //     [2, "desc"],

                // ], //or asc 
                // "columnDefs": [
                //     {
                //         "targets": 5,
                //         "type": "date-eu"
                //     },
                //     {
                //         "targets": 3
                //     }
                // ],

                // columnDefs: [{
                //     targets: [2],
                //     orderData: [2, 4]
                // }, {
                //     targets: [4],
                //     orderData: [4, 0]
                // }]
            });
        });
    </script>



</body>

</html>