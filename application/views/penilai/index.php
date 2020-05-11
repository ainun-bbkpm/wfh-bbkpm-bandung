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
        <?php $this->load->view('penilai/sidebar.php'); ?>
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

                <!-- <div class="row my-3">
                    <div class="col-md-4">
                        <div class="card text-center h-100">
                            <div class="card-block">
                                <h4 class="card-title">Special Treatment</h4>
                                <h2><i class="fa fa-home fa-3x"></i></h2>
                            </div>
                            <div class="row px-2 no-gutters">
                                <div class="col-6">
                                    <h3 class="card card-block border-top-0 border-left-0 border-bottom-0">100</h3>
                                </div>
                                <div class="col-6">
                                    <h3 class="card card-block border-0">70%</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center h-100">
                            <div class="card-block">
                                <h4 class="card-title">Seasonal Deals</h4>
                                <h2><i class="fa fa-address-card fa-3x"></i></h2>
                            </div>
                            <div class="row px-2 no-gutters">
                                <div class="col-6">
                                    <h3 class="card card-block border-top-0 border-left-0 border-bottom-0">85</h3>
                                </div>
                                <div class="col-6">
                                    <h3 class="card card-block border-0">50%</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center h-100 card-info">
                            <div class="card-block">
                                <h4 class="card-title">Big Savings</h4>
                                <h2><i class="fa fa-coffee fa-3x"></i></h2>
                            </div>
                            <div class="row p-2 no-gutters rounded">
                                <div class="col-6 rounded">
                                    <div class="card card-block text-info rounded-0 border-left-0 border-right-0 border-top-0 border-bottom-0">
                                        <h3>75</h3>
                                        <span class="small text-uppercase">items</span>
                                    </div>
                                </div>
                                <div class="col-6 rounded">
                                    <div class="card card-block text-info rounded-0 border-right-0 border-top-0 border-bottom-0">
                                        <h3>30%</h3>
                                        <span class="small text-uppercase">savings</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <?php
                // print_r($this->session);
                // echo "<bR>";
                // echo "Unit kerja ".$this->session->id_unit_kerja;
                // echo "<bR>";
                // echo "Jabatan ".$this->session->id_jabatan;
                // if (($this->session->id_unit_kerja == 37) || $this->session->id_unit_kerja == 40 || $this->session->id_unit_kerja == 35) {
                    // jika leevel penilai maka munculkan pegawi yang di nilai
               
                if (($this->session->level ==3)) {
                ?>


                    <div class="table-responsive mt-4">
                        <table id="example" class="table table-striped table-bordered table-sm" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Unit Kerja</th>
                                    <th>Jabatan</th>

                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($atasan_all->result() as $atasan) {
                                    # code...

                                ?>
                                    <tr>
                                        <td><?php echo $atasan->nip_pegawai ?></td>
                                        <td><?php echo $atasan->nama_pegawai ?></td>
                                        <td><?php echo $atasan->nik ?></td>
                                        <td><?php echo $atasan->nama_unit_kerja ?></td>
                                        <td><?php echo $atasan->nama_jabatan ?></td>

                                        <td>
                                            <a href="<?php echo site_url("penilai/remun?id=$atasan->nip_pegawai&token=" . sha1($atasan->nip_pegawai)) ?>" class="btn btn-primary btn-sm">Detail Remun</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Unit Kerja</th>
                                    <th>Jabatan</th>

                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
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
            $('#example').DataTable();
        });
    </script>



</body>

</html>