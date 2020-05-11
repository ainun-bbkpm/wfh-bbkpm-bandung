<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
    <!-- <link rel="stylesheet" href="<?php //echo  base_url('assets/mdb/css/mdb.min.css') ?>"> -->
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

                
                <h1 class="mt-4">Selamat datang di Sistem Informasi Penilaian Kinerja BBKPM BANDUNG</h1>
                

                <div class="row mt-4">
                    <div class="col-md-3">
                        <div class="card">
                        <h5 class="card-header">Pegawai</h5>
                            <div class="card-body">
                                <h5 class="card-title"><i class="fa fa-user" aria-hidden="true"></i></h5>
                                <p class="card-text">Jumlah  <b id="jumlah_user"> 0</b>.</p>
                                <!-- <a href="#" class="btn btn-primary">Detail</a> -->
                            </div>
                        </div>

                    </div>

                    <div class="col-md-3">
                        <div class="card">
                        <h5 class="card-header">User Login</h5>
                            <div class="card-body">
                                <h5 class="card-title"><i class="fa fa-user" aria-hidden="true"></i></h5>
                                <p class="card-text">Jumlah  <b id="jumlah_login"> 214</b>.</p>
                                <!-- <a href="#" class="btn btn-primary">Detail</a> -->
                            </div>
                        </div>

                    </div>


                    <div class="col-md-3">
                        <div class="card">
                        <h5 class="card-header">Data Indikator Kinerja</h5>
                            <div class="card-body">
                                <h5 class="card-title"><i class="fa fa-clipboard" aria-hidden="true"></i></h5><p class="card-text">Jumlah  <b id="jumlah_indikator"> 24</b>.</p>
                                <!-- <a href="#" class="btn btn-primary">Detail</a> -->
                            </div>
                        </div>

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


    <script src="<?php echo site_url('assets/vendor/datatables/js/jquery.dataTables.min.js') ?>">
    </script>
    <script src="<?php echo site_url('assets/vendor/datatables/js/dataTables.bootstrap4.min.js') ?>">
    </script>

    <?php $this->load->view('_includes/js.php'); ?>

    <script>
    $(document).ready(function() {
        $('#example').DataTable();

        $.ajax({
            url: "<?php echo site_url('api/pegawai?key=bbkpm2019') ?>",
            
            type: "GET",
            success:function(res){
                var response = JSON.parse(res)
                var jumlah_user = response.total
                $('#jumlah_user').html(jumlah_user)
                

            },
            error:function(err){
                console.log(err);
                alert(err)
            }
        })

        $.ajax({
            url: "<?php echo site_url('api/login?key=bbkpm2019') ?>",
            
            type: "GET",
            success:function(res){
                // var response = JSON.parse(res)
                var jumlah_login = res.total
                $('#jumlah_login').html(jumlah_login)
                

            },
            error:function(err){
                console.log(err);
                alert(err)
            }
        })


        $.ajax({
            url: "<?php echo site_url('api/indikator/jumlah') ?>",
            
            type: "GET",
            success:function(res){
                // var response = JSON.parse(res)
               
                var jumlah_indikator = res
                $('#jumlah_indikator').html(jumlah_indikator)
                

            },
            error:function(err){
                console.log(err);
                alert(err)
            }
        })


        
    });
    </script>



</body>

</html>