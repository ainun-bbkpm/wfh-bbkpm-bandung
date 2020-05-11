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

    <link rel="stylesheet" href="<?php echo site_url('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') ?>">


    <link rel="stylesheet" href="<?php echo site_url('assets/vendor/handsontable/handsontable.full.min.css') ?>">


    <!-- <link href="https://cdn.jsdelivr.net/npm/handsontable@7.3.0/dist/handsontable.full.min.css" rel="stylesheet" media="screen"> -->



    <!-- Custom page -->
    <link rel="stylesheet" href="<?php echo site_url('assets/css/custom.css') ?>">



</head>

<body>
    <div class="d-flex" id="wrapper">


        <!-- Sidebar -->
        <?php
        if ($sidebar == 'dashboard') {
            # code...
            $this->load->view('_includes/sidebar.php');
        } else {
            # code...
            $this->load->view('pegawai/sidebar.php');
        }


        ?>
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



                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-lg-8 col-md-6">
                                        <h3 class="mb-0 text-truncated" id="nama">Nama Pegawai</h3>
                                        <p class="lead" id="jabatan">No Jabatan</p>



                                    </div>
                                    <div class="col-12 col-lg-4 col-md-6 text-center">
                                        <img src="https://robohash.org/68.186.255.198.png" id="picture" alt="" width="150px" class="mx-auto  img-fluid">
                                        <br>
                                        <?php
                                        if ($this->session->level == 4) {
                                        ?>
                                            <a class="btn btn-success btn-sm" href="<?php echo site_url('pegawai/biodata_edit?id=') . $nip . "&token=" . sha1(sha1(md5($nip . md5($nip)))) ?>">Edit</a>
                                        <?php
                                        }
                                        ?>
                                        <br>
                                        <br>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <h3 class="mb-0" id="nip">20 </h3>
                                        <small>NIP</small>
                                        <!-- <button class="btn btn-block btn-outline-success"><span class="fa fa-plus-circle"></span> Follow</button> -->
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <h3 class="mb-0" id="grading">245</h3>
                                        <small>Grading</small>
                                        <!-- <button class="btn btn-outline-info btn-block"><span class="fa fa-user"></span> View Profile</button> -->
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <h3 class="mb-0" id="jab_value">43</h3>
                                        <small>Job Value</small>
                                        <!-- <button type="button" class="btn btn-outline-primary btn-block"><span class="fa fa-gear"></span> Options</button> -->
                                    </div>
                                    <!--/col-->
                                </div>
                                <!--/row-->
                            </div>
                            <!--/card-block-->
                        </div>
                    </div>


                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="alert alert-primary" role="alert">
                            Absensi
                        </div>
                        <table id="example" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id Absensi</th>
                                    <th>No Abs</th>
                                    <th>Tgl Abs</th>
                                    <th>Sakit</th>
                                    <th>Izin</th>
                                    <th>Alpa</th>
                                    <th>Cuti</th>
                                    <th>Jumlah Keterlambatan</th>
                                    <th>Jumlah Kerja/menit</th>

                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="alert alert-warning" role="alert">
                            Absensi Senam
                        </div>
                        <table id="example2" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Tahun</th>
                                    <th>Januari</th>
                                    <th>Februari</th>
                                    <th>Maret</th>
                                    <th>April</th>
                                    <th>Mei</th>
                                    <th>Juni</th>
                                    <th>Juli</th>
                                    <th>Agustus</th>
                                    <th>September</th>
                                    <th>Oktober</th>
                                    <th>November</th>
                                    <th>Desember</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
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


    <!-- bootstrap-datepicker -->
    <script src="<?php echo site_url('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>">
    </script>


    <!-- Chart JS -->
    <script src="<?php echo site_url('assets/vendor/chartjs/Chart.min.js') ?>">
    </script>

    <!-- handsontable -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/handsontable@7.3.0/dist/handsontable.full.min.js"></script> -->
    <script src="<?php echo site_url('assets/vendor/handsontable/handsontable.full.min.js') ?>"></script>

    <script src="<?php echo site_url('assets/vendor/sweetalert2/sweetalert2.all.min.js') ?>"></script>


    <script src="<?php echo site_url('assets/vendor/datatables/js/jquery.dataTables.min.js') ?>">
    </script>
    <script src="<?php echo site_url('assets/vendor/datatables/js/dataTables.bootstrap4.min.js') ?>">
    </script>

    <?php $this->load->view('_includes/js.php'); ?>


    <!-- handsontable -->

    <script>
        $(document).ready(function() {
            var settings = {
                "url": "<?php echo  site_url("api/pegawai?id=$nip&level=$level") ?>",
                "method": "GET",
                "timeout": 0,
                "headers": {
                    "key": "bbkpm2019"
                },
            };

            $.ajax(settings).done(function(response) {

                // console.log(response.pegawai);
                // console.log(response.Datalogin);
                // console.log(response.Datalogin[0].picture);

                var no_abs = response.pegawai.no_abs
                var nip = response.pegawai.nip
                absen(no_abs);
                absensenam(nip);
                // console.log(nip);

                $('#nama').html(response.pegawai.nama_pegawai)
                $('#nip').html(response.pegawai.nip2)
                $('#jab_value').html(response.pegawai.jab_value)
                // $('#picture').html(response.pegawai.jab_value)

                $("#picture").attr("src", "<?php echo site_url('uploads/pegawai/') ?>" + response.pegawai.picture);
                // $("#picture").attr("src", "http://10.0.0.25/simremuna3/uploads/pegawai/noval.jpg");
                $('#grading').html(response.pegawai.grading)
                $('#jabatan').html(response.pegawai.nama_unit_kerja + ' / ' + response.pegawai.nama_jabatan)



            });
            $.ajax(settings).fail(function(response) {
                Swal.fire(
                    'Eror!',
                    'Tejadi Kesalahan di API!',
                    'error'
                )
            });


        });


        function absen(no_abs) {


            var table = $('#example').DataTable({
                "ajax": "<?php echo  site_url('absensi/api_list?no_abs=') ?>" + no_abs,

                "columns": [{
                        "data": "id_absensi"
                    },
                    {
                        "data": "no_abs"
                    },
                    {
                        "data": "tgl_absensi"
                    },
                    {
                        "data": "sakit"
                    },
                    {
                        "data": "izin"
                    },
                    {
                        "data": "alpa"
                    },
                    {
                        "data": "cuti"
                    },
                    {
                        "data": "jumlah_keterlambatan"
                    },
                    {
                        "data": "jumlah_kerja_menit"
                    },

                ],
                rowId: 'id_absensi'

            });
        }

        function absensenam(nip) {


            var table = $('#example2').DataTable({
                "ajax": "<?php echo  site_url('absensisenam/api_list?nip=') ?>" + nip,

                "columns": [{
                        "data": "tahun"
                    },
                    {
                        "data": "januari"
                    },
                    {
                        "data": "februari"
                    },
                    {
                        "data": "maret"
                    },
                    {
                        "data": "april"
                    },
                    {
                        "data": "mei"
                    },
                    {
                        "data": "juni"
                    },
                    {
                        "data": "juli"
                    },
                    {
                        "data": "agustus"
                    },
                    {
                        "data": "september"
                    },
                    {
                        "data": "oktober"
                    },
                    {
                        "data": "november"
                    },
                    {
                        "data": "desember"
                    },

                ],
                rowId: 'id_absensi_senam'

            });
        }
    </script>
</body>

</html>